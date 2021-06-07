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