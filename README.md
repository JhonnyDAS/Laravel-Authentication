# Laravel Authentication Project with CRUD Modules

A comprehensive Laravel 11 application featuring authentication, role-based access control (RBAC), and three complete CRUD modules (Users, Clients, Products) with an elegant Tailwind CSS interface.

## Features

- ✅ **Laravel 11** - Latest version with modern PHP 8.2+ features
- ✅ **Authentication** - Laravel Breeze with customized elegant UI
- ✅ **Role-Based Access Control** - Spatie Laravel-Permission package
- ✅ **CRUD Modules** - Users, Clients, and Products with full CRUD operations
- ✅ **Permission System** - Granular permissions (view, create, edit, delete) for each module
- ✅ **Docker MySQL** - Containerized database setup
- ✅ **Elegant UI** - Modern Tailwind CSS design with gradient sidebar and responsive layout
- ✅ **Comprehensive Tests** - Pest PHP tests covering authentication and all CRUD operations
- ✅ **CI/CD** - GitHub Actions workflow for automated testing

## Requirements

- PHP 8.2 or higher
- Composer
- Docker & Docker Compose
- Node.js & NPM (for asset compilation)

## Installation

### 1. Clone the repository

```bash
git clone <repository-url>
cd Laravel-Authentication
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install NPM dependencies and build assets

```bash
npm install
npm run build
```

### 4. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Start Docker MySQL

```bash
docker-compose up -d
```

Wait for MySQL to be ready (check with `docker-compose ps`).

### 6. Run migrations and seeders

```bash
php artisan migrate --seed
```

This will create all database tables and seed:
- ADMIN role with all permissions
- Default admin user

### 7. Start the development server

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Default Credentials

**Administrator Account:**
- Email: `admin@example.com`
- Password: `Admin123!`

> ⚠️ **IMPORTANT**: Change these credentials in production!

## Roles and Permissions

### ADMIN Role

The ADMIN role has access to all modules with the following permissions:

**Users Module:**
- `view-users` - View users list
- `create-users` - Create new users
- `edit-users` - Edit existing users
- `delete-users` - Delete users

**Clients Module:**
- `view-clients` - View clients list
- `create-clients` - Create new clients
- `edit-clients` - Edit existing clients
- `delete-clients` - Delete clients

**Products Module:**
- `view-products` - View products list
- `create-products` - Create new products
- `edit-products` - Edit existing products
- `delete-products` - Delete products

## Database Schema

### Users Table
- `id`, `name`, `email`, `password`, `email_verified_at`, `timestamps`
- Relationships: roles, permissions (via Spatie)

### Clients Table
- `id`, `name`, `email`, `phone`, `address`, `timestamps`, `soft_deletes`

### Products Table
- `id`, `name`, `description`, `price`, `stock`, `sku`, `timestamps`, `soft_deletes`

## Running Tests

Execute all tests:

```bash
php artisan test
```

Run specific test suites:

```bash
# Authentication tests
php artisan test --filter AuthenticationTest

# User CRUD tests
php artisan test --filter UserCrudTest

# Client CRUD tests
php artisan test --filter ClientCrudTest

# Product CRUD tests
php artisan test --filter ProductCrudTest
```

## CI/CD

The project includes a GitHub Actions workflow (`.github/workflows/laravel-tests.yml`) that automatically:

1. Sets up PHP 8.2 environment
2. Starts MySQL 8.0 service
3. Installs dependencies
4. Runs database migrations
5. Executes all Pest tests

The workflow runs on every push and pull request to `main`/`master` branches.

## Project Structure

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── UserController.php
│   │   │   ├── ClientController.php
│   │   │   ├── ProductController.php
│   │   │   └── DashboardController.php
│   │   └── Requests/
│   │       ├── StoreUserRequest.php
│   │       ├── UpdateUserRequest.php
│   │       ├── StoreClientRequest.php
│   │       ├── UpdateClientRequest.php
│   │       ├── StoreProductRequest.php
│   │       └── UpdateProductRequest.php
│   └── Models/
│       ├── User.php
│       ├── Client.php
│       └── Product.php
├── database/
│   ├── factories/
│   │   ├── ClientFactory.php
│   │   └── ProductFactory.php
│   ├── migrations/
│   └── seeders/
│       ├── RolePermissionSeeder.php
│       └── AdminUserSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── dashboard.blade.php
│       ├── users/
│       ├── clients/
│       └── products/
├── tests/
│   └── Feature/
│       ├── AuthenticationTest.php
│       ├── UserCrudTest.php
│       ├── ClientCrudTest.php
│       └── ProductCrudTest.php
├── docker-compose.yml
└── .github/
    └── workflows/
        └── laravel-tests.yml
```

## Development

### Adding New Permissions

1. Add permission to `RolePermissionSeeder.php`
2. Run: `php artisan db:seed --class=RolePermissionSeeder`
3. Assign permission to roles as needed

### Creating New Modules

1. Create model with migration: `php artisan make:model ModuleName -m`
2. Create controller: `php artisan make:controller ModuleNameController --resource`
3. Create Form Requests for validation
4. Add routes in `routes/web.php`
5. Create views in `resources/views/modulename/`
6. Add permissions to seeder
7. Write tests

## Technologies Used

- **Backend**: Laravel 11, PHP 8.2+
- **Database**: MySQL 8.0 (Docker)
- **Authentication**: Laravel Breeze
- **Permissions**: Spatie Laravel-Permission
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Testing**: Pest PHP
- **CI/CD**: GitHub Actions
- **Containerization**: Docker & Docker Compose

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For issues, questions, or contributions, please open an issue in the GitHub repository.
