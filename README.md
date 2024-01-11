# API_Blog

API Blog is a simple blogging platform that exposes a RESTful API for creating, reading, updating, and deleting blog posts, authors, and categories.

## Features
- Create, read, update, and delete blog posts.
- Each post can have one or more categories.
- Each post is associated with an author.

### Models
- Post
  - The Post model handles all database interactions related to blog posts. It has the following methods:
    - getAllPosts(): Retrieves all posts from the database.
    - getPostById(int $id): Retrieves a single post by its ID, along with its author and categories.
    - addArticle(string $title, string $content, string $author_name, string $email, array $categories): Adds a new article to the blog.
- Author
  - The Author model handles all database interactions related to authors. It has the following methods:
    - getAllAuthors(): Retrieves all authors from the database.
    - getAuthorById(int $id): Retrieves a single author by their ID, along with their posts.
    - addAuthor(string $name, string $email): Adds a new author to the blog.
- Category
  - The Category model handles all database interactions related to categories. It has the following methods:
    - getAllCategories(): Retrieves all categories from the database.
    - getCategoryById(int $id): Retrieves a single category by its ID, along with its posts.
    - addCategory(string $name): Adds a new category to the blog.

#### Setup
1. Clone the repository: `git clone https://github.com/username/api_blog.git`
2. Navigate into the project directory: `cd api_blog`
3. Install dependencies: `composer install`
4. Create a .env file and configure your database connection details.
5. Run the database migrations: `php artisan migrate`
6. Start the server: `php artisan serve`

##### Usage
You can interact with the API using any HTTP client like curl, Postman, or even your browser (for GET requests). Here's an example of creating a new post using curl:

###### Contributing
Contributions are welcome! Please feel free to submit a Pull Request.

###### License
API Blog is open-sourced software licensed under the MIT license.