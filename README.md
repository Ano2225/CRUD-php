# CRUD Operations in PHP

This project demonstrates the basic CRUD (Create, Read, Update, Delete) operations using PHP and MySQL. The project allows users to manage a set of records in a database through a simple user interface. This is a basic PHP application that connects to a MySQL database and allows you to perform the following actions:

- **Create**: Add new records to the database.
- **Read**: View existing records from the database.
- **Update**: Modify existing records.
- **Delete**: Remove records from the database.

## Features

- Add new data to the database (Create).
- Display data from the database (Read).
- Edit existing data in the database (Update).
- Delete data from the database (Delete).
- Simple interface for interacting with the data.

## Requirements

- PHP >= 7.0
- MySQL database
- A web server like Apache or Nginx with PHP support

## Setup

### 1. Clone the Repository:

   First, clone this repository to your local machine:

   ```bash
   git clone https://github.com/Ano2225/crud-php.git
   ```

### 2. Set up MySQL Database:

   Create a new MySQL database and a table. You can use the following SQL script to create the table:


### 3. Configure Database Connection:

   Open the `config.php` file and set the database connection details

   Update the `DB_USERNAME`, `DB_PASSWORD`, and `DB_NAME` with your database credentials.

### 4. Run the Application:

   - Place the project folder in your web server's root directory (e.g., `htdocs` in XAMPP).
   - Open a web browser and navigate to `http://localhost/crud-php/`.
   - You will be able to create, read, update, and delete records in the MySQL database.
