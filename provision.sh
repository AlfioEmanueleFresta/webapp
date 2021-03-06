#!/bin/bash
# This script configures a vanilla Ubuntu 16.04
#  VM, installing dependencies and configuring
#  the database.
# Based on https://gist.github.com/rrosiek/8190550

# Variables
APPENV=local
DBHOST=localhost
DBNAME=dbname
DBUSER=dbuser
DBPASSWD=hackmeplease

echo "Updating packages list"
apt-get -qq update

echo "Installing base packages"
apt-get -y install nano curl build-essential python-software-properties git > /dev/null 2>&1

echo "Adding some repos to update our distro"
add-apt-repository ppa:ondrej/php5 > /dev/null 2>&1
add-apt-repository ppa:chris-lea/node.js > /dev/null 2>&1

echo "Updating packages list"
apt-get -qq update

echo "Installing MySQL specific packages and settings"
echo "mysql-server mysql-server/root_password password $DBPASSWD" | debconf-set-selections
echo "mysql-server mysql-server/root_password_again password $DBPASSWD" | debconf-set-selections
echo "phpmyadmin phpmyadmin/dbconfig-install boolean true" | debconf-set-selections
echo "phpmyadmin phpmyadmin/app-password-confirm password $DBPASSWD" | debconf-set-selections
echo "phpmyadmin phpmyadmin/mysql/admin-pass password $DBPASSWD" | debconf-set-selections
echo "phpmyadmin phpmyadmin/mysql/app-pass password $DBPASSWD" | debconf-set-selections
echo "phpmyadmin phpmyadmin/reconfigure-webserver multiselect none" | debconf-set-selections

echo "Removing eventual previous MySQL installation"
apt-get -y remove mysql-server > /dev/null 2>&1

echo "Installing MySQL 5.5"
apt-get -y install mysql-server-5.5 > /dev/null 2>&1

echo "Starting MySQL"
service mysql start

echo "Installing phpMyAdmin"
apt-get -y install phpmyadmin > /dev/null 2>&1

echo "Setting up our MySQL user and db"
mysql -uroot -p$DBPASSWD -e "CREATE DATABASE $DBNAME"
mysql -uroot -p$DBPASSWD -e "grant all privileges on $DBNAME.* to '$DBUSER'@'localhost' identified by '$DBPASSWD'"

echo "Installing PHP-specific packages"
apt-get -y install php5 apache2 libapache2-mod-php5 php5-curl php5-gd php5-mcrypt php5-mysql php5-sqlite php-apc phpunit > /dev/null 2>&1

echo "Enabling mod-rewrite"
a2enmod rewrite > /dev/null 2>&1

echo "Allowing Apache override to all"
sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf

echo "Setting document root to project directory"
rm -rf /var/www
ln -fs $PROJECTPATH. /var/www

echo "Turning PHP errors on"
sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/apache2/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/apache2/php.ini

echo "Configuring Apache to use phpmyadmin"
echo "Listen 81" >> /etc/apache2/ports.conf
cat > /etc/apache2/conf-available/phpmyadmin.conf << "EOF"
<VirtualHost *:81>
    ServerAdmin webmaster@localhost
    DocumentRoot /usr/share/phpmyadmin
    DirectoryIndex index.php
    ErrorLog ${APACHE_LOG_DIR}/phpmyadmin-error.log
    CustomLog ${APACHE_LOG_DIR}/phpmyadmin-access.log combined
</VirtualHost>
EOF
a2enconf phpmyadmin > /dev/null 2>&1

echo "Add environment variables to Apache"
cat > /etc/apache2/sites-enabled/000-default.conf <<EOF
<VirtualHost *:80>
    DocumentRoot /var/www
    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
    SetEnv APP_ENV $APPENV
    SetEnv DB_HOST $DBHOST
    SetEnv DB_NAME $DBNAME
    SetEnv DB_USER $DBUSER
    SetEnv DB_PASS $DBPASSWD
</VirtualHost>
EOF

echo "Restarting Apache"
service apache2 restart > /dev/null 2>&1

echo "Loading initial database"
mysql -u$DBUSER -p$DBPASSWD $DBNAME < $PROJECTPATH./database/setup.sql


echo ""
echo "All done."
echo "Web application available at http://127.0.0.1:8080/"
echo " "
echo " == You can now access the application."
echo " == This installer will continue to install the software needed for "
echo " == testing, feel free to ignore or interrupt it if you don't intend to"
echo " == run tests on your platform."
echo ""


## Testing

echo "Installing PHP Composer"
curl -sS https://getcomposer.org/installer | php5 -- --install-dir=/usr/local/bin --filename=composer

echo "Installing Composer Requirements"
composer -q install

echo "Installing Testing requirements"
apt-get install -y openjdk-7-jre > /dev/null 2>&1

echo "Installing PhantomJS headless browser"
    PHANTOM_VERSION="phantomjs-1.9.8"
    PHANTOM_CDN="http://cnpmjs.org/downloads/"
    ARCH=$(uname -m)
    if ! [ $ARCH = "x86_64" ]; then
        $ARCH="i686"
    fi
    PHANTOM_JS="$PHANTOM_VERSION-linux-$ARCH"
    apt-get install build-essential chrpath libssl-dev libxft-dev -y  > /dev/null 2>&1
    apt-get install libfreetype6 libfreetype6-dev -y  > /dev/null 2>&1
    apt-get install libfontconfig1 libfontconfig1-dev -y  > /dev/null 2>&1
    echo "Downloading from $PHANTOM_CDN$PHANTOM_JS.tar.bz2..."
    wget -q $PHANTOM_CDN$PHANTOM_JS.tar.bz2
    tar xvjf $PHANTOM_JS.tar.bz2 > /dev/null 2>&1
    mv $PHANTOM_JS /usr/local/share
    ln -sf /usr/local/share/$PHANTOM_JS/bin/phantomjs /usr/local/bin
    ln -sf /usr/local/share/$PHANTOM_JS/bin/phantomjs /bin
    sleep 2

echo "Downloading Selenium Server"
wget -q http://goo.gl/EoH85x -O SeleniumServer.jar

echo "Starting Selenium Server"
export PATH=$PATH:/usr/local/share/$PHANTOM_JS/bin/
nohup java -jar SeleniumServer.jar 0<&- &>/dev/null &

echo "Waiting for services to startup..."
sleep 6

echo "Done."
