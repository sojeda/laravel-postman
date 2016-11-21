<?php

namespace JimenezMaximiliano\LaravelPostman;

class Helper
{
    const CONTROLLER_STRING_INDEX = 0;
    
    public function __construct()
    {
    }
    
    public function addTrailingSlash($url)
    {
        return $url  . (substr($url, -1) === '/' ?: '/');
    }
    
    public function replaceGetParameters($path)
    {
        return str_replace(['{', '}'], [':', ''], $path);
    }
    
    public function getBaseURL()
    {
        $configURL = config('laravelPostman.apiURL');
        
        if (!empty($configURL)) {
            
            return $this->addTrailingSlash($configURL);
        }
        
        return $this->addTrailingSlash(config('app.url'));
    }
    
    public function getApiPrefix()
    {
        $apiPrefix = config('laravelPostman.apiPrefix');
        
        return !empty($apiPrefix) ? $apiPrefix : 'api';
    }
    
    public function getCollectionStructure($collectionName, $collectionDescription)
    {
        return [
            'variables' => [],
            'info' => [
                'name' => $collectionName,
                '_postman_id' => uniqid(),
                'description' => $collectionDescription,
                'schema' => 'https://schema.getpostman.com/json/collection/v2.0.0/collection.json',
            ],
            'item' => [],
        ];
    }
    
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
    
    public function getExportDirectory()
    {
        $exportDirectory = config('laravelPostman.exportDirectory');
        
        if (empty($exportDirectory)) {
            return $exportDirectory;
        }
        
        return $this->addTrailingSlash($exportDirectory);
    }
}
