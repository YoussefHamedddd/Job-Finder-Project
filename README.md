

     Job Finder Platform (Native PHP)

    A robust, full-stack job portal built with Native PHP (No Frameworks) and MySQL. This project demonstrates a secure implementation of a job board where users can perform real-time searches and apply via email, while administrators maintain full control over the job lifecycle through a protected management panel.

    Key Features:

        🔍 Multi-Layered Filtering: Search by Job Title, Location, or Job Type using a hybrid of PHP server-side logic and JavaScript client-side live search.

        📧 Quick Apply: Direct "One-Click" application functionality via integration with job-specific email addresses.

        🛡️ Security First: Fully hardened against SQL Injection using PDO Prepared Statements and protected against XSS (Cross-Site Scripting) via strict input sanitization and htmlspecialchars output encoding.

        🔐 Admin CRUD Panel: Secure administrative area to Create, Edit, and Delete job listings with session-based authentication.

        📍 Data Normalization: Intelligent handling of location data to prevent duplicates (e.g., merging "Cairo" and "cairo").

🚀 How to Run

Follow these steps to set up the project locally using XAMPP:
1. Database Setup

First, create the database container in your MySQL server:

    Open phpMyAdmin (usually http://localhost/phpmyadmin).

    Click on the New tab.

    Enter the database name: job_finder.

    Click Create.

2. Run Migrations

Instead of manually importing SQL files, use the built-in migration script to set up your tables:

    Open your Terminal or CMD.

    Navigate to your project root: cd C:\xampp\htdocs\job_finder.

    Execute the migration script:
    Bash

    php src/Migrations/migrate.php

3. Launch the Application

    Ensure Apache and MySQL are running in your XAMPP Control Panel.

    Open your browser and visit: http://localhost/job_finder

🛠️ Technical Stack

    Backend: PHP 8.x (Native/OOP)

    Database: MySQL

    Web Server: Apache (XAMPP)

    Frontend: JavaScript (ES6+), CSS3, Bootstrap 5

🛡️ Security Implementation Details

    SQL Injection: All database queries are handled through PDO with prepared statements, ensuring that user input is never executed as code.

    XSS Protection: All user-generated content is filtered on the way out to the browser, preventing malicious scripts from executing in the user's session.

    Authentication: Sensitive actions (Create/Edit/Delete) are locked behind a server-side session check to prevent unauthorized access to the admin panel.
