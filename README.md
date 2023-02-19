
## Requirements

**Client:** PHP v8.1, NODE v16.15, NPM v8.5

**Server:** MySql v8


## Installation

##### 1. Clone project to local

```bash
  git clone https://github.com/aakashdesai-pro/bookshop.git
```
    

##### 2. Go to project directory

```bash
  cd bookshop
```


##### 3. Install required php dependency

```bash
  composer install
```

##### 4. Install required js dependency

```bash
  npm install
```

##### 5. Setup .env file

```bash
  cp .env.example .env
```

##### 6. Setup the db credentials
- APP_URL = 127.0.0.1::``{PORT}``

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE={db_name}
- DB_USERNAME={db_username}
- DB_PASSWORD={db_password}

##### 7. Run migration and seeder

```bash
  php artisan migrate --seed
```

##### 8. All done! Now you can run the project

```bash
  php artisan serve
```
- Note :- add running ``APP_URL`` in ``.env`` file because api will not work without ``APP_URL``.

- Admin Panel ``APP_URL/admin``



## API Reference

#### Get all books

```http
  GET /api/v1/books
```

#### Get book by id

```http
  GET /api/v1/books/${id}
```

#### Filter books

```http
  GET /api/v1/books?filter[title]=${title}&filter[author]=${author}&filter[genre]=${genre}&filter[isbn]=${isbn}&filter[published]=${published}&filter[publisher]=${publisher}
```