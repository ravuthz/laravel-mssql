
# Set Up Project

## Clone Project from this repostiry
```
git clone https://github.com/ravuthz/laravel-mssql.git
```

## Configure development environments
1.  Copy .env from .env.example

	```
	cp .env.example .env 
	```

2. Then configure database in .env file as example below:
	```
	DB_CONNECTION=sqlsrv
	DB_HOST=127.0.0.1
	DB_PORT=1433
	DB_DATABASE=laravel_jwt
	DB_USERNAME=SA
	DB_PASSWORD=1313xfW3F55F$<U
	```

3. Install dependecies, make sure you have [composer](https://getcomposer.org/download) installed:
	```
	composer install
	```

4. Generate laravel application key, make sure you have [php](http://php.net/manual/en/install.php) installed:
	```
	php artisan key:generate
	```
## Start and testing server
1. Now you can browse your server with default port [8000](http://127.0.0.1:8000) after type command below
	```
	php artisan serve
	```
	When server started you will see this message:
	```
	Laravel development server started: <http://127.0.0.1:8000>
	```

2. Migrate laravel database, laravel will generate some tables for you:
	```
	php artisan migrate
	```

	Then you will see this successfully messages:
	```
	Migration table created successfully.
	Migrating: 2014_10_12_000000_create_users_table
	Migrated:  2014_10_12_000000_create_users_table
	Migrating: 2014_10_12_100000_create_password_resets_table
	Migrated:  2014_10_12_100000_create_password_resets_table
	Migrating: 2019_02_23_0329201_create_schedules_table
	Migrated:  2019_02_23_0329201_create_schedules_table
	Migrating: 2019_02_23_032920_create_rooms_table
	Migrated:  2019_02_23_032920_create_rooms_table

	```
