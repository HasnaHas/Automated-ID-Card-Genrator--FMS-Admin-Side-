# Faculty Management System (FMS) - Student ID Card Management

A comprehensive web-based system for managing student information and generating ID cards for faculty administration. Built with PHP, MySQL, and Bootstrap for a modern, responsive interface.

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

## 🔧 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/faculty-management-system.git
cd faculty-management-system
```

### 2. Database Setup
1. Create a new MySQL database named `FMS`
2. Import the database schema:
   ```sql
   -- Run the contents of setup.sql in your MySQL database
   ```

### 3. Configuration
1. Update database connection settings in `Include PHP/database_connection.php`:
   ```php
   $servername = "localhost";
   $username = "your_db_username";
   $password = "your_db_password";
   $dbname = "FMS";
   ```

2. Ensure the following directories are writable:
   - `profile/` - For student profile images
   - `Student_Registration/barcodes/` - For generated barcodes

### 4. Web Server Configuration
Place the project files in your web server's document root (e.g., `htdocs` for XAMPP).

### 5. Access the Application
Open your browser and navigate to:
```
http://localhost/faculty-management-system/
```

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

## 🗄️ Database Schema

The system uses a single `student` table with the following structure:

```sql
CREATE TABLE student (
    REGNO VARCHAR(20) PRIMARY KEY,
    INDEXNO VARCHAR(20),
    FIRSTNAME VARCHAR(50),
    LASTNAME VARCHAR(50),
    GENDER VARCHAR(10),
    BATCH VARCHAR(20),
    DEPARTMENT VARCHAR(10),
    EMAIL VARCHAR(100),
    PHONENUMBER VARCHAR(15),
    IMAGE VARCHAR(255),
    BARCODE VARCHAR(255)
);
```

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

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Support

For support, email support@fms.edu or create an issue in this repository.

## 🙏 Acknowledgments

- Bootstrap team for the excellent CSS framework
- FPDF team for the PDF generation library
- Font Awesome for the icon set
- All contributors and users of this system

---

**Note**: This system is designed for educational institutions to manage student ID cards efficiently. Ensure proper backup of the database and uploaded files regularly.
