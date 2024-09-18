<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use Dotenv\Dotenv;
    use FastRoute\RouteCollector;
    use function FastRoute\simpleDispatcher;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

// Load environment variables
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

// Create Request and Response objects
    $request = Request::createFromGlobals();
    $response = new Response();

// Define routes
    $dispatcher = simpleDispatcher(function(RouteCollector $r) {
        require_once __DIR__ . '/../routes/web.php';
    });

// Fetch method and URI
    $httpMethod = $request->getMethod();
    $uri = $request->getPathInfo();

// Route the request
    $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
            $response->setStatusCode(404);
            $response->setContent('404 Not Found');
            break;
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $routeInfo[1];
            $response->setStatusCode(405);
            $response->setContent('405 Method Not Allowed');
            break;
        case FastRoute\Dispatcher::FOUND:
            $handler = $routeInfo[1];
            $vars = $routeInfo[2];
            [$class, $method] = explode('@', $handler);
            $class = 'App\\Controllers\\' . $class;
            $controller = new $class($request, $response);
            $response = call_user_func_array([$controller, $method], $vars);
            break;
    }

// Send the response
    $response->send();
