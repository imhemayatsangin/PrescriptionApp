# Prescription App - A laravel application


# Prerequisites
Before you can use this project, make sure you have the following software installed on your machine:<br>

PHP (version 8.0 or higher)<br>
Composer<br>
Node.js (version 14 or higher)<br>
NPM (Node Package Manager)<br>
# Installation<br>
To download and set up the project, follow these steps:<br>

1. Clone the repository to your local machine using the following command:<br>
<code> git clone https://github.com/imhemayatsangin/PrescriptionApp.git</code><br>

2. Navigate to the project directory:<br>
<code>cd your-repository</code><br>

3. Install the PHP dependencies using Composer:<br>
<code>composer install</code><br>

4. Create a copy of the .env.example file and name it .env:<br>
<code> cp .env.example .env</code><br>

5. Generate an application key:<br>
<code> php artisan key:generate</code><br>

6. Configure the database connection in the .env file. Set the appropriate values for your database server:<br>
<code>DB_CONNECTION=mysql<br>
DB_HOST=127.0.0.1<br>
DB_PORT=3306<br>
DB_DATABASE=your_database_name<br>
DB_USERNAME=your_database_username<br>
DB_PASSWORD=your_database_password</code><br>

7. Run the database migrations to create the necessary tables:<br>
<code>php artisan migrate</code><br>

8. Install the JavaScript dependencies using NPM:<br>
<code>npm install</code><br>

# Usage<br>
To run the project locally, execute the following command:<br>
<code>php artisan serve<br></code>
This will start a development server at http://localhost:8000, and you can access the application in your web browser.<br>
# Enjoy the show.<br>
