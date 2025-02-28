# Easyfood
## Description

This project is a web application built with the Symfony framework, developed as part of a team using the SCRUM agile methodology. It allows restaurant owners and customers to manage food deliveries. However, please note that the application is still a work in progress and is not fully functional.

## Prerequisites

Before running this project, ensure the following software is installed on your machine:

- PHP 7.4 or higher
- [Composer](https://getcomposer.org/)

## Installation with WAMP

1. Download and install WAMP from [here](https://www.wampserver.com/en/).
2. Once WAMP is installed, start the WAMP server (make sure Apache and MySQL are running).
3. Open WAMP's PHPMyAdmin and create a new database (e.g., `easyfood`).
4. Follow the steps below to clone and set up the project.

1. **Clone the repository**

   First, clone the repository from GitHub using the following command:

   ```bash
   git clone https://github.com/EnzoFantapieHamang/Easyfood-symfony-application.git

2. **Navigate to the project directory**

   ```bash
    cd Easyfood-symfony-application
   
3. **Install PHP dependencies**

   ```bash
    composer install

4. **Configure the database**
   Modify the database connection settings in the .env file (or .env.local if used) at the root of the project. Replace the    connection details with your own:
   ```bash
    DATABASE_URL="mysql://root:@127.0.0.1:3306/easyfood"

5. **Create the database and apply migrations**
   If the database does not exist yet, create it using the following command:
   ```bash
    php bin/console doctrine:database:create

   Then, apply the migrations to create the necessary tables:
   ```bash
    php bin/console doctrine:migrations:migrate

## Running the project

1. **Start the Symfony server**

   You can start the local Symfony server with the following command:

   ```bash
   symfony server:start

2. **Access the application**

   Open your web browser and navigate to the following address to see the application in action:

   ```bash
   http://localhost/EasyFood/public

## Contributors

This project was developed by:

- https://github.com/EnzoFantapieHamang
- Amadou Ndiaye
- Rémi Larralde


