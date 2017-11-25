<?php
// Routes

//$app->get('/[{name}]', function ($request, $response, $args) {
//    // Sample log message
//    $this->logger->info("Slim-Skeleton '/' route");
//
//    // Render index view
//    return $this->renderer->render($response, 'index.phtml', $args);
//});

$app->get('/message', function ($request, $response, $args) {

    $response->write("Hellow World")
             ->withStatus(200)
             ->withHeader("Content Type:", "text/plain");

    return $response;

});

