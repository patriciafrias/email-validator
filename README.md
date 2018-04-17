<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>
<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Email Validator 

**This a non dockerized** 

### Architecture 


![Image](http://alistair.cockburn.us/get/2301)

See http://alistair.cockburn.us/Hexagonal+architecture

- This solution implements Hexagonal Architecture (Ports & Adapters), that is based on having 
two main layers, inside and outside.
    - Into the inside layer all the domain logic is living, here I have the domain of my application "EmailValidator", 
      and it is covered by Unit tests.
    - Into the outside layer I have all code related to infrastructure (framework, DB layer, etc.), and it is covered 
      by Integration Feature tests. 
- The Ports & Adapters approach allows me to interact with the Domain only by an implementation (Adapter) of a 
Interface (Port) defined within the Domain layer.
     
- Using Doctrine and InMemory adapters within the Infrastructure layer help me to decouple the Domain from the outside 
world.

- For an small application like this one, other approaches are good, but I want to show you how I can model/build an 
scalable application, which Domain core is decoupled from frameworks, or any tool. I use Laravel, Doctrine for instance, 
but if in the future we'll need to move to another ORM or Framework. Then, we'll be able to do that without changing 
our Domain code, which is according with DDD, the most important thing on software development. 
   
### Installation

- To be able to run this application you need to install php7.1, mysql 5.7, composer and apache2 in your environment.

- Configure a new vHost
    - Add a new vHost
    - Add the URL to /etc/hosts
        127.0.0.1 http://email-validator.local/

- Create a new Database by CLI or your favorite tool
    I use "email-validator"

- Create DB Schema
    php artisan doctrine:schema:create

- Copy env.example to .env and update it with your local settings. Example:  
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=email-validator
    DB_USERNAME=root
    DB_PASSWORD=root-password

- Install dependencies
    composer install

- Run the all tests
    vendor/bin/phpunit tests 
    when you run the tests, 4 records (fixtures) will be loaded to the Database
    
### Usage

###### Browser:
    http://email-validator.local 
    
###### Api examples: 
    - http://email-validator.local/api/validate/email/myvalidemail@myvalidemail.com <br />
        response: { "is_valid": true }           
    - http://email-validator.local/api/validate/email/myinvalidemailmyinvalidemail.com <br />
        response { "is_valid": false }
    
