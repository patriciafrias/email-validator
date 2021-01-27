## Email Validator 


### Architecture 

![Image](https://netflixtechblog.com/ready-for-changes-with-hexagonal-architecture-b315ec967749)

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
   
- To deliver my solution I'm using a simple Docker setup based on five containers orchestrated by docker-compose.
    - web server
    - composer
    - mysql
    - php-cli and 
    - php-fpm

### Installation

1. Launch all containers
````
docker-compose up
````

2. Install dependencies
````      
docker-compose run composer install
````

3. Set permissions
````
sudo chown -R $USER: .
````
    
4. Generate DB
````
docker-compose run cli php artisan doctrine:schema:create
````
    
### Testing

1. Launch all containers (skip this step if you already launched it)
````
docker-compose up
````

2. Run Unit tests
````    
docker-compose run cli vendor/bin/phpunit tests
````

- Tests are already providers with Doctrine fixtures which are loaded before each test method.
    
### Usage

1. Launch all containers (skip this step if you already launched it)
````
docker-compose up
````
    
2. Add http://email-validator.local to /etc/hosts (can also be accessed with localhost)
    

3. Browser
    - http://email-validator.local 
    or 
    - localhost
    
4. Api examples
    - http://email-validator.local/api/validate/email/myvalidemail@myvalidemail.com  <br />
        response: 
            { "is_valid": true }
           
    - http://email-validator.local/api/validate/email/myinvalidemailmyinvalidemail.com <br />
        response
            { "is_valid": false }
    
