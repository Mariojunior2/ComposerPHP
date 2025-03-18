<?php

use PhpParser\Node\Stmt\While_;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setErrorHandler(HttpNotFoundException::class, function (
    Request $request,
    Throwable $expection,
    bool $diplayErrorDetails,
    bool $logErrors,
    bool $logErrorDetails
) use ($app) {
    $response = $app->getResponseFactory()->createResponse();
    $response->getBody()->write('{"error": "voce ser bobo!"}');
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
});

$app->get('/ola/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});

$app->get('/tarefas', function (Request $request, Response $response, array $args) {
    $tarefa = [
        ["id" => 1, "titulo" => "Veja que legal1", "concluido1" => false],
        ["id" => 2, "titulo" => "Veja que legal2", "concluido2" => false],
        ["id" => 3, "titulo" => "Veja que legal3", "concluido3" => false],
        ["id" => 4, "titulo" => "Veja que legal4", "concluido4" => true],
        ["id" => 5, "titulo" => "Veja que legal5", "concluido5" => false],
    ];
    $response->getBody()->write(json_encode($tarefa));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/tarefas', function(Request $request, Response $response, array $args) {
    return $response->withStatus(204);
});

$app->delete('/tarefas', function(Request $request, Response $response, array $args) {
    return $response->withStatus(204);
});

$app->put('/tarefas', function(Request $request, Response $response, array $args) {
    return $response->withStatus(204);
});

$app->run();