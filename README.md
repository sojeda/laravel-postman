# laravel-postman
This package allows you to export your API routes to a postman import json file, original work by https://github.com/sojeda/laravel-postman

## Installation

Install the package via composer

`composer require --dev phpsa/laravel-postman`

Then add the service provider in config/app.php:

### PHP >= 5.5

`Phpsa\LaravelPostman\ServiceProvider::class`

### PHP < 5.5

`Phpsa\LaravelPostman\ServiceProvider`

## Configuration

First, publish the package configuration file:

`php artisan vendor:publish --provider="Phpsa\LaravelPostman\ServiceProvider" --tag="config"`

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

## Usage

### Configuring controllers

Add a property to your entity controller like this:

`public $postmanModel = 'App\MyEntityModel';`

### Add a public method to your model class like this:

`
public function getPostmanParams()
{
    return $this->fillable;
}
`

This array of params will be used to fill POST and PUT urlencoded form data section in 
postman. The previous method is just an example, you should return the array of 
params that you want to see in postman.

### Export

`php artisan laravelPostman:export`
