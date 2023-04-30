# Donut Store

This is a small web application that allows logged-in users to buy donuts. Users can register by providing a valid email and a strong password. After registration, users receive a confirmation email. The project uses PHPMailer to send emails.

## Features

* Only logged-in users can shop
* Users must provide a valid email and a strong password to register
* Users receive a confirmation email after registration
* Users can choose from three different sizes of donuts
* Different extras are available for each size of donut
* The zip code for address must be from Belgrade (starts with 11 and has a maximum of 5 digits)
* Users can preview their complete order with the calculated price before submitting it
* Users with the role 'worker' can view and manage orders
* REST API for orders in the api folder:
  * GET requests to /orders/read.php return a list of all orders
  * GET requests to /orders/read_single.php return a single order with the specified ID
  * POST requests to /orders/create.php create a new order
  * PUT requests to /orders/update.php update an existing order with the specified ID
  * DELETE requests to /orders/delete.php delete the order with the specified ID

## Installation

1. Clone the repository from GitHub:
```
git clone https://github.com/aleksandarTcode/donut_store
```
2. Install dependencies using Composer:
```
composer install
```
3. Use the fresh_database/sweethouse.sql file to set up the database.
4. All example users have the password 123456@Aa, and they have the role 'buyer' except for the user 'aca', who has the status 'worker'.

## Usage 

5. Log in using a registered user account.

6. Select the desired size of donut and choose the extras.

7. Enter the delivery address, ensuring that the zip code is from Belgrade.

8. Preview the order and check the calculated price.

9. Submit the order.

10. If you have the role 'worker', you will be redirected to the 'orders_list' page where you can manage the orders.

11. To use the REST API for orders, make requests to the appropriate endpoints using your preferred tool (e.g., cURL, Postman, Insomnia, etc.).

## Acknowledgments
* This project uses the PHPMailer library. 