# KnightFlight

This is an implementation of the KnightFlight website for the Final Assignment of CS280.

## About

KnightFlight is an airline website built with Laravel that demonstrates the framework's core features and best
practices. The application showcases modern Laravel development techniques including:

- Authentication and authorization
- Database migrations and Eloquent ORM
- Form validation and request handling
- Inertia integration with Svelte
- Tailwind CSS for styling

## Getting Started

To run this application locally, follow the instructions in the [Laravel documentation](https://laravel.com/docs) to get
your development server up and running or follow the steps below.

1. Install Laravel, PHP, and Composer (https://php.new)
2. Install Node.JS v26 (https://nodejs.org/en/download/current)
3. Clone and cd to project folder
4. `npm install`, `npm run build`, `composer install`
5. Seed the database: `php artisan db:seed --class=MerchSeeder`
6. Spin up a local dev server `composer run dev`
7. Go to [localhost:8000](localhost:8000)

## Where to look for Final Assignment

Ideally, what the final project requires is to record data into the database. So below are the files to look for grading
the assignment.

1. database/database.sqlite (yes, I ended up using sqlite, please seed the database)
2. app/http/controllers/dashboard/MerchController.php (contains the insert logic to db, in the "store function", as per
   requirement)

## Issues

I did not have enough time to iron out all of the issues, here are some below.

1. Can submit form multiple times repeatedly
2. Creates too many new customer entry per user id (i know it should be one to one)
3. Receipts can be viewed by anyone
4. The relationships are not correct in some cases
5. Userid and customerid mixing because i did not modify user id enough
6. Still asks for user data in the merch even with signed in

But at least the assignment is done in the most complicated way possible.

## License

The project is open-sourced software licensed under the [Apache 2.0](https://opensource.org/licenses/Apache-2.0).
