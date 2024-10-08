# Shopping E-commerce Website

## Overview
This project is a fully functional e-commerce website that allows users to browse products, manage their accounts, and securely make purchases. It is designed with a focus on user experience and information security.

## Features
- **User Interface**: Intuitive interface with separate views for customers and administrators.
- **Account Management**: Users can create accounts, log in, and manage their profiles.
- **Product Browsing**: Users can easily search and browse through available products.
- **Order Management**: Customers can place orders and track their status.
- **Admin Dashboard**: Administrators can manage products, orders, and users effectively.
- **Security Measures**: Implementations to prevent SQL Injection, Cross-Site Scripting (XSS), and Cross-Site Request Forgery (CSRF).

## Technologies Used
- **Backend**: PHP (Laravel framework)
- **Frontend**: HTML, CSS, JavaScript
- **Database**: MySQL
- **Development Environment**: XAMPP

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/robot0211/shopping.git
2. Navigate to the project directory:
   ```bash
   cd shopping
4. Set up your environment:
   ```bash
   Create a .env file and configure your database settings.
6. Install dependencies:
   ```bash
   composer install
8. Run migrations:
   ```bash
   php artisan migrate
10. Start the server:
    ```bash
    php artisan serve

## Usage
- Access the website by navigating to http://localhost:8000/home in your web browser.
- Register a new account or log in to an existing account.
- Browse products, add them to your cart, and complete the checkout process.

## Security Considerations
- Ensure that your database credentials are kept secure in the .env file.
- Regularly update dependencies to mitigate security vulnerabilities.

## License
This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgements
Laravel for the robust framework.
