<?php
use PhpParser\Node\Stmt\While_;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Factory\AppFactory;
use MarioJunior2\Tarefes\Service\TarefaService;

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

//            $app->get('/ola/{name}', function (Request $request, Response $response, array $args) {
//                $name = $args['name']; 
//                $response->getBody()->write("Hello, $name");
//                return $response;
//            });

$app->get('/tarefas', function (Request $request, Response $response, array $args) {
    $tarefa_service = new TarefaService();
    $tarefa = $tarefa_service->getAllTarefas();
    $response->getBody()->write(json_encode($tarefa));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/tarefas', function(Request $request, Response $response, array $args) {
    $paremetros = (array) $request->getParsedBody();


    if(!array_key_exists('titulo', $paremetros) && empty($paremetros['titulo'])) {
        $response->getBody()->write(json_encode([
            "mensagem" => "titulo obrigatorio"
        ]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    } 

    $modelo = array(['tarefa' => '', 'concluindo' => false], $paremetros);
    $tarefa_service = new TarefaService();
    $tarefa_service->createTarefa($paremetros);
    return $response->withStatus(201);
});



$app->delete('/tarefas/{id}', function(Request $request, Response $response, array $args) {
    $id = $args['id'];
    $tarefa_service = new TarefaService();
    $tarefa_service->deleteTarefa($id);
    return $response->withStatus(204);
});

$app->put('/tarefas/{id}', function(Request $request, Response $response, array $args) {
    $id = $args['id'];
    $dados_para_atualizar = (array) $request->getParsedBody();
    
    if(!array_key_exists('titulo', $dados_para_atualizar) && empty($dados_para_atualizar['titulo'])) {
        $response->getBody()->write(json_encode([
            "mensagem" => "titulo obrigatorio"
        ]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    } 
    
    $tarefa_service = new TarefaService();
    $tarefa_service->updateTarefa($id, $dados_para_atualizar);
    return $response->withStatus(201);
});

$app->run();