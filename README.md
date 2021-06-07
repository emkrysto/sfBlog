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

## install EasyAdmin
        composer req admin

## generate BlogSpot entity
        php bin/console make:entity BlogPost
	
	Answer the questions:
            $title 		string	255
            $published	datetime
            $content	text
            $author		string	255
            $slug		string	255

## after creating entity validate the mappings
        php bin/console doctrine:schema:validate

## create at least one dashboard
        php bin/console make:admin:dashboard
		
	Answer the questions:
            class name = DashboardController
            directory = src/Controller/Admin/

## add a new Dashboard menu item to configureMenuItems method (DashbordController.php)
        yield MenuItem::linkToCrud('Blog posts', 'fa fa-book', BlogPost::class);

## add to DashbordController.php:
        use App\Entity\BlogPost;

## add new folder src/Controller/BlogSpot/
        md src\Controller\BlogPost

## generate CRUD controllers provide operations (create, show, update, delete)
        php bin/console make:admin:crud
	
        Answer the questions:
            select [1] App\Entity\BlogSpot
            directory =  src/Controller/Admin/		
            namespace = App\Controller\Admin

## create the database tables
        php bin/console doctrine:schema:update --force

## after login you should see Admin Panel
        https://127.0.0.1:8000/admin

## generate new HomeController
        php bin/console make:controller Home
	
## change inside HomeController.php route from "/home" to "/"

## add to HomeController.php:
        use App\Entity\BlogPost;

## change index() method in HomeController.php
        public function index(): Response
        {
            $title = "Blog posts";        
            $posts = $this->getDoctrine()
                    ->getRepository(BlogPost::class)
                    ->findAll();
            return $this->render('/home/index.html.twig',['title'=>$title,'posts'=>$posts]);
        }

## add the script into "example-wrapper" container (home/index.html.twig)
        <h1>This is the {{ title }} list</h1>
     
        <ul>
            {% if posts is empty %}
                <h2>No posts to display.</h2>
            {% else %}    
                {% for post in posts %}
                   <li>{{ post.getTitle() }}</li>
               {% endfor %}
            {% endif %}
        </ul>

## create first blog post and go to page url
       https://127.0.0.1:8000/home