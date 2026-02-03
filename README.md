# Book & Author Management System (Laravel)

Simple Laravel backend for managing authors and their books with CRUD APIs, relationships, and validation.

## Quick Start (Local)

```bash
git clone <your-repo-url>
cd Herody
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan serve
```

Then open: http://localhost:8000 (API status) and http://localhost:8000/api/authors, http://localhost:8000/api/books

For full details, see the sections below.

## Prerequisites

### System Requirements
- **PHP 8.2 or higher** - Download from [php.net](https://www.php.net/downloads)
- **Composer** - Download from [getcomposer.org](https://getcomposer.org)
- **Node.js 18+ & npm** (optional, for frontend assets) - Download from [nodejs.org](https://nodejs.org)
- **SQLite3, MySQL 8+, or PostgreSQL 13+** (SQLite is default, no additional setup needed)

### Supported Operating Systems
- macOS 10.13+
- Linux (Ubuntu 20.04+, etc.)
- Windows 10+ (with WSL2 recommended)

### Verify Prerequisites
```bash
# Check PHP version
php --version

# Check Composer version
composer --version

# Check Node.js version (optional)
node --version
npm --version
```

## Installation & Setup

### 1. Clone or Extract Project
```bash
cd /path/to/Herody
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Create Environment File
```bash
# Copy the example environment file
cp .env.example .env

# Or if .env.example doesn't exist, the .env file has been created
# Verify .env exists with:
ls -la | grep .env
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Configure Database

#### Option A: SQLite (Default - Recommended for Development)
No configuration needed. The default `.env` is already set to use SQLite:
```env
DB_CONNECTION=sqlite
```

#### Option B: MySQL
Update your `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=herody
DB_USERNAME=root
DB_PASSWORD=your_password
```

Ensure MySQL is running:
```bash
# macOS (with Homebrew)
brew services start mysql

# Linux
sudo systemctl start mysql

# Windows (use MySQL installer)
```

#### Option C: PostgreSQL
Update your `.env` file:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=herody
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

### 6. Run Database Migrations
```bash
php artisan migrate
```

### 7. (Optional) Seed Sample Data
```bash
php artisan db:seed
```

### 8. Install Frontend Dependencies (Optional)
```bash
npm install
npm run dev
```

### 9. Start the Development Server
```bash
php artisan serve
```

The application will be available at: **http://localhost:8000**

## Environment Variables Reference

### Application Settings
```env
APP_NAME="Book & Author Management System"     # Application name
APP_ENV=local                                   # Environment (local, production)
APP_DEBUG=true                                  # Debug mode (disable in production)
APP_URL=http://localhost:8000                  # Application URL
APP_KEY=base64:xxxxx                           # Auto-generated encryption key
```

### Database Configuration
```env
# SQLite (default)
DB_CONNECTION=sqlite

# MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=herody
DB_USERNAME=root
DB_PASSWORD=your_password

# PostgreSQL
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=herody
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

### Session & Security
```env
SESSION_DRIVER=database              # Session storage (database, file, cookie)
SESSION_LIFETIME=120                 # Session timeout in minutes
SESSION_ENCRYPT=false                # Encrypt session data
BCRYPT_ROUNDS=12                     # Password hashing rounds
```

### Cache & Queue
```env
CACHE_STORE=database                 # Cache driver (database, file, redis)
QUEUE_CONNECTION=database            # Queue driver (database, redis, sync)
```

### Logging
```env
LOG_CHANNEL=stack                    # Logging channel
LOG_LEVEL=debug                      # Log level (debug, info, warning, error)
```

### Mail (Optional)
```env
MAIL_MAILER=log                      # Mail driver (log, smtp, mailgun)
MAIL_FROM_ADDRESS=hello@example.com  # From email address
MAIL_FROM_NAME="App Name"            # From name
```

## Troubleshooting

### Common Issues

**1. "No application encryption key has been specified"**
```bash
php artisan key:generate
```

**2. "database.sqlite does not exist"**
```bash
php artisan migrate
```

**3. "Class not found" errors**
```bash
composer install
composer dump-autoload
```

**4. Permission denied errors (Linux/macOS)**
```bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

**5. Port 8000 already in use**
```bash
# Use a different port
php artisan serve --port=8001
```

**6. Database connection failed**
- Verify your `.env` database settings
- Ensure the database service is running
- Check database credentials are correct

## API Documentation

**Base URL:** `http://localhost:8000/api`

All responses are returned in JSON format.

### Response Format

#### Success Response (2xx)
```json
{
  "data": {
    "id": 1,
    "name": "Author Name",
    "email": "author@example.com",
    ...
  }
}
```

#### Error Response (4xx/5xx)
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "field_name": ["Error message"]
  }
}
```

### Headers Required

All requests should include:
```
Content-Type: application/json
Accept: application/json
```

---

## Authors Endpoints

### 1. List All Authors
**Endpoint:** `GET /api/authors`

**Description:** Retrieve a paginated list of all authors.

**Request:**
```bash
curl -X GET "http://localhost:8000/api/authors" \
  -H "Accept: application/json"
```

**Response (200 OK):**
```json
{
  "data": [
    {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "bio": "Renowned author of fiction novels",
      "created_at": "2026-02-02T14:08:18.000000Z",
      "updated_at": "2026-02-02T14:08:18.000000Z"
    },
    {
      "id": 2,
      "name": "Jane Smith",
      "email": "jane@example.com",
      "bio": "Science fiction writer",
      "created_at": "2026-02-02T15:30:45.000000Z",
      "updated_at": "2026-02-02T15:30:45.000000Z"
    }
  ],
  "links": {
    "first": "http://localhost:8000/api/authors?page=1",
    "last": "http://localhost:8000/api/authors?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "per_page": 15,
    "to": 2,
    "total": 2
  }
}
```

---

### 2. Get Single Author
**Endpoint:** `GET /api/authors/{id}`

**Description:** Retrieve a specific author by ID.

**Parameters:**
- `id` (required, integer) - The author's ID

**Request:**
```bash
curl -X GET "http://localhost:8000/api/authors/1" \
  -H "Accept: application/json"
```

**Response (200 OK):**
```json
{
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "bio": "Renowned author of fiction novels",
    "created_at": "2026-02-02T14:08:18.000000Z",
    "updated_at": "2026-02-02T14:08:18.000000Z"
  }
}
```

**Response (404 Not Found):**
```json
{
  "message": "No query results found for model [App\\Models\\Author] 1"
}
```

---

### 3. Create Author
**Endpoint:** `POST /api/authors`

**Description:** Create a new author.

**Request Body:**
```json
{
  "name": "Jane Smith",
  "email": "jane@example.com",
  "bio": "Science fiction writer"
}
```

**Request:**
```bash
curl -X POST "http://localhost:8000/api/authors" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "Jane Smith",
    "email": "jane@example.com",
    "bio": "Science fiction writer"
  }'
