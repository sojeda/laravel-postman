<?php

namespace JimenezMaximiliano\LaravelPostman;

class Helper
{
    const CONTROLLER_STRING_INDEX = 0;
    const POSTMAN_SCHEMA = 'https://schema.getpostman.com/json/collection/v2.0.0/collection.json';
    
    /**
     * Class constructor
     */
    public function __construct()
    {
    }
    
    /**
     * Adds a trailing slash to the given path if it isn't already there
     * 
     * @param string $path
     * @return string
     */
    public function addTrailingSlash($path)
    {
        return $path  . (substr($path, -1) === '/' ?: '/');
    }
    
    /**
     * Replaces laravel route parameters format with Postman parameters format
     * 
     * @param string $path
     * @return string
     */
    public function replaceGetParameters($path)
    {
        return str_replace(['{', '}'], [':', ''], $path);
    }
    
    /**
     * Returns the API base URL
     * 
     * @return string
     */
    public function getBaseURL()
    {
        $configURL = config('laravelPostman.apiURL');
        
        if (!empty($configURL)) {
            
            return $this->addTrailingSlash($configURL);
        }
        
        return $this->addTrailingSlash(config('app.url'));
    }
    
    /**
     * Returns the API prefix string
     * 
     * @return string
     */
    public function getApiPrefix()
    {
        $apiPrefix = config('laravelPostman.apiPrefix');
        
        return !empty($apiPrefix) ? $apiPrefix : 'api';
    }
    
    /**
     * Returns a postman collection structure array
     * 
     * @param string $collectionName
     * @param string $collectionDescription
     * @return array
     */
    public function getCollectionStructure(
            $collectionName, 
            $collectionDescription)
    {
        return [
            'variables' => [],
            'info' => [
                'name' => $collectionName,
                '_postman_id' => uniqid(),
                'description' => $collectionDescription,
                'schema' => self::POSTMAN_SCHEMA,
            ],
            'item' => [],
        ];
    }
    
    /**
     * Obtains a postman folder name from the given laravel route
     * 
     * @param Illuminate\Routing\Route $route
     * @return string
     */
    public function getRouteFolder($route)
    {
        $actionStringParts = explode('@', $route->getActionName());
        
        if (count($actionStringParts) === 1) {
            
           return 'Others'; 
        }
        
        $fullController = $actionStringParts[self::CONTROLLER_STRING_INDEX];
        $controllerClass = explode('\\', $fullController);
        
        return  str_replace('Controller', '', last($controllerClass));
    }
    
    /**
     * Returns the path where the exported file will be located
     * 
     * @return string
     */
    public function getExportDirectory()
    {
        $exportDirectory = config('laravelPostman.exportDirectory');
        
        if (empty($exportDirectory)) {
            
            return $exportDirectory;
        }
        
        return $this->addTrailingSlash($exportDirectory);
    }
}
