# Serviço de Tarefas

## Visão Geral
O Serviço de Tarefas é uma aplicação simples em PHP projetada para gerenciar tarefas (tarefas) usando um arquivo JSON para armazenamento de dados. Este serviço permite que os usuários criem novas tarefas e recuperem tarefas existentes por seus identificadores únicos.

## Propósito
O principal objetivo deste serviço é fornecer uma interface leve e fácil de usar para gerenciar tarefas. Ele é construído em PHP e utiliza JSON para armazenamento de dados, tornando fácil a leitura e escrita dos dados das tarefas.

## Estrutura de Arquivos
- `index.php`: O ponto de entrada para a aplicação.
- `data.json`: O arquivo onde as tarefas são armazenadas em formato JSON.
- `Service/TarefasService.php`: Contém a classe `TarefaService`, que gerencia todas as operações relacionadas a tarefas.

## Classe TarefaService
A classe `TarefaService` é responsável por gerenciar tarefas. Ela inclui os seguintes métodos:

### 1. `getAllTarefas()`
- **Descrição**: Recupera todas as tarefas do arquivo JSON.
- **Retorna**: Um array de tarefas.

### 2. `getTarefaById($id)`
- **Descrição**: Recupera uma tarefa específica pelo seu identificador único.
- **Parâmetros**: 
  - `$id`: O identificador único da tarefa a ser recuperada.
- **Retorna**: A tarefa se encontrada, ou `null` se não encontrada.

### 3. `createTarefa($tarefa)`
- **Descrição**: Cria uma nova tarefa e a salva no arquivo JSON.
- **Parâmetros**: 
  - `$tarefa`: Um array associativo contendo os detalhes da tarefa.
- **Nota**: Cada tarefa é atribuída um ID único usando `uniqid()`.

### 4. `readData()`
- **Descrição**: Lê os dados do arquivo JSON. Se o arquivo não existir, cria um arquivo JSON vazio.
- **Retorna**: Um array de tarefas.

### 5. `writeData($data)`
- **Descrição**: Escreve os dados fornecidos no arquivo JSON em um formato bem formatado.
- **Parâmetros**: 
  - `$data`: Um array de tarefas a serem salvas.

## Conclusão
O Serviço de Tarefas fornece uma maneira direta de gerenciar tarefas usando PHP e JSON. Ele é projetado para ser simples e educativo, tornando-se um ótimo ponto de partida para aqueles que desejam aprender sobre manipulação de arquivos em PHP e operações CRUD básicas.
