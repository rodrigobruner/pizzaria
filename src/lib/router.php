<?php
/**
 * Router class
 * Manage the routes of the application
 *
 * @autor: Rodrigo Bruner
 */


class Router {

    /**
     * Routes
     * @var array
     */
    private $routes = [];

    /**
     * Add a route to the HTTP GET method
     * @param string $path
     * @param callable $callback
     */
    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    /**
     * Add a route to the HTTP POST method
     * @param string $path
     * @param callable $callback
     */
    public function post($path, $callback) {
        $this->routes['POST'][$path] = $callback;
    }

    /**
     * Resolve the route
     * Call the callback of the route
     * If the route does not exist, return a 404 error
     * @return mixed
     */
    public function start() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['PATH_INFO'] ?? '/';
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            http_response_code(404);
            require __DIR__ . '../views/404.php';
            return;
        }
        echo call_user_func($callback);
    }
    
}

?>