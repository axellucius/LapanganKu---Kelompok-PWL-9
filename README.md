 ## LapanganKu

## 📖 Description
**LapanganKu** is a website for renting sports fields such as **futsal, badminton, and basketball**.  
This platform helps users easily check availability, book fields online, and manage their playing schedules more efficiently.  

---

## ✨ Features
- 🔎 **View Fields** – Browse available futsal, badminton, and basketball courts.  
- 📅 **Online Booking** – Select a time slot and book a field instantly.  
- 📜 **Booking History** – Review your past reservations.  
- 📱 **Responsive Design** – Works seamlessly on both desktop and mobile devices.  

---

## ⚙️ Installation Guide

Follow these steps to set up **Web-LapanganKu** on your local machine using **Laragon (PHP + MySQL)**.

---

### 🔹 1. Requirements
- [Laragon](https://laragon.org/) (recommended) or XAMPP  
- PHP  
- MySQL 
- Browser (Chrome, Firefox, Edge)  
- Code editor (VS Code, Sublime, etc.)  

---

### 🔹 2. Clone the Repository
Open **Git Bash** inside your Laragon `www` folder and run:
```bash
cd C:\laragon\www

git clone https://github.com/username/Web-LapanganKu.git
```

---

### 🔹 3. Start Laragon

Open Laragon.

Click Start All (this will start Apache + MySQL).

Open your browser and visit:

http://localhost/Web-LapanganKu

---

### 🔹 4. Setup Database

- **Open phpMyAdmin via browser:**

http://localhost/phpmyadmin


- **Create a new database:**

CREATE DATABASE lapanganku_db;


- **Import the SQL file:**

Go to tab Import.

Select database/lapanganku.sql.

- **Click Go.**

---

### 🔹 5. Configure Database Connection

- **Edit `config.php` in the project root:**

```php
<?php
$host = "localhost";
$user = "root";       // default Laragon user
$password = "";       // default Laragon password is empty
$dbname = "lapanganku_db";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```
---

### 🔹 6. Run the Application

- Make sure Apache & MySQL are running in Laragon.

- Open browser and go to:
http://localhost/Web-LapanganKu


- Register or login before booking a field.

- Select Futsal, Badminton, or Basketball, choose date & time, confirm booking, and simulate payment.

---

## 🚀 Usage
1. **Login or Register** – Users must create an account or log in before making a booking.  
2. **Open the homepage of LapanganKu.**  
3. **Select a field type** (futsal, badminton, basketball).  
4. **Choose your preferred date and time.**  
5. **Confirm your booking.**  
6. **Complete the payment** (if online payment is enabled).  
7. (Optional) Use the **Quick Booking feature** for faster reservations.  

---

## 🛠️ Tech Stack

- **Design: Figma**

- **Frontend: HTML, CSS, JavaScript (User Interface)**

- **Backend: MySql, PHP (Handles booking logic)**

---

## 👨‍💻 Contributors

- **Axel Lucius Efendi – UI/UX Design & Front-End Developer**
 
- **Bryan Stevent - Front End Developer**
  
- **Justin Sebastian - Back End Developer**


