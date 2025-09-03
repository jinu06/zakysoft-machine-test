<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Installation

1. Clone the repository and set up the environment file:
   Copy .env.example and rename it to .env
2. Run the following commands:
   -> Composer Install
   -> php artisan key:generate
   -> php artisan storage:link
3. Configure your database settings in the .env file, then run:
   -> php artisan migrate --seed
4. Start your Laravel application (local environment):
   -> php artisan serve

## Used Features

Back-end (Laravel)

Traits – Used for Json Response

Jobs – Handle queued background tasks .

Eloquent ORM Relationships – Define relationships such as hasMany, belongsTo, etc.

Database Migrations – Version-controlled database schema management.

Sanctum for tokenized authentication

Events and Litseners

Global middleware Registartion for api which ensures the given request header will set the Accept application/json format

Request Classes for each post request

Attribute Casts

## Routes Overview

1. /user

Json Response of autheticated User.

2. /api/inventory/report

A GET API endpoint that returns the reports.

3. /api/stock-movements

A Post API endpoint that creates the new stock movements and trigger the Event and Queue Job

4. /api/login

A POST API endpoint used to Login

5. /api/logout

A Post API endpoint used to logout

6. api/register

A Post API endpoint used to Register
