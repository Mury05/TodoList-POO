<?php
namespace App;

class Router{
    private $routes = [];
    public function get(string $url, callable $action){
        $this->addRoute('GET', $url, $action);

    }
    public function post(string $url, callable $action){
        $this->addRoute('POST', $url, $action);
    }
    public function update(string $url, callable $action){
        $this->addRoute('PUT', $url, $action);

    }
    public function delete(string $url, callable $action){
        $this->addRoute('DELETE', $url, $action);

    }

    private function addRoute(string $method, string $url, callable $action){
        $this->routes[] = [
            'method' => $method,
            'url'=> $url,
            'action'=> $action,
        ];
    }
}