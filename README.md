# A Terrible Web Application

This is a terrible web application developed to teach about computer security and demonstrate some security vulnerabilities.

# Vulnerabilities

The application is designed to demonstrate:

- SQL Injection
- Cross site scripting (XSS)
- Directory traversal

Please note that there is no guarantee that these are the only vulnerabilities of the application. In fact, the system
is developed to be as unsecure as possible, and you should never run the application or the VM in any production
environment.

# Running the application

## Requirements

You should download and install:
- [Oracle VM VirtualBox](https://www.virtualbox.org/)
- [Hashicorp Vagrant](https://www.vagrantup.com/) 1.8+

These are both free and open source software packages and run on Linux, OS X and Windows.

## Run

Simply `cd` into the project directory and run:

```bash
vagrant up
```

The first time you run the machine it will take some time to download the base Linux image and to configure
the VM (install and configure all dependencies).

You can access the web application at [http://127.0.0.1:8080](http://127.0.0.1:8080) (or replace 127.0.0.1 with your local/public IP).

You can SSH into the machine, after it has been started, using `vagrant ssh`. Please note that the project directory
is mounted at `/vagrant/` in the VM.

You can stop the machine using `vagrant halt` or destroy it completely with `vagrant destroy`.

You can access the database (via phpMyAdmin) at [http://127.0.0.1:8081](http://127.0.0.1:8081) with credentials `dbuser` and `hackmeplease`.

## Updating

To checkout the latest version of the project:

```bash
cd webapp/  # cd into the project's folder
vagrant destroy -f && git pull && vagrant up
```

Note: This will discard any changes made to the VM's database.


## Testing

The software has a few functional tests to verify that the application is working and vulnerable as expected. You can run these tests after setting up the VM by running:

```bash
vagrant ssh -c "cd /vagrant/ && vendor/bin/phpunit tests"
```
