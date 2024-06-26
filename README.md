Introduction
This project is a Laravel-based application designed for learning API creation and integrating Swagger documentation. The project serves as a practical guide to building and documenting RESTful APIs using Laravel and Swagger.

Prerequisites
Before you begin, ensure you have met the following requirements:

PHP >= 7.3
Composer
Laravel
MySQL or any other supported database
Git
Installation
Follow these steps to get a copy of the project up and running on your local machine.

Clone the Repository
First, clone the repository to your local machine using Git:

git clone https://github.com/DelvinNJ/Laravel-API-with-Swagger.git
cd Laravel-API-with-Swagger


Install Dependencies
Install all the required dependencies using Composer:

composer install


Environment Setup
Copy the .env.example file to .env and configure your environment variables, especially the database settings:

cp .env.example .env


Generate Application Key
Generate the application key:

php artisan key:generate


Run Migrations
Run the database migrations to create the necessary tables:

php artisan migrate


Seed the Database
Seed the database with initial data:

php artisan db:seed


Usage
After setting up the project, you can start the development server:

php artisan serve


API Documentation
The project includes Swagger documentation for the APIs. You can access the Swagger UI at:

http://localhost:8000/

Authentication
Use the following credentials to test the API:

Email: samjohn@gmail.com
Password: password
Contributing
Contributions are welcome! Please follow these steps to contribute:

Fork the repository.
Create a new branch (git checkout -b feature/your-feature).
Make your changes.
Commit your changes (git commit -m 'Add some feature').
Push to the branch (git push origin feature/your-feature).
Create a Pull Request.
License
This project is licensed under the MIT License. See the LICENSE file for more information.

Contact
If you have any questions or feedback, feel free to reach out:

Email: delvinnj02@gmail.com
Happy coding!