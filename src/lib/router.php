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
     * If the calback does not exist, return a 404 error
     * @return mixed
     */
    public function start() {

        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        $path = parse_url($uri, PHP_URL_PATH);

        $callback = $this->routes[$method][$path] ?? false;

        // var_dump($path);
        if ($callback === false) {
            http_response_code(404);
            require __DIR__ . '../views/404.php';
            return;
        }
        echo call_user_func($callback);
    }
    
}

?>