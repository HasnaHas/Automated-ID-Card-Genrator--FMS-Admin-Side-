# Faculty Management System (FMS) – Student ID Card Management

🎓 **First Year Academic Project**

This project was developed as part of a **1st Year undergraduate academic requirement** at the Faculty of Technology, University of Sri Jayewardenepura.
The system is designed to manage student information and generate student ID cards for faculty administrative use.

🚫 **This project is NOT intended for public distribution, reuse, or commercial use.**

## 🛠️ Project Contribution

This was a first-year group project. My initial contribution focused on developing the frontend of the system.  
After the group submission, I further modified and enhanced the project by implementing barcode functionality for student ID card generation and adding full CRUD (Create, Read, Update, Delete) operations to improve the admin section.  

These enhancements allow administrators to easily manage student records and re-download or re-print student ID cards in case an ID card is lost.


## 🚀 Features

### Student Management
- **Student Registration**: Complete student information entry with profile photo upload
- **Student Editing**: Update student details with restrictions on batch and department changes
- **Student Deletion**: Remove student records with confirmation
- **Student Search**: Real-time search across all student fields
- **Student Listing**: View all students in a responsive table format

### ID Card Generation
- **Automatic ID Card Creation**: Generate professional ID cards upon registration
- **Barcode Integration**: Unique barcode generation for each student
- **PDF Export**: High-quality PDF ID cards using FPDF library
- **Print Functionality**: Direct printing capabilities

### Security & Administration
- **Admin Authentication**: Secure login system for administrators
- **Session Management**: Protected access to all management functions
- **Data Validation**: Comprehensive input validation and sanitization

### User Interface
- **Responsive Design**: Bootstrap-based responsive layout
- **Modern UI**: Clean, professional interface with Font Awesome icons
- **Real-time Clock**: Live date and time display
- **Image Management**: Profile photo upload and management

## 🛠️ Technologies Used

### Backend
- **PHP 7.0+**: Server-side scripting
- **MySQL**: Database management
- **FPDF**: PDF generation library

### Frontend
- **HTML5**: Semantic markup
- **CSS3**: Custom styling with Bootstrap
- **JavaScript**: Interactive features
- **Bootstrap 4.5**: Responsive framework
- **Font Awesome**: Icon library
- **Google Fonts (Inter)**: Modern typography

### Development Tools
- **XAMPP/WAMP**: Local development environment
- **phpMyAdmin**: Database administration
- **Git**: Version control

## 📋 Prerequisites

Before running this application, make sure you have:

- **Web Server**: Apache/Nginx
- **PHP**: Version 7.0 or higher
- **MySQL**: Version 5.6 or higher
- **Web Browser**: Modern browser (Chrome, Firefox, Safari, Edge)

## 📖 Usage

### Admin Login
1. Access the login page (`index.php`)
2. Enter your admin credentials
3. Upon successful login, you'll be redirected to the dashboard

### Student Registration
1. From the dashboard, click "Register Student"
2. Fill in all required fields:
   - Personal information (First Name, Last Name, Gender)
   - Academic details (Batch, Department)
   - Contact information (Email, Phone Number)
   - Profile photo (passport size recommended)
3. Click "Submit and Generate ID Card"
4. The system will automatically generate and display the ID card

### Student Management
1. **View Students**: All registered students are displayed in the main dashboard table
2. **Edit Student**: Click the edit icon to modify student information
   - Note: Batch and Department fields are read-only for existing students
   - To change batch/department, delete and re-register the student
3. **Delete Student**: Click the delete icon and confirm the action
4. **Search Students**: Use the search bar to filter students by any field

### ID Card Operations
1. **Generate ID Card**: Automatic during registration
2. **Print ID Card**: Click the print icon next to any student
3. **View ID Card**: ID cards open in a new tab for printing

## 📁 Project Structure

```
faculty-management-system/
├── CSS/
│   ├── bootstrap.css
│   ├── bootstrap.min.css
│   ├── dashboard_styles.css
│   └── home.css
├── Images/
│   ├── logo.png
│   └── slideshow/
├── Include PHP/
│   └── database_connection.php
├── JS/
│   └── script.js
├── Student_Registration/
│   ├── barcode.php
│   ├── fpdf.php
│   ├── generate.php
│   ├── print_id_card.php
│   ├── registration.php
│   ├── registration_responce.php
│   ├── barcodes/
│   ├── doc/
│   ├── font/
│   ├── fonts/
│   ├── js/
│   └── makefont/
├── profile/
├── check_login.php
├── decrypt.php
├── delete_student.php
├── edit_student.php
├── home.php
├── index.php
├── logout.php
├── manage_students.php
├── setup.sql
└── README.md
```

## 🔒 Security Features

- **Session-based Authentication**: Secure admin login system
- **Input Sanitization**: All user inputs are sanitized
- **SQL Injection Prevention**: Prepared statements used throughout
- **File Upload Validation**: Image uploads are validated for type and size
- **Access Control**: Protected routes require authentication



## 📝 Academic Use Notice

This project is strictly developed for **academic purposes only**.

- Not open-source  
- Not intended for public downloading or reuse  
- Not permitted for commercial or production use  
- Redistribution without permission is prohibited


## 🙏 Acknowledgments

- Bootstrap team for the excellent CSS framework
- FPDF team for the PDF generation library
- Font Awesome for the icon set
- All contributors and users of this system


