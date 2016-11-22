# laravel-postman
This package allows you to export your API routes to a postman import json file

## Installation

Install the package via composer

`composer require --dev jimenezmaximiliano/laravel-postman`

Then add the service provider in config/app.php:

`JimenezMaximiliano\LaravelPostman\LaravelPostmanServiceProvider::class`

## Configuration

First, publish the package configuration file:

`php artisan vendor:publish`

Note: publishing the configuration file is optional, you can use de default package options.
### Options

#### apiURL
This is the base URL for your postman routes

default value: config('app.url')

#### collectionName
This is the postman collection name

default value: the command will ask for it

#### collectionDescription
This is the postman collection description

default value: the command will ask for it

#### apiPrefix
This is the prefix by which we identify the routes to export

default value: 'api'

#### skipHEAD
This avoids creating routes for HEAD method

default value: true

#### exportDirectory
The directory to which the postman.json file will be exported

### Configuring controllers

Add a property to your entity controller like this:

`public $postmanModel = 'App\MyEntityModel';`

### Assumtions

For POST or PUT routes, this library will add a formdata metadata to the route with parameters in your model's fillable property

## Usage

`php artisan laravelPostman:export`
