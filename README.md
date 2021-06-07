# Symfony Blog
    Create Blog with Admin Panel and Login Form


## Technologies (I've tested it with)
    PHP v7.3.27
    Mysql (MariaDB) v10.4.17
    Symfony v4.4
	Composer v2.0.13
	Composer Symfony flex

# How to use it
    git clone https://github.com/emkrysto/sfBlog.git
    cd sfBlog
    composer install
   
 
# Quick Steps to create the project

## install a new Symfony project (LTS - the latest stable version)
        symfony new sfBlog --version=lts

## move into your new project directory
        cd sfBlog

## start the server in the background
        symfony server:start -d

## install Profiler Development Tool
        composer req --dev profiler

## install PHP Logging Tool
        composer req logger

## install Debug Toolbar
        composer req --dev debug

## install maker bundle to easier generate code
        composer req --dev maker 

## Install Doctrine ORM for database data storage
        composer req orm

## configure the Database Connection in .env, for example:
        DATABASE_URL=mysql://root:@127.0.0.1:3306/sf_blog?serverVersion=mariadb-10.4.11
	
## create the sfBlog database
        php bin/console doctrine:database:create

## install complete security component
        composer req security

## generate Admin entity
        symfony console make:user Admin

        Answer the questions:
            store user data in the database [yes]
            enter a property name (e.g. email, username, uuid) : username
            hash/check user passwords [yes]
		
## add method in src/Entity/Admin.php
        public function __toString(): string
        {
            return $this->username;
        }

## create the database tables
        symfony console make:migration
        symfony console doctrine:migrations:migrate -n

## generate the encoded password
        symfony console security:encode-password

## insert the user into the database table
        email = admin
        roles = ["ROLE_ADMIN"]
        password  = enter genereted password

## install template engine for PHP
        composer req twig
		
## generate a login form authenticator
        symfony console make:auth

        Answer the questions:
            select [1] = Login form authenticator
            class name = AppAuthenticator
            name for the controller class = SecurityController
            select [yes] to generate a '/logout' URL

## in onAuthenticationSuccess method (src/security/AppAuthenticator.php)
        add:
            return new RedirectResponse($this->urlGenerator->generate('admin'));
        insted of:
            throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);

## uncomment bellow authorization rule (config/packages/security.yaml)
	access control:
            - { path: ^/admin, roles: ROLE_ADMIN }

## to open in browser
    https://127.0.0.1:8000/login