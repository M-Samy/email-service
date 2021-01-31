# Email-service
- Simple [PHP, Laravel](https://laravel.com/) email service using Laravel 8,
used to send emails asynchronously to multiple recipients through multiple external email platforms like Mailjet and SendGrid.
- Here we use two email external platforms the first used as a default platform and
 second platform used as a fallback.
## About
```
    * A [POST] api send emails for multiple recipients.
    * Simple service support service container to be simple as possible.
    * Also, has a simple integration with multiple email platforms.
    * Also, application has a simple queuing technique to send emails asynchronously.
    * Code supports configurability rather than hard-coding to achieve the simplicity and readability.
```
## Getting Started
These instructions will make the project up and running on your local machine for development purposes.
### Prerequisites
* Docker 19.03.5
* Docker Compose 1.23.1
### Setup
* Dive into email-service directory.
```
    $ cd email-service
```
* Copy .env.example to .env file.
```
    $ cp .env.example .env
```
* Update apps keys into .env file used into integration with external platforms.
* Run docker-compose.yml file.
```
    $ docker-compose up -d --build
```
* Start a queue worker to process jobs which are pushed onto the queue "Just for testing".
```
    $ docker-compose run --rm artisan queue:work
```
* Run migrations.
```
    $ docker-compose run --rm artisan migrate
```
* Run composer update.
```
    $ docker-compose run --rm composer update
```
* Clearing application cache.
```
    $ docker-compose run --rm artisan config:clear
    $ docker-compose run --rm artisan cache:clear
```
### Containers created and their ports are as follows:
* Nginx :8080
* PHP :9000
* PhpMyAdmin :8183
* mysql :8002
## Built With
* [PHP 7](https://www.php.net/)
* [Laravel 8](https://laravel.com/docs/8.12/)
* [Nginx](https://www.nginx.com/)
* [Docker](https://docs.docker.com/)
* [Docker Compose](https://docs.docker.com/compose/)
## Calling Endpoint
* API Endpoint
```
   [POST] http://127.0.0.1:8080/api/send
```
* Request Headers
```
    'Accept' => 'application/json'
```
* Request Body
```
    {
        "to": [
            {
                "Email": "example1@example.com",
                "Name": "Example1"
            },
            {
                "Email": "example2@example.com",
                "Name": "Example2"
            }
        ],
        "subject": "test example",
        "message": "test example" 
    }
```
* Response sample
```
    {
        "data": {
            "status": true,
            "batch_id": "929d21a5-e6ed-4664-826f-2f528c947d5c",
            "total_jobs": 1
        }
    }
```
## Features
* Service container.
* Apply adequate design patterns.
* Applying simple design principles.
* Sending emails asynchronously.
* Scalable system design.
* Using Events, Listeners, Jobs and Job Batching laravel features.
* Email container has two different methods to send mails "Events and Listeners" and "Job Batching"
* Apply request validation.
* Apply fallback platform in case the default platform unavailable
* Implement a simple asynchronously technique.
* Implement simple integration with Mailjet and SendGrid "Implement only used functionality".
* Apply simple logging for each bulk emails and the batch status for each platform.
* Write some simple test cases.
## Applied design patterns
* Factory Design Pattern.
* Strategy Design Pattern.
* Repository Design Pattern.
* Singleton Design Pattern.
* Dependency Injection.
## Missing Features
* Apply some logging and monitoring.
* Apply authentication.
* Integrate with other multiple email platforms.
* Apply a simple web interface helps us into sending emails.
* We can split app into two services "Endpoint and Consumer service" to reduce coupling between them and communicate using message communication or event driven communication.
## Service endpoints postman collection sample
* [Email-Service](https://www.getpostman.com/collections/e372c3c9b532827d7cd3)