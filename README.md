# Patriot Match (Pure LAMP Stack)
This project is a Tinder-like web application built using a **LAMP (Linux, Apache, MySQL, PHP)** stack. The goal is to create a responsive and functional matchmaking platform, with features like user registration, login, password recovery, and account management.

## 🚀 Features
- **User Registration**: Users can create an account with a unique username, email, and password.
- **User Login**: Secure authentication for registered users with password hashing.
- **Password Recovery**: Users can recover their password via a secure email-based system that sends a unique reset link.
- **User Session Management**: A session system that allows logged-in users to view their profile, log out, and navigate the platform.
- **Database Management**: MySQL backend for storing user credentials, profiles, and match data.
- **Responsive Frontend**: HTML-based UI for user interaction, styled with CSS.
- **First-Run Automation**: Automatically sets up the database schema on the first run via a setup page.

## 🛠️ Technologies Used
- **Linux**: Operating system for hosting the application.
- **Apache**: Web server for serving the application.
- **MySQL**: Database for storing user information and matchmaking data.
- **PHP**: Backend for processing requests, managing sessions, and interacting with the database.
- **HTML/CSS**: Frontend for user interface design.
- **JavaScript**: To enhance the user experience with dynamic registration handling.

## 📂 File Structure
```plaintext
├── index.html              # Home page
├── login.html              # Login page
├── register.html           # Registration page
├── forgot_password.html    # Forgot password page
├── login.php               # Backend script for user login
├── register.php            # Backend script for user registration
├── forgot_password.php     # Backend script for password recovery
├── reset_password.php      # Password reset page after token verification
├── session.php             # Page for logged-in users to view their profile and session info
├── logout.php              # Handles user logout and session destruction
├── setup.php               # First-run database setup script
├── patriot.sql             # Raw SQL commands for manual database setup
├── styles.css              # CSS for frontend styling
└── README.md               # Project documentation
```

## ⚙️ Getting Started
**Prerequisites**
- A LAMP server setup (Linux, Apache, MySQL, PHP)
- MySQL installed and running
- PHP enabled on your server

## 📥 Installation

### Step 1
**Clone the Repository:**
- Run the following bash commands in Ubuntu console (copy paste)
```bash
git clone https://github.com/EnlistedGhost/Patriot-Match-App
cd Patriot-Match-App
```
- Move Files to the Server's Web-Host directory: (e.g., /var/www/html).
```bash
cp -r ~/Patriot-Match-App/. /var/www/html/
```

### Step 2
**Database Setup: 
(Choose option A or B)**
- **Automatic Setup: (Option A)** Visit setup.php in your browser (e.g., http://yourdomain.com/setup.php) to initialize the database.
- **Manual Setup: (Option B)** Run the commands in patriot.sql on your MySQL database.

### Step 3
**Configure Database Connection:**
- Update the database credentials in login.php, register.php, and setup.php:
 - ```php
	$servername = "localhost";
	$db_username = "your_mysql_user";
	$db_password = "your_mysql_password";
	$dbname = "patriot"; 
	```

### Step 4
**Set Permissions:** 
- Ensure proper file and directory permissions:
 - ```php
	sudo chmod -R 755 /var/www/html
	sudo chown -R www-data:www-data /var/www/html 
	```

### Step 5
**Test the Application:**
- Open your browser and navigate to your server's URL.
- Register a new user and log in to test functionality.

## 🖥️ Usage
- **Register:** Create a new account using the register.html page.
- **Login:** Use the credentials to log in via the login.html page.
- **Forgot Password:** If you’ve forgotten your password, use the forgot_password.html page to recover it.
- **User Dashboard:** After logging in, view and manage your profile on the session.php page.
- **Log Out:** Log out via the session.php page using the "Log Out" button.

## 🔑 Password Recovery
- **Forgot Password:** On the forgot_password.html page, enter your username to receive a password recovery email.
  - The system will generate a unique recovery token and send it to your registered email.
- **Reset Password:** Clicking the email contained link loads a unique/per-user reset_password.php page, where you can set a new password.
  - The token expires after 1 hour to ensure security.

## 🤝 Contribution Guidelines
- **Get a copy:** Fork the repository.
- **Create a feature branch:** git checkout -b feature-name.
- **Commit your changes:** git commit -m "Add new feature".
- **Push to the branch:** git push origin feature-name.
- **Merge you contribitions:** Submit a pull request for review.

## 🐛 Known Issues
- The application’s basic functionality is working, but additional security features (e.g., multi-factor authentication, email verification) are not present.
- Additionally, there are other potention enhancements in terms of user experience, such as:
  - Adding validation for password strength during account creation or password reset.
  - Extending the session management for automatic logout after inactivity.

## 📜 License
- This project is licensed under the MIT License.

## ❤️ Acknowledgments
- Inspired by Tinder's simple and effective user interaction design.
- Built with ❤️ and PHP!
- Would not exist without [@Lana84c's](https://github.com/Lana84c) personal drive and contributions!

## 🔗 Contact
- If you have questions or feedback, feel free to reach out:
 - Email: coming soon...
 - GitHub: EnlistedGhost

## 🌟 Thank You!
- Thank you for checking out this project! Your contributions and suggestions are always welcome.
