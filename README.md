# Catmash

Catmash is a web application that allows users to compare two cats and vote on which one is cuter. The Elo-based algorithm is used to adjust each cat's rating based on the outcome of each comparison, so that the rankings of the cats will reflect their overall popularity over time.

## Installation

To install Catmash, follow these steps:

1. Clone this repository to your local machine using `git clone https://github.com/khannoussi-malek/catmash.git`.
2. Install the necessary dependencies by running `composer install` and `npm install`.
3. Create a new database in your MySQL server and set the connection details in the `.env` file.
4. Run the database migrations using `php artisan migrate`.
5. Seed the database with sample cats using `php artisan db:seed`.
6. Start the Laravel development server by running `php artisan serve`.

## Usage

Once the application is installed and running, you can access it in your web browser at `http://localhost:8000`. The homepage will display two randomly selected cats for the user to compare and vote on. The Elo rating of each cat will be updated based on the outcome of the comparison.

### Comparing cats

To compare two cats, simply click on the one you think is cuter. The page will automatically refresh with two new cats to compare.

### Viewing the leaderboard

To view the leaderboard of cats ranked by their Elo ratings, click on the "Leaderboard" link.

## Seeding the database

To seed the database with sample cats, you can use the `CatsTableSeeder` provided in the `database/seeds` directory. Simply run the following command:

```php artisan db:seed --class=CatsTableSeeder```

This will populate the `cats` table with sample data for you to use in the application.
