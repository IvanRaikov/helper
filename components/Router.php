<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Router{
    private $routes;
    
    public function __construct() {
        $this->routes = require ROOT.'/config/routes.php';
    }
    public function run(){
        $uri = $this->getUrl();
        foreach($this->routes as $uriPattern =>$path){
            if(preg_match("~$uriPattern~",$uri)){
                $segments = preg_replace("~$uriPattern~",$path,$uri);
                $segments = explode('/',$segments);
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = array_shift($segments);
                $actionName = 'action'.ucfirst($actionName);
                $controllerFile = $controllerName.'.php';
                if(file_exists($controllerFile)){
                    include_once($controllerFile);
                }
                require ROOT."/controllers/".$controllerFile;
                $controller = new $controllerName();
                $result = call_user_func_array(array($controller, $actionName), $segments);
                if($result){
                    break;
                }
                
            }
        }
    }
    private function getUrl(){
        if(empty($_SERVER['REQUEST_URI'])){
            return $uri = '/';
        }
        return $uri = trim($_SERVER['REQUEST_URI'],'/');
        
    }
}