```

**Response (201 Created):**
```json
{
  "data": {
    "id": 2,
    "name": "Jane Smith",
    "email": "jane@example.com",
    "bio": "Science fiction writer",
    "created_at": "2026-02-03T10:15:22.000000Z",
    "updated_at": "2026-02-03T10:15:22.000000Z"
  }
}
```

**Response (422 Unprocessable Entity):**
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "name": ["The name field is required."],
    "email": ["The email has already been taken."]
  }
}
```

**Validation Rules:**
- `name` - Required, string, max 255 characters
- `email` - Optional, must be valid email format, must be unique
- `bio` - Optional, string

---

### 4. Update Author (Full)
**Endpoint:** `PUT /api/authors/{id}`

**Description:** Replace the entire author resource.

**Parameters:**
- `id` (required, integer) - The author's ID

**Request Body:**
```json
{
  "name": "Jane Smith",
  "email": "jane.smith@example.com",
  "bio": "Award-winning science fiction writer"
}
```

**Request:**
```bash
curl -X PUT "http://localhost:8000/api/authors/2" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "Jane Smith",
    "email": "jane.smith@example.com",
    "bio": "Award-winning science fiction writer"
  }'
```

**Response (200 OK):**
```json
{
  "data": {
    "id": 2,
    "name": "Jane Smith",
    "email": "jane.smith@example.com",
    "bio": "Award-winning science fiction writer",
    "created_at": "2026-02-03T10:15:22.000000Z",
    "updated_at": "2026-02-03T11:30:45.000000Z"
  }
}
```

