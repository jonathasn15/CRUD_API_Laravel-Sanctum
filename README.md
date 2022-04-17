<h1 align="center">API - To do list</h1>

<p align="center">Api se trata de uma aplicação desenvolvido em PHP ultilizando o framework laravel que faz com que usuários autenticados crie uma lista de tarefaz, o mesmo se trata de uma desenvolvida para praticar o conhecimento adquirido em cursos de Laravel.</p>


# Funcionalidades

 - 1 - Login
 - 2 - Logout
 - 3 - Criação de Item da lista de tarefa
 - 4 - Updade de lista de tarefa
 - 5 - deletar tarefa

# Rotas

//Rotas do sistema:
//login
Route::post('/auth',[AuthController::class, 'login']);

//Rota para user nao autenticado
Route::get('/unauthenticate', function(){
    return ['error' => 'Usuário não logado'];
})->name('login');

//logout
Route::middleware('auth:sanctum')->get('/auth/logout',[AuthController::class, 'logout']);

//create
Route::middleware('auth:sanctum')->post('/todo',[ApiController::class, 'createTodo']);
Route::post('/user',[AuthController::class, 'createUser']);

//read
Route::get('/todos',[ApiController::class, 'readAllTodos']);
Route::get('/todo/{id}',[ApiController::class, 'readTodo']);

//update
Route::middleware('auth:sanctum')->put('/todo/{id}',[ApiController::class, 'updateTodo']);

//delete
Route::middleware('auth:sanctum')->delete('/todo/{id}',[ApiController::class, 'deleteTodo']);

## 🚀 Tecnologias

Este projeto foi desenvolvido com as seguintes tecnologias:


- ✔️ PHP

- ✔️ LARAVEL

- ✔️ Routes

- ✔️ MySql 

- ✔️ Composer


## ⚙ Configuração via Composer

1- Para instalar o Laravel:
> composer create-project laravel/laravel

2- Para iniciar sessão:
> Php artisan serve


Feito com 💜 por Jonathas Nunes 👋 [Veja meu Linkedin](https://www.linkedin.com/in/jonathasnunes-developer/)
<br>
