-- Create Database
CREATE DATABASE IF NOT EXISTS portfolio_db;
USE portfolio_db;

-- 1. Admin Table
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Demo Admin Credentials
INSERT INTO admin (username, password) VALUES ('yogeshpal1309@gmail.com', 'typ@admin');

-- 2. Projects Table
CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(255),
    image VARCHAR(255),
    link VARCHAR(255),
    technologies TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Initial Projects Data
INSERT INTO projects (title, category, image, link, technologies) VALUES 
('AuraPark', 'Parking Management System (Website + Software)', './images/Screenshot 2026-01-16 134513.png', 'https://aurapark.runasp.net/', 'HTML, CSS, Javascript, ASP.NET Core, C#, MSSQL'),
('Syntax Academy', 'Student Management System (Website + Software)', './images/syntax-academy.png', 'https://syntax-academy.runasp.net/', 'HTML, Javascript, MSSQL, ASP.NET Core, Bootstrap'),
('RiskFlight', 'Library Management System (Software)', './images/Screenshot 2025-09-10 121537.png', '#', 'C#, WinForms, MSSQL'),
('Nurture Nest', 'Non Government Organization (Website)', './images/nurture-nest.png', 'https://nurture-nest-foundation.netlify.app/', 'HTML, CSS, JavaScript'),
('Amber Archives', 'E-Commerce Website (Website)', './images/Amber-Archives.png', 'https://amber-ecommerce.netlify.app/', 'React.js, Tailwind, API'),
('Er. Yogesh Pal', 'Personal Portfolio (Website)', './images/Yogesh-pal.png', '#', 'HTML, CSS, Bootstrap'),
('Fanta', 'Built Using GSAP (Webpage)', './images/fanta.png', 'https://fanta-yogesh.netlify.app/', 'GSAP, JavaScript, CSS'),
('Dream Places', 'Trip Planner (Website)', './images/travel-website.png', '#', 'HTML, CSS, JavaScript'),
('Calculator', 'Built Using Javascript (Mini Project)', './images/calculator.png', 'https://theyogeshpal.github.io/calculator-yogesh-pal/', 'JavaScript, HTML, CSS');

-- 3. Certificates/Timeline Table
CREATE TABLE IF NOT EXISTS certificates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    year VARCHAR(10),
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    side ENUM('left', 'right') DEFAULT 'left',
    aos VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Initial Certificates Data
INSERT INTO certificates (year, title, description, image, side, aos) VALUES 
('2025', 'Summer Training (45 Days)', 'Completed intensive training at Digicoders Technologies Pvt. Ltd., specializing in Dot Net Core development and earning the "Star Performance Award".', './images/summer-training.jpeg', 'left', 'fade-right'),
('2023', 'Advanced Diploma in IT', 'Successfully completed 15 months Advanced diploma in Information Technology, gaining deep knowledge in software development and IT infrastructure.', './images/ADIT.jpeg', 'right', 'fade-left'),
('2023', 'Li-Fi & Wi-Fi Workshop', 'Received Certificate of Appreciation in Li-Fi & Wi-Fi Workshop organized by the Institute of Computer Education, Bareilly.', './images/1770582295_WhatsApp Image 2026-02-01 at 18.29.41 (1).jpeg', 'left', 'fade-right');

-- 4. About Table
CREATE TABLE IF NOT EXISTS about (
    id INT AUTO_INCREMENT PRIMARY KEY,
    para1 TEXT,
    para2 TEXT,
    para3 TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 5. Contacts Table (for Contact Form)
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    mobile VARCHAR(20),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 6. Education Table
CREATE TABLE IF NOT EXISTS education (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Initial Education Data
INSERT INTO education (title) VALUES 
('Pursuing Polytechnic Diploma In CSE.'),
('Intermediate From NIOS Board (2025).'),
('High School From CBSE Board (2023).');


-- 7. Strengths Table
CREATE TABLE IF NOT EXISTS strengths (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Initial Strengths Data
INSERT INTO strengths (title) VALUES 
('Logical and Analytical ability for new project and application.'),
('Good verbal and presentation skills.'),
('A quick learner and eager to up to date in IT industry with Programming language Development tools.'),
('Public Speaking and Presentation Skills.');

-- 8. Technical Knowledge Table
CREATE TABLE IF NOT EXISTS technical_knowledge (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Initial Technical Knowledge Data
INSERT INTO technical_knowledge (title) VALUES 
('C, C#, Java'),
("Rest API's, Postman"),
('ASP.NET Core MVC, Entity Framework, MSSQL'),
('Spring Boot, JSP, MySQL, Java web development'),
('React.js, React Router, Axios'),
('AOS, Animate.CSS, GSAP'),
('JQuery, JSON, AJAX, Bootstrap, Tailwind CSS'),
('HTML, HTML-5, CSS, CSS-3, JavaScript'),
('Git, GitHub');

