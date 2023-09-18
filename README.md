# Laravel Swagger

This is a Laravel API boilerplate project with built-in Sanctum Auth & Swagger UI for easy API documentation.

![image](https://github.com/WailanTirajoh/laravel-swagger-example/assets/53980548/cd69dea7-37cb-412f-9778-7ef7d05cd1a5)

## System Requirements
```
php: ^8.1
composer: ^2.3.10
mysql / postgres
```


## Installation

Follow these simple steps to get started:

### 1. Clone the Repository
Clone this project to your local machine using Git:
```
git clone https://github.com/WailanTirajoh/laravel-swagger-example.git
```

### 2. Install Dependencies
Navigate to the project directory and install the PHP dependencies using Composer:
```
cd laravel-swagger-example
composer install
```

### 3. Set Up ENV Variables
Copy .env.example into .env & update database credentials inside the env:
```
cp .env.example .env
```

### 4. Set Up the Database
Create the necessary database tables by running the following Artisan command:
```
php artisan migrate
```

### 5. Start the Development Server
Launch the Laravel development server:
```
php artisan serve
```

### 6. Access Swagger API Documentation
Now that everything is set up, open your web browser and visit the Swagger API documentation at:

http://localhost:8000/api/documentation#/