---

### 5. Update Author (Partial)
**Endpoint:** `PATCH /api/authors/{id}`

**Description:** Partially update an author resource (only modified fields needed).

**Parameters:**
- `id` (required, integer) - The author's ID

**Request Body:**
```json
{
  "bio": "Bestselling author of sci-fi novels"
}
```

**Request:**
```bash
curl -X PATCH "http://localhost:8000/api/authors/2" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "bio": "Bestselling author of sci-fi novels"
  }'
```

**Response (200 OK):**
```json
{
  "data": {
    "id": 2,
    "name": "Jane Smith",
    "email": "jane.smith@example.com",
    "bio": "Bestselling author of sci-fi novels",
    "created_at": "2026-02-03T10:15:22.000000Z",
    "updated_at": "2026-02-03T11:45:22.000000Z"
  }
}
```

---

### 6. Delete Author
**Endpoint:** `DELETE /api/authors/{id}`

**Description:** Delete an author by ID.

**Parameters:**
- `id` (required, integer) - The author's ID

**Request:**
```bash
curl -X DELETE "http://localhost:8000/api/authors/2" \
  -H "Accept: application/json"
```

**Response (200 OK):**
```json
{
  "data": []
}
```

**Response (404 Not Found):**
```json
{
  "message": "No query results found for model [App\\Models\\Author] 999"
}
```

---

## Books Endpoints

### 1. List All Books
**Endpoint:** `GET /api/books`

**Description:** Retrieve a paginated list of all books.

**Request:**
```bash
curl -X GET "http://localhost:8000/api/books" \
  -H "Accept: application/json"
```

**Response (200 OK):**
```json
{
  "data": [
    {
      "id": 1,
      "author_id": 1,
      "title": "The Great Adventure",
      "description": "An epic tale of adventure across continents",
      "published_at": "2025-06-15",
      "created_at": "2026-02-02T14:10:30.000000Z",
      "updated_at": "2026-02-02T14:10:30.000000Z"
    },
    {
      "id": 2,
      "author_id": 1,
      "title": "Mystery of the Lost City",
      "description": "A thrilling mystery set in ancient ruins",
      "published_at": "2025-09-20",
      "created_at": "2026-02-02T14:12:45.000000Z",
      "updated_at": "2026-02-02T14:12:45.000000Z"
    }
  ],
  "links": {
    "first": "http://localhost:8000/api/books?page=1",
    "last": "http://localhost:8000/api/books?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "per_page": 15,
    "to": 2,
    "total": 2
  }
}
```

---

### 2. Get Single Book
**Endpoint:** `GET /api/books/{id}`

**Description:** Retrieve a specific book by ID.

**Parameters:**
- `id` (required, integer) - The book's ID

**Request:**
```bash
curl -X GET "http://localhost:8000/api/books/1" \
  -H "Accept: application/json"
```

**Response (200 OK):**
```json
{
  "data": {
    "id": 1,
    "author_id": 1,
    "title": "The Great Adventure",
    "description": "An epic tale of adventure across continents",
    "published_at": "2025-06-15",
    "created_at": "2026-02-02T14:10:30.000000Z",
    "updated_at": "2026-02-02T14:10:30.000000Z"
  }
}
```

---

### 3. Create Book
**Endpoint:** `POST /api/books`

**Description:** Create a new book.

**Request Body:**
```json
{
  "author_id": 1,
  "title": "The Lost Manuscript",
  "description": "A novel about discovering an ancient manuscript",
  "published_at": "2026-01-15"
}
```

**Request:**
```bash
curl -X POST "http://localhost:8000/api/books" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "author_id": 1,
    "title": "The Lost Manuscript",
    "description": "A novel about discovering an ancient manuscript",
    "published_at": "2026-01-15"
  }'
```

**Response (201 Created):**
```json
{
  "data": {
    "id": 3,
    "author_id": 1,
    "title": "The Lost Manuscript",
    "description": "A novel about discovering an ancient manuscript",
    "published_at": "2026-01-15",
    "created_at": "2026-02-03T10:20:15.000000Z",
    "updated_at": "2026-02-03T10:20:15.000000Z"
  }
}
```

