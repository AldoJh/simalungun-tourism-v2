# Simalungun Tourism App

## Introduction

**Simalungun Tourism** is a promotional website for Simalungun tourism, managed by the Simalungun Regency Culture, Tourism, and Creative Economy Service.

## ERD

Entity Relationship Diagram (ERD) :

![erd](https://github.com/fajar-dev/simalungun-tourism-v2/assets/69442735/d9d67f6f-5db0-4d75-bbff-72f70a2f1636)

## Installation

To set up this project, please ensure that your system meets the following requirements:

- Laravel 11
- PHP 8.2 or higher
- MySQL 5.7 or higher
- Composer 2.5 or higher

After confirming that your system meets the requirements, follow these steps to set up the project:

1. Install the necessary dependencies by running the following command in your project directory:

    ```bash
    composer install
    ```

2. Copy the `.env.example` file and rename it to `.env`. Make sure to configure the `.env` file with the necessary settings.

3. Generate an application key by running:

    ```bash
    php artisan key:generate
    ```

4. Migrate the database tables by running:

    ```bash
    php artisan migrate
    ```

5. Seed the database with initial data by running:

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

8. Import data for the events:

    ```bash
    php artisan import:event
    ```

9. Import data for the restaurants:

    ```bash
    php artisan import:restaurant
    ```

10. Import data for the hotels:

    ```bash
    php artisan import:hotel
    ```

11. Import data for the tourism places:

    ```bash
    php artisan import:tourism
    ```

## API Doc

Application Programming Interface (API) documentation for mobile applications:

https://documenter.getpostman.com/view/31416230/2sA3JT4Jmc