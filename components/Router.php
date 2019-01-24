<?php

/**
 * summary
 */
class Router {

	private $routes;

	public function __construct(){
		$routesPath = ROOT.'/config/routes.php'; //Путь к роутам
		$this->routes = include($routesPath);	//Присвоили routes массив с файла
	}

	private function getURI(){
		// Метод возвращает строку
		if(!empty($_SERVER['REQUEST_URI'])){
			return trim($_SERVER['REQUEST_URI'],'/');
		}
		
	}
	public function run(){
		// Получить строку запроса
		$uri = $this->getURI();
		// Проверить наличие такого запроса в routes.php
		foreach ($this->routes as $uriPattern => $path) {
			
			//Сравниваем $uriPattern и $uri
			if(preg_match("~$uriPattern~", $uri)){
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
				// Если есть совпадение, то определить какой контроллер и action, параметры обработает запрос
				$segments = explode('/', $internalRoute);
				$controllerName = array_shift($segments).'Controller';
				$controllerName = ucfirst($controllerName);
				$actionName = 'action'. ucfirst(array_shift($segments));
				$parameters = $segments;

				// Подключить файл класса-контроллера
				$controllerFile = ROOT.'/controller/'.$controllerName .'.php';
				if(file_exists($controllerFile)){
					include_once($controllerFile);
				}
				// Создать обьект класса контроллера, вызвать метод action
				$controllerObject = new $controllerName;   //Просто используя переменные
				$result = call_user_func_array(array($controllerObject, $actionName),$parameters);
				
				if($result != null){
					break;
				}
			}
		}
		
		
		
		
	}
   
}