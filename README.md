# Patriot Match (Pure LAMP Stack)
This project is a Tinder-like web application built using a **LAMP (Linux, Apache, MySQL, PHP)** stack. The goal is to create a responsive and functional matchmaking platform, with features like user registration, login, and account management.

## 🚀 Features
- **User Registration**: Users can create an account with a unique username and email.
- **User Login**: Secure authentication for registered users.
- **Database Management**: MySQL backend for storing user credentials and profiles.
- **Responsive Frontend**: HTML-based UI for user interaction.
- **First-Run Automation**: Automatically sets up the database schema on the first run.

## 🛠️ Technologies Used
- **Linux**: Operating system for hosting the application.
- **Apache**: Web server for serving the application.
- **MySQL**: Database for storing user information.
- **PHP**: Backend for processing requests and interacting with the database.
- **HTML/CSS**: Frontend for user interface design.

## 📂 File Structure
```plaintext
├── index.html              # Home page
├── login.html              # Login page
├── register.html           # Registration page
├── login.php               # Backend script for user login
├── register.php            # Backend script for user registration
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

## Installation
**Clone the Repository:**
- Step 1.
```bash
git clone https://github.com/your-username/tinder-clone.git
cd tinder-clone
```
- Step 2.

Upload Files to the Server: Copy the files to your web server's root directory (e.g., /var/www/html).

## Database Setup:
- **Automatic Setup:** Visit setup.php in your browser (e.g., http://yourdomain.com/setup.php) to initialize the database.
- **Manual Setup:** Run the commands in patriot.sql on your MySQL database.
- **Configure Database Connection:** Update the database credentials in login.php, register.php, and setup.php:
 - ```php
    $servername = "localhost";
    $db_username = "your_mysql_user";
    $db_password = "your_mysql_password";
    $dbname = "patriot"; 
    ```
- **Set Permissions:** Ensure proper file and directory permissions:
 - ```bash
    sudo chmod -R 755 /path/to/project
    sudo chown -R www-data:www-data /path/to/project 
    ```

## Test the Application:
- Open your browser and navigate to your server's URL.
- Register a new user and log in to test functionality.

## 🖥️ Usage
- **Register:** Create a new account using the register.html page.
- **Login:** Use the credentials to log in via the login.html page.
- **Matchmaking:** Expand functionality to add features like swiping, matching, and messaging!

## 🤝 Contribution Guidelines
- Fork the repository.
- Create a feature branch: git checkout -b feature-name.
- Commit your changes: git commit -m "Add new feature".
- Push to the branch: git push origin feature-name.
- Submit a pull request for review.

## 🐛 Known Issues
- Current setup lacks advanced security (e.g., SQL injection prevention, CSRF tokens).
- Password hashing is implemented, but other security layers need to be added.

## 📜 License
- This project is licensed under the MIT License.

## ❤️ Acknowledgments
- Inspired by Tinder's simple and effective user interaction design.
- Built with ❤️ and PHP!

## 🔗 Contact
- If you have questions or feedback, feel free to reach out
 - Email: coming soon...
 - GitHub: EnlistedGhost

## 🌟 Thank You!
- Thank you for checking out this project! Your contributions and suggestions are always welcome.
