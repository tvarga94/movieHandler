1. Clone the repository: `git clone git@github.com:tvarga94/movieHandler.git`
2. Install the dependencies `composer install`
3. Copy the content of the `.env.example` into a `.env` file
4. Connect to the database. Change the `DB_DATABASE=...` to your local database name
5. Run the `php artisan migrate` to generate the database
6. Run the `php artisan db:seed` to run the seeder files (to populate the database)
7. Run the `php artisan serve` to start the local server
8. Visit the `/api/documentation` to access the dashboard
9. The `composer.json` script section contains all the unable scripts
10. Run the tests with `php artisan test`
