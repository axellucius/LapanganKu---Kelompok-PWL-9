# LapanganKu 🏟️

**A Modern Web Application for Renting Sports Fields Online**

---

## 📖 Project Description

LapanganKu is a modern web platform that makes it easy for users to rent sports fields such as futsal, badminton, and basketball. With a user-friendly interface, this application allows users to check field availability, make online reservations, and manage their playing schedules more efficiently.

---

## ✨ Key Features

- 🔍 **Browse Fields** – Explore various futsal, badminton, and basketball courts with complete details
- 📅 **Online Booking** – Select a time slot and book a field instantly
- 📜 **Booking History** – View all your reservation history
- 💳 **Payment System** – Secure and easy online payment
- 🔐 **User Authentication** – Secure login and registration system
- 📱 **Responsive Design** – Works perfectly on desktop, tablet, and mobile
- 🔔 **Booking Notifications** – Confirmation and reminders for each booking

---

## 🛠️ Technologies Used

**Frontend:**
- HTML, CSS, JavaScript 

**Backend:**
- PHP
- MySQL Database

**Development Environment:**
- Laragon
- Apache Web Server

---

## ⚙️ System Requirements

Before getting started, make sure you have:

- **Laragon** – Download from [https://laragon.org/](https://laragon.org/)
- **MySQL** – Included with Laragon
- **Code Editor** – VS Code, Sublime Text, or PHPStorm
- **Git** – For cloning repository (optional)

---

## 📥 Installation Steps

### 1. Install and Setup Laragon

**Step 1.1: Download Laragon**
- Go to [https://laragon.org/](https://laragon.org/)
- Download the latest version
- Run the installer and follow the instructions

**Step 1.2: Launch Laragon**
- Open the Laragon application
- Click the "Start All" button to run Apache and MySQL
- Make sure the indicators are green (active)

**Step 1.3: Verify Installation**
- Open your browser and visit `http://localhost`
- You will see the Laragon welcome page

---

### 2. Clone or Download Repository

**Option A: Using Git**

```bash
cd C:\laragon\www
git clone https://github.com/username/Web-LapanganKu.git
cd Web-LapanganKu
```

**Option B: Download ZIP**

1. Open the GitHub repository
2. Click the **Code** button (green button)
3. Select **Download ZIP**
4. Extract to `C:\laragon\www\Web-LapanganKu`

---

### 3. Create MySQL Database

**Method 1: Using Laragon Menu (Easiest)**

1. Right-click on Laragon icon in system tray
2. Select **MySQL** → **Open Adminer** or **HeidiSQL**
3. Create a new database named `lapanganku`

**Method 2: Using phpMyAdmin**

1. Right-click Laragon → **MySQL** → **phpMyAdmin**
2. Or open `http://localhost/phpmyadmin`
3. Create new database: `lapanganku`
4. Go to **Import** tab
5. Select file `database/lapanganku.sql` from project folder
6. Click **Import**

---

### 4. Configure Database

1. Open file `includes/config.php` with your code editor
2. Update database configuration:

```php
<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'lapanganku');
define('DB_PORT', 3306);

// Website Configuration
define('SITE_URL', 'http://localhost/Web-LapanganKu');
define('SITE_NAME', 'LapanganKu');
?>
```

3. Save the file

---

### 5. Run the Application

1. Make sure Laragon is running (Apache and MySQL active)
2. Open your browser
3. Visit: `http://localhost/Web-LapanganKu`
4. The LapanganKu application is ready to use! ✅

---

## 🚀 User Guide

### For Regular Users

**Step 1: Register or Login**
- Click "Register" if you are a new user
- Fill in your information and create an account
- Or click "Login" if you already have an account

**Step 2: Browse Fields**
- Select field type: Futsal, Badminton, or Basketball
- View available fields with photos, prices, and ratings

**Step 3: Book a Field**
- Click on the desired field
- Select date and available time
- Review booking summary

**Step 4: Complete Booking**
- Confirm your reservation
- Proceed to payment
- Receive booking confirmation

**Step 5: Manage Bookings**
- Open "My Bookings" in your profile
- View upcoming bookings and history
- Cancel or reschedule if needed

---

### For Admin/Field Owners

1. **Login to Admin Panel** – Access `/admin/dashboard.php` 
2. **Manage Fields** – Add, edit, or delete field data
3. **Manage Bookings** – View and confirm customer bookings
4. **View Reports** – Monitor income and booking statistics
5. **Update Pricing** – Adjust rates and availability
6. Username - lapanganku | Password - lapanganku123 to login to dashbord

---

## 👨‍💻 Development Team

| Name | Role |
|------|------|
| **Axel Lucius Efendi** | UI/UX Design & Front-End Developer |
| **Bryan Stevent** | Front-End Developer |
| **Justin Sebastian** | Back-End Developer |

---

## 🙏 Acknowledgments

- Thank you to all contributors and testers
- Special thanks to Pak Richard as our teacher
