
# Introduction

This project is a Laravel-based application designed for learning API creation and integrating Swagger documentation. The project serves as a practical guide to building and documenting RESTful APIs using Laravel and Swagger.


#### Prerequisites
Before you begin, ensure you have met the following requirements:

```http
PHP >= 7.3
Composer
Laravel
MySQL or any other supported database
Git
```

#### Installation
Follow these steps to get a copy of the project up and running on your local machine.

Clone the Repository
First, clone the repository to your local machine using Git:

```http
git clone https://github.com/DelvinNJ/Laravel-API-with-Swagger.git
cd Laravel-API-with-Swagger
```
#### Install Dependencies
Install all the required dependencies using Composer:
```http
composer install
```

#### Environment Setup
Copy the .env.example file to .env and configure your environment variables, especially the database settings:
```http
cp .env.example .env
```


#### Generate Application Key
```http
php artisan key:generate
```

#### Run Migrations
Run the database migrations to create the necessary tables:
```http
php artisan migrate
```


#### Seed the Database
```http
php artisan db:seed
```

#### Usage
After setting up the project, you can start the development server:
```http
php artisan serve
```

#### API Documentation
The project includes Swagger documentation for the APIs. You can access the Swagger UI at:
```http
http://localhost:8000/
```


#### Authentication
Use the following credentials to test the API:
```http
Email: samjohn@gmail.com
Password: password
```

Contact
If you have any questions or feedback, feel free to reach out:

Email: delvinnj02@gmail.com

Happy coding!