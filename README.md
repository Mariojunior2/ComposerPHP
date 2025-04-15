# Serviço de Tarefas

## Visão Geral
O Serviço de Tarefas é uma aplicação simples em PHP projetada para gerenciar tarefas (tarefas) usando um arquivo JSON para armazenamento de dados. Este serviço oferece uma API RESTful construída com o framework Slim, permitindo operações CRUD (Criar, Ler, Atualizar, Deletar) sobre as tarefas.

## Dependências e Autoloading
O projeto utiliza o Composer para gerenciar dependências e autoloading automático das classes.

### Dependências principais:
- **slim/slim**: Framework PHP para criação de APIs RESTful.
- **psr/http-client** e **slim/psr7**: Implementações PSR para manipulação de requisições e respostas HTTP.
- **pestphp/pest** (dev): Framework para testes automatizados.

### Autoloading:
O autoloading segue o padrão PSR-4, mapeando o namespace `MarioJunior2\Tarefes\` para o diretório `src/`.

Para instalar as dependências, execute:
```bash
composer install
```

## Estrutura de Arquivos
- `index.php`: Ponto de entrada da aplicação, onde o Slim é configurado, as rotas são definidas e o middleware de tratamento de erros é adicionado.
- `data_tarefa.json`: Arquivo JSON onde as tarefas são armazenadas.
- `src/Service/TarefaService.php`: Contém a classe `TarefaService`, responsável por gerenciar todas as operações relacionadas às tarefas, incluindo leitura e escrita no arquivo JSON.

## Configuração e Execução
Para executar o projeto localmente, você pode usar o servidor embutido do PHP:

```bash
php -S localhost:8080
```

E acessar a API via `http://localhost:8080/tarefas`.

## Ponto de Entrada - index.php
O arquivo `index.php` inicializa a aplicação Slim, adiciona middleware para tratamento de erros personalizados e define as rotas da API.

### Middleware de Erro
- Captura exceções do tipo `HttpNotFoundException` e retorna uma resposta JSON com status 404 e mensagem personalizada.
- Configurado para mostrar detalhes de erros para facilitar o desenvolvimento.

### Rotas Definidas
- `GET /tarefas`: Retorna todas as tarefas cadastradas.
- `POST /tarefas`: Cria uma nova tarefa. Requer o parâmetro `titulo` no corpo da requisição.
- `DELETE /tarefas/{id}`: Remove a tarefa com o ID especificado.
- `PUT /tarefas/{id}`: Atualiza a tarefa com o ID especificado. Se o campo `titulo` for fornecido, não pode estar vazio.

Cada rota utiliza a classe `TarefaService` para realizar as operações correspondentes.

## Classe TarefaService
Localizada em `src/Service/TarefaService.php`, esta classe é responsável por toda a lógica de manipulação das tarefas, interagindo diretamente com o arquivo `data_tarefa.json` para persistência dos dados.

### Métodos Principais

- `getAllTarefas()`: Recupera todas as tarefas do arquivo JSON.
- `getTarefaById($id)`: Recupera uma tarefa específica pelo seu identificador único.
- `createTarefa($tarefa)`: Cria uma nova tarefa e a salva no arquivo JSON, atribuindo um ID único.
- `updateTarefa($id, $updatedTarefa)`: Atualiza os dados da tarefa com o ID especificado.
- `deleteTarefa($id)`: Remove a tarefa com o ID especificado do arquivo JSON.
- `readData()`: Lê os dados do arquivo JSON, criando um arquivo vazio se não existir.
- `writeData($data)`: Escreve os dados fornecidos no arquivo JSON em formato legível.

## Estrutura dos Dados da Tarefa
Cada tarefa é representada como um array associativo com os seguintes campos:

- `id` (string): Identificador único gerado automaticamente.
- `titulo` (string): Título da tarefa.
- `concluindo` (bool): Indica se a tarefa está concluída (opcional, padrão é `false`).

Exemplo de uma tarefa:
```json
{
  "id": "605c72ef9b1d8",
  "titulo": "Comprar mantimentos",
  "concluindo": false
}
```

## API Endpoints

| Método | Endpoint       | Descrição                                  | Parâmetros Requeridos           | Resposta                         |
|--------|----------------|--------------------------------------------|--------------------------------|---------------------------------|
| GET    | /tarefas       | Retorna todas as tarefas                    | Nenhum                         | Array JSON com todas as tarefas  |
| POST   | /tarefas       | Cria uma nova tarefa                        | `titulo` (no corpo da requisição) | Status 201 em caso de sucesso    |
| DELETE | /tarefas/{id}  | Deleta a tarefa com o ID especificado      | `id` (na URL)                  | Status 204 em caso de sucesso    |
| PUT    | /tarefas/{id}  | Atualiza a tarefa com o ID especificado    | `id` (na URL), `titulo` opcional no corpo | Status 201 em caso de sucesso    |

### Exemplos de Requisições

#### Criar uma nova tarefa
```bash
curl -X POST http://localhost:8080/tarefas \
-H "Content-Type: application/json" \
-d '{"titulo": "Estudar PHP"}'
```

#### Atualizar uma tarefa
```bash
curl -X PUT http://localhost:8080/tarefas/{id} \
-H "Content-Type: application/json" \
-d '{"titulo": "Estudar PHP avançado", "concluindo": true}'
```

#### Deletar uma tarefa
```bash
curl -X DELETE http://localhost:8080/tarefas/{id}
```

#### Listar todas as tarefas
```bash
curl http://localhost:8080/tarefas
```

## Tratamento de Erros e Validações
- Se o parâmetro `titulo` estiver ausente ou vazio nas requisições POST e PUT, a API retorna status 400 com uma mensagem de erro.
- Requisições para rotas não existentes retornam status 404 com uma mensagem JSON personalizada.

## Testes
O projeto utiliza o framework Pest para testes automatizados (dependência de desenvolvimento). Para rodar os testes, execute:

```bash
./vendor/bin/pest
```

## Como Contribuir
Para contribuir com o projeto, siga os passos:

1. Faça um fork do repositório.
2. Crie uma branch para sua feature ou correção.
3. Faça as alterações desejadas.
4. Execute os testes para garantir que nada quebrou.
5. Envie um pull request descrevendo suas mudanças.

## Conclusão
Este projeto demonstra uma aplicação simples de gerenciamento de tarefas utilizando PHP, o framework Slim para criação de uma API RESTful, e armazenamento de dados em um arquivo JSON. O uso do Composer facilita a gestão das dependências e o autoloading das classes. A arquitetura é simples e educativa, ideal para quem deseja aprender sobre APIs REST, manipulação de arquivos em PHP, middleware, tratamento de erros e boas práticas de organização de código.

Para iniciar o projeto, instale as dependências com Composer, execute o servidor PHP embutido e utilize as rotas da API para gerenciar suas tarefas.
