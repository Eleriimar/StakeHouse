🍽️ OnlineFood - PHP Based Food Ordering System
Welcome to StakeHouse, a web-based food ordering platform built using PHP and MySQL. This project allows customers to browse menus, place orders, and manage food deliveries online. It also includes an admin panel for restaurant management.

🚀 Features
👨‍🍳 Customer Side
View restaurant menus with categories (e.g., Samosas, Pilau, Beef Stew)

Add food items to cart

Place and track orders

User authentication (login/register)

View past orders and invoices

🧑‍💼 Admin Panel
Add, edit, delete restaurants and food items

Manage customer orders

View all user accounts and order history

Dashboard with basic analytics

🛠️ Tech Stack
Frontend: HTML5, CSS3, JavaScript, Bootstrap

Backend: PHP 7+

Database: MySQL

Other: XAMPP/LAMP/WAMP for local hosting

📁 Project Structure

OnlineFood-PHP/
│
├── admin/                # Admin dashboard and logic
├── css/                  # Stylesheets
├── images/               # Static images for food items and UI
├── includes/             # Header, footer, DB connection, etc.
├── js/                   # JavaScript and jQuery scripts
├── user-login/           # Customer authentication logic
├── restaurant/           # Restaurant details and menus
├── order-history/        # View past orders
├── cart/                 # Cart management and checkout
├── contact/              # Contact and feedback
├── index.php             # Home page
└── README.md             # Project documentation
⚙️ Installation Guide
Clone or Download the repository:

bash
Copy
Edit
git clone https://github.com/Eleriimar/StakeHouse.git


Start Local Server (e.g., XAMPP or WAMP)

Move Project Folder to htdocs/ (for XAMPP)

Import the Database

Open phpMyAdmin

Create a new database: onlinefoodphp

Import the onlinefood.sql file (if provided)

Configure Database Connection

Edit connection/connect.php

Set:

php
Copy
Edit
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "onlinefood";
Launch the App

Visit http://localhost/OnlineFood-PHP/ in your browser

🔐 Admin Login
URL: /admin/index.php

Default Credentials (if applicable):

Username: admin

Password: codeastro

📸 Screenshots
Add screenshots here showing homepage, menu, cart, and admin panel.

📌 Known Issues
White screen after saving items: usually caused by missing session_start() or unhandled errors. Check error_reporting() settings.

Currency conversion: Modify values from $ to Ksh in all relevant PHP and HTML files.

🙌 Contribution
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

📄 License
This project is licensed under the MIT License.