# News Feed Application

This is a Laravel-based web application that displays news articles in a paginated table with sorting and search functionality.

## Installation

### Prerequisites

- PHP >= 7.3
- Composer
- Node.js & npm
- Git

### Steps

1. **Clone the repository:**
    ```sh
    https://github.com/Akkshatt/news-feed.git
    cd news-feed
    ```

2. **Install dependencies:**
    ```sh
    composer install
    npm install
    ```

3. **Set up environment variables:**
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

4. **Run migrations (if any):**
    ```sh
    php artisan migrate
    ```

5. **Serve the application:**
    ```sh
    php artisan serve
    ```

6. **Access the application in your browser:**
    ```sh
    http://127.0.0.1:8000
    ```

## Packages Used

- Laravel Framework: 8.x
- Guzzle HTTP: ^7.0 (for making HTTP requests)
- FontAwesome: 6.1.1 (for icons)

## Features

- Display news articles in a table
- Search functionality
- Pagination
- Sorting by columns
- Dark and light mode

## Usage

1. Navigate to the homepage.
2. Use the search bar to filter news articles.
3. Click on table headers to sort the news articles.
4. Use the pagination links at the bottom to navigate through pages.

## Contributing

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Commit your changes (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature-branch`).
5. Create a new Pull Request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

For any inquiries, please contact [kakshat43@gmail.com](mailto:kakshat43@gmail.com).