**Response (422 Unprocessable Entity):**
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "author_id": ["The selected author_id is invalid."],
    "title": ["The title field is required."]
  }
}
```

**Validation Rules:**
- `author_id` - Required, must be integer, must exist in authors table
- `title` - Required, string, max 255 characters
- `description` - Optional, string
- `published_at` - Optional, valid date format (YYYY-MM-DD)

---

### 4. Update Book (Full)
**Endpoint:** `PUT /api/books/{id}`

**Description:** Replace the entire book resource.

**Parameters:**
- `id` (required, integer) - The book's ID

**Request Body:**
```json
{
  "author_id": 1,
  "title": "The Lost Manuscript - Revised Edition",
  "description": "Updated version with new chapters",
  "published_at": "2026-02-01"
}
```

**Request:**
```bash
curl -X PUT "http://localhost:8000/api/books/3" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "author_id": 1,
    "title": "The Lost Manuscript - Revised Edition",
    "description": "Updated version with new chapters",
    "published_at": "2026-02-01"
  }'
```

**Response (200 OK):**
```json
{
  "data": {
    "id": 3,
    "author_id": 1,
    "title": "The Lost Manuscript - Revised Edition",
    "description": "Updated version with new chapters",
    "published_at": "2026-02-01",
    "created_at": "2026-02-03T10:20:15.000000Z",
    "updated_at": "2026-02-03T11:35:22.000000Z"
  }
}
```

---

### 5. Update Book (Partial)
**Endpoint:** `PATCH /api/books/{id}`

**Description:** Partially update a book resource.

**Parameters:**
- `id` (required, integer) - The book's ID

**Request Body:**
```json
{
  "published_at": "2026-02-10"
}
```

**Request:**
```bash
curl -X PATCH "http://localhost:8000/api/books/3" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "published_at": "2026-02-10"
  }'
```

**Response (200 OK):**
```json
{
  "data": {
    "id": 3,
    "author_id": 1,
    "title": "The Lost Manuscript - Revised Edition",
    "description": "Updated version with new chapters",
    "published_at": "2026-02-10",
    "created_at": "2026-02-03T10:20:15.000000Z",
    "updated_at": "2026-02-03T11:40:30.000000Z"
  }
}
```

---

### 6. Delete Book
**Endpoint:** `DELETE /api/books/{id}`

**Description:** Delete a book by ID.

**Parameters:**
- `id` (required, integer) - The book's ID

**Request:**
```bash
curl -X DELETE "http://localhost:8000/api/books/3" \
  -H "Accept: application/json"
```

**Response (200 OK):**
```json
{
  "data": []
}
```

---

## Usage Examples with Postman

### Import Collection
1. Open Postman
2. Create a new collection called "Book & Author API"
3. Add the following requests:

#### Authors Collection
- **Create Author:** POST http://localhost:8000/api/authors
- **List Authors:** GET http://localhost:8000/api/authors
- **Get Author:** GET http://localhost:8000/api/authors/1
- **Update Author:** PUT http://localhost:8000/api/authors/1
- **Partial Update:** PATCH http://localhost:8000/api/authors/1
- **Delete Author:** DELETE http://localhost:8000/api/authors/1

#### Books Collection
- **Create Book:** POST http://localhost:8000/api/books
- **List Books:** GET http://localhost:8000/api/books
- **Get Book:** GET http://localhost:8000/api/books/1
- **Update Book:** PUT http://localhost:8000/api/books/1
- **Partial Update:** PATCH http://localhost:8000/api/books/1
- **Delete Book:** DELETE http://localhost:8000/api/books/1

---

## Common Status Codes

| Code | Status | Description |
|------|--------|-------------|
| 200 | OK | Request successful |
| 201 | Created | Resource created successfully |
| 204 | No Content | Resource deleted successfully (no body) |
| 400 | Bad Request | Invalid request format |
| 404 | Not Found | Resource not found |
| 422 | Unprocessable Entity | Validation failed |
| 500 | Server Error | Internal server error |

---

## Error Handling

All errors follow a consistent format:

```json
{
  "message": "Error description",
  "errors": {
    "field_name": ["Specific error message"]
  }
}
```

**Example:** Creating an author without required fields
```bash
curl -X POST "http://localhost:8000/api/authors" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{}'
```

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "name": ["The name field is required."]
  }
}
```
