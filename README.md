# P-O-S

P-O-S is a Laravel-based Point-of-Sale system for managing products, customers, staff accounts, inventory, and sales transactions.

## Features

- Secure staff login and logout
- Protected management pages
- Product CRUD with image upload and processing
- Customer CRUD
- Staff CRUD with avatar upload
- Hashed staff passwords
- Sale recording with optional customer selection
- Automatic inventory deduction
- Prevention of sales exceeding available stock
- Sales history with product, customer, staff, quantity, total, and date

## Technologies Used

- Laravel 12
- PHP
- MySQL
- Blade
- Tailwind CSS
- Laravel Breeze
- Intervention Image
- XAMPP

## Database Tables

The project uses the following related tables:

- `products`
- `customers`
- `users`
- `sales`

Database migrations and seeders are included in the `database` directory.

## Installation

### 1. Clone the repository

```bash
git clone REPOSITORY_URL
cd Final_POS
```

Replace `REPOSITORY_URL` with the actual GitHub repository link.

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Create the environment file

On Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

### 4. Generate the application key

```bash
php artisan key:generate
```

### 5. Configure the database

Create a MySQL database named:

```text
final_pos
```

Update these values in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=final_pos
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Create and seed the database tables

```bash
php artisan migrate --seed
```

### 7. Create the storage link

```bash
php artisan storage:link
```

### 8. Install and build frontend assets

For Windows PowerShell:

```powershell
npm.cmd install
npm.cmd run build
```

### 9. Start the application

```bash
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

## Default Local Account

```text
Username: admin
Password: Password123!
```

This account is provided only for local demonstration and testing.

## Author

The members