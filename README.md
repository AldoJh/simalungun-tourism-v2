# Medan Tourism App

# Introduction

"Medan Tourism" is a Simalungun tourism promotion website
managed by the Simalungun Regency Culture, Tourism and Creative Economy Service

## Installation

To set up this project, please ensure that your system meets the following requirements:

- Laravel 11
- PHP 8.2 or higher
- MySQL 5.7 or higher
- Composer 2.5 or higher

After ensuring the system requirements are met, follow these steps to set up the project:

1. Run the following commands in your project directory:

    ```bash
    composer install
    ```

2. Copy the `.env.example` file and rename it as `.env`. Make sure to configure the `.env` file with the necessary
   settings.
3. Generate an application key by running the following command:

    ```bash
    php artisan key:generate
    ```
    
4. Migrate the database tables by running the following command:

    ```bash
    php artisan migrate
    ```

5. Seed the database with initial data by running the following command:

    ```bash
    php artisan db:seed
    ```

6. Import data for the administrative area:

    ```bash
   php artisan import:administrative-area
    ```

7. Import data for the news:

    ```bash
   php artisan import:news
    ```