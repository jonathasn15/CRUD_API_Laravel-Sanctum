<?php

namespace App\Http\Controllers;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    

    public function createTodo(Request $request){

        $array = ['error' => ''];

        //set validação:
        $rules = ['title' => 'required|min:3'];

        //validando dados:
        $validator = validator::make($request->all(), $rules);
        if($validator->fails()){
            $array['error'] = $validator->messages();
            return $array;
        }
        // inserindo os dados no DB:
        $title = $request->input('title');
        $todo = New Todo();
        $todo->title = $title;
        $todo->save();

        return $array;

    }

    public function readTodo($id){

        $array = ['error' => ''];

        $todo = Todo::find($id);
        //verificando ser o Id existe
        if($todo){
            //ação caso ID exista (ler dado) 
            $array['todo'] = $todo;
        }else{
        //ação caso ID não exista (exibir mensagem de erro)   
            $array['error'] = "A tarefa ".$id." não existe!!";
        }
        return $array;    
    }

    public function readAllTodos(){

        //Pegando todos os dados do DB:
        $array = ['error' => ''];


        //paginação
        
        $todos = Todo::simplePaginate(2);
        
        //exibindo lista

        $array['list'] = $todos->items();

        $currentPage = $todos->currentPage();

       $count = count(Todo::all());

        if($count <= 2){

            
        
        }else{
           $array['current_page'] = $todos->currentPage();
        }
        

        return $array;
        
    }

    public function updateTodo($id, Request $request){

        $array = ['error' => ''];

         //set validação:
         $rules = [
             'title' => '|min:3',
             'done' => 'boolean'
        ];

        //recebendo novos dados:
        $title = $request->input('title');
        $done = $request->input('done');


         //validando dados:
         $validator = validator::make($request->all(), $rules);
         if($validator->fails()){
             $array['error'] = $validator->messages();
             return $array;
         }
         // procurando Item no BD
         $todo = Todo::find($id);
         if($todo){
             // atualiza os dados no DB:
             if($title){
         $todo->title = $title;
             }
             if($done !== NULL){
                $todo->done = $done;
             }
             //salvando atualização:

             $todo->save();
         }else{
             $array['error'] = "A tarefa ".$id." não pode ser editada porque ela não existe!!";
         }
        return $array;       
    }
    public function deleteTodo($id){
        
        $array = ['error' => ''];
         //deletando dados
        
       $todo = Todo::find($id);
       if($todo){
       $todo->delete();
        }else{
            $array['error'] = "A tarefa ".$id." não pode ser deletada porque ela não existe!!";
        }

        return $array;  
    }
}
