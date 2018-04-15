## README

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>
<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

Assignment for ResponseConcepts by Patricia Frías

## Architecture 

- This solution implements Hexagonal Architecture (Ports & Adapters), that is based on having 
two main layers, inside and outside.
    - Into the inside layer all the domain logic is living, here I have the domain of my application "EmailValidator", 
      and it is covered by Unit tests.
    - Into the outside layer I have all code related to infrastructure (framework, DB layer, etc.), and it is covered 
      by Integration Feature tests. 
- The Ports & Adapters approach allows me to interact with the Domain only by an implementation (Adapter) of a 
    Interface (Port) defined within the Domain layer.
     
- Using Doctrine and InMemory adapters within the Infrastructure layer help me to decouple the Domain from the outside world. 

- To deliver my solution I'm using a simple Docker setup based on five containers orchestrated by docker-compose.
    - web server
    - composer
    - mysql
    - php-cli and 
    - php-fpm

## Installation

- docker-compose up
       
- docker-compose run composer install
    
- Generate DB
    docker-compose run cli php artisan doctrine:schema:create
    
## Testing

- docker-compose up
    
- docker-compose run cli vendor/bin/phpunit tests

- Tests are already providers with Doctrine fixtures which are loaded before each test method.
    
## Usage

- docker-compose up
    
- Add http://email-validator.local to /etc/hosts (can also be accessed with localhost)
    
- Browser
    http://email-validator.local or localhost
    
- Rest Api examples
    http://email-validator.local/api/validate/email/myvalidemail@myvalidemail.com  
        response: 
            {
                "is_valid": true
            }
           
    http://email-validator.local/api/validate/email/myinvalidemail myinvalidemail.com
        response
            {
                "is_valid": false
            }
    
