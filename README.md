# TransIN

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About

This is a full-stack delivery management application built with Laravel for the backend and React for the frontend. It is designed to support role-based functionality:

Admin: Can create, edit, assign, and delete delivery jobs, as well as manage drivers and track job statuses.

Driver: Can view assigned jobs, see job details, and update the delivery status.

The project provides a clean API, secure authentication, and a responsive interface to efficiently manage delivery operations.

## Table of Contents

- [Prerequisites](#prerequisites)
- [Backend Setup](#backend-setup)
  - [First step](#first-step)
  - [Second step](#second-step)
  - [Third step](#third-step)
- [Frontend Setup](#frontend-setup)
- [Conclusion](#conclusion)
- [Contact](#contact)

## Prerequisites

Before getting started, make sure you have the following prerequisites installed on your system:

### Backend

- Composer v2.5.8
- PHP v8+
- Laravel v12+
- MySQL v8+

### Frontend

- ![React-Vite Logo](https://img.shields.io/badge/Vite-B73BFE?style=for-the-badge&logo=vite&logoColor=FFD62E) v7.1.7
- nodeJS v24.11.0(Developed and tested with this version)
- npm v11.6.1

## Backend Setup

Follow these steps to set up the project:

### First step

1. Create a new file called `.env` and copy the contents from `.env.example`.
2. Fill in the database variables in the `.env` file with the correct database information. Here's a sample:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=myDatabase
   DB_USERNAME=root
   DB_PASSWORD=root
   ```

   You may need to modify other variables in the file if necessary.

### Second step

After cloning the repository and opening it, execute the following commands in your terminal:

- Change directory to the `backend` folder:

  ```
  cd backend
  ```

- Installs the project dependencies with Composer:

  ```
  composer install
  ```

- Executes the Laravel migrations:

  ```
  php artisan migrate
  ```

- Seeds the database with initial data:

  ```
  php artisan seed
  ```

Make sure all these commands are successfully executed.

Additionally, check your `.env` file to ensure that the **APP_KEY** variable is filled. If it is not filled, generate a new key by running the following command in the terminal:

```
php artisan key:generate
```

### Third step

If you are using Apache server, there's no additional setup required. However, if you are not using Apache, run the following command in the terminal:

```
php artisan serve
```

This command will start the development server, and you will be able to access the home page of the project.

## Frontend Setup

First change directory to the `frontend` folder:

```
cd frontend
```

- install dependencies

```
npm install
```

- after this installiation you just need to run the dev server

```
npm run dev
```

## Conclusion

This project demonstrates a fully functional Laravel backend with a React frontend, featuring role-based access, job management, and real-time updates. With clear API routes, intuitive frontend components, and integrated authentication.

## Contact

If you have any questions about the project feel free to get in touch with me:

`ggabor.gabor25@gmail.com`
