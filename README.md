
# Todo API

This is a **Todo API** built with Laravel. It provides a backend service for managing tasks, allowing users to create, read, update, and delete todos efficiently.

## Features

- User authentication (e.g., using Laravel Sanctum or Passport).
- CRUD operations for managing todos.
- Exception handling and meaningful API responses.
- Validations for all endpoints.
- Logging of errors and system events.
- Optimized for scalability and ease of use.

## Installation

### Prerequisites

- PHP >= 8.0
- Composer
- Laravel >= 10.x
- Database (MySQL, PostgreSQL, etc.)

### Steps to Install

1. Clone the repository:
   ```bash
   git clone https://github.com/Dawaki1/devfoundry-todo.git
   cd todo-api
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Set up the `.env` file:
   ```bash
   cp .env.example .env
   ```

4. Configure your database and other environment variables in `.env`.

5. Generate the application key:
   ```bash
   php artisan key:generate
   ```

6. Run database migrations:
   ```bash
   php artisan migrate
   ```

7. (Optional) Seed the database:
   ```bash
   php artisan db:seed
   ```

8. Start the development server:
   ```bash
   php artisan serve
   ```

## API Endpoints

### Authentication

| Method | Endpoint         | Description           |
|--------|------------------|-----------------------|
| POST   | `/api/register`  | Register a new user. |
| POST   | `/api/login`     | Log in a user.       |

### Todos

| Method | Endpoint             | Description                 |
|--------|----------------------|-----------------------------|
| GET    | `/api/todos`         | Retrieve all todos.         |
| GET    | `/api/todos/{id}`    | Retrieve a specific todo.   |
| POST   | `/api/todos`         | Create a new todo.          |
| PUT    | `/api/todos/{id}`    | Update an existing todo.    |
| DELETE | `/api/todos/{id}`    | Delete a specific todo.     |

### Request and Response Examples

#### Create Todo

**Request**:  
POST `/api/todos`

```json
{
  "title": "Finish project",
  "description": "Complete the Laravel API project",
  "dateline": "2025-01-20",
  "completed": false
}
```

**Response**:

```json
{
  "status": 201,
  "message": "Task added successfully",
  "data": {
    "id": 1,
    "title": "Finish project",
    "description": "Complete the Laravel API project",
    "dateline": "2025-01-20",
    "completed": false
  }
}
```

#### Retrieve Todos

**Request**:  
GET `/api/todos`

**Response**:

```json
{
  "status": 200,
  "message": "Todos retrieved successfully",
  "data": [
    {
      "id": 1,
      "title": "Finish project",
      "description": "Complete the Laravel API project",
      "dateline": "2025-01-20",
      "completed": false
    },
    {
      "id": 2,
      "title": "Read a book",
      "description": "Read 'Clean Code' by Robert C. Martin",
      "dateline": "2025-01-25",
      "completed": true
    }
  ]
}
```

## Error Handling

The API uses standardized error responses. Common status codes:

- `200 OK`: Request succeeded.
- `201 Created`: Resource created successfully.
- `400 Bad Request`: Validation or input error.
- `404 Not Found`: Resource not found.
- `500 Internal Server Error`: Unexpected server error.


## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contributing

Feel free to fork the repository and submit pull requests. All contributions are welcome!
