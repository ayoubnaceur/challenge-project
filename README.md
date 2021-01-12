# Software Engineer - Coding challenge

## Installation

Clone the current repository to your development environment or downloaded it as zip.

```bash
git clone https://github.com/ayoubnaceur/challenge-project.git
```

Install dependencies.

```bash
composer install
npm install
```

Configure database connection (environment variables in`.env` file). (if the ` .env` file not existed make one using a ` .env.example` copy )

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=challenge_project
DB_USERNAME=root
DB_PASSWORD=
```

Create and fill database schema

```bash
php artisan migrate --seed
```

Build the front & run the back

```bash
npm run dev
php artisan serve
```

Project should be ready now

## Interact with the project

### Web interactions

-   Add a product
-   List Products
-   Filter & sorting products

    ``` bash
    http://127.0.0.1:8000/
    ```

### CLI interactions

-   Add a product

    ```bash
    php artisan appdo:createProduct name description price image categories
    ```

    > name: name of product
    > description: name of product
    > price: price
    > image: image URL
    > categories: list of numbers separated by space (it's optional)

    ```bash
    php artisan appdo:createProduct prod1 desc1 1000 "https://yourImageLink" 1 2
    ```

-   Delete a product

    ```bash
    php artisan appdo:deleteProduct id
    ```

    > id: the id of category (can be choosed from the web app)

-   Add a category

    ```bash
    php artisan appdo:createCategory name --root
    ```

    > name : the name of category
    >
    > --root[=number] : Category parent-category id (if number not specified null will be the default (root category))

-   Delete a category

    ```bash
    php artisan appdo:deleteCategory id
    ```

    > id: the id of category (can be choosed from the web app)	

## Application Features

### Implementing design patterns

-   Repository and Service architectural patterns
-   Full patterns integrations (Using Interfaces (Group work) & Inheritance(DRY, ..) )
-   Use Laravel [API Resources](https://laravel.com/docs/8.x/eloquent-resources)

### Automated tests

-   Testing application status
-   Testing adding a new product && if it is returned after adding
-   Testing adding new product with non valid data

Run the test using

```bash
php artisan test
```

---

That’s it ! Thank you :)
