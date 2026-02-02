# Book & Author Management System (Laravel)

Simple Laravel backend for managing authors and their books with CRUD APIs, relationships, and validation.

## Requirements
- PHP 8.2+
- Composer

## Setup
1. Copy environment file (already created by scaffold):
	- .env
2. Install dependencies:
	- composer install
3. Run migrations:
	- php artisan migrate
4. Run the server:
	- php artisan serve

The default database is SQLite (database/database.sqlite). Update .env if you prefer MySQL/PostgreSQL.

## API Endpoints
Base URL: /api

### Authors
- GET /authors
- POST /authors
- GET /authors/{author}
- PUT /authors/{author}
- PATCH /authors/{author}
- DELETE /authors/{author}

### Books
- GET /books
- POST /books
- GET /books/{book}
- PUT /books/{book}
- PATCH /books/{book}
- DELETE /books/{book}

## Validation Rules (summary)
### Authors
- name: required, string, max 255
- email: nullable, email, unique
- bio: nullable, string

### Books
- author_id: required, exists in authors
- title: required, string, max 255
- description: nullable, string
- published_at: nullable, date
