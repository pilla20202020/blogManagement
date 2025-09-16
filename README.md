# Blog Management System - Laravel Backend

This is a **Laravel 11 backend application** for a Blog Management System. It allows users to create, update, delete, and view blogs. The system supports **user roles**, where admin users can manage all blogs, and normal users can only manage their own blogs.

---

## Features

- User authentication with login/logout.
- Role-based access: Admin vs Normal User.
- CRUD operations for blogs.
- Blogs linked to users (`user_id`).
- Pagination for blog listing.
- API-ready for frontend integration (Vue.js recommended).
- Seeded example users for testing.

---

## Requirements

- PHP >= 8.1  
- Composer  
- MySQL or PostgreSQL  
- Node.js & npm (for frontend integration)  

---

## Installation

1. **Clone the repository**  

```bash
git clone https://github.com/pilla20202020/blogManagement
cd blogManagement

Install dependencies

composer install


Copy .env file

cp .env.example .env


Configure .env

Set your database credentials in .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_db
DB_USERNAME=root
DB_PASSWORD=your_password

Database Setup

Run migrations

php artisan migrate

Seed example users and blogs

php artisan db:seed


This will create the following example users:

Name	Email	Password	Role
Admin User	admin@test.com
	Apple@123	Admin
User 1	user1@test.com
	Apple@123	Normal
Running the Project

Start the Laravel development server

php artisan serve


Access the API

The backend will be available at:

http://127.0.0.1:8000

API Endpoints
