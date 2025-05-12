<?php
namespace App\Controller;

use App\Model\Aluno;
use Exception;

final class UsuarioController extends Controller{

    public static function index() : void
    {
        parent::isProtected();
        $model  = new Usuario();
        try{
            $model-> getAllRows();
        }
        catch(Exception $e){
            $model->setError("Ocorreu um erro ao buscar os alunos:");
            $model->setError($e-> getMessage());
        }

        parent::render('Usuario/lista_usuario.php', $model);
    }

    public static function cadastro() : void 
{
       parent::isProtected();
       $model =new Usuario();

       try{
        if(parent::isPost())
        {
            $model-> Id = !empty($_POST['id'])? $_post['id']:null;
            $model-> Nome= $_POST['nome'];
            $model-> Email = $_POST['Email'];
            $model->Senha = $_POST['senha'];
            $model->save();
            
            parent::redirect("/usuario");

        } else {

            if(isset($_GET['id']))
            {              
                $model = $model->getById( (int) $_GET['id'] );
            }
        }

    } catch(Exception $e) {

        $model->setError($e->getMessage());
    }

    parent::render('Usuario/form_usuario.php', $model);        
}

public static function delete() : void
{
    parent::isProtected(); 

    $model = new Aluno();
    
    try 
    {
        $model->delete( (int) $_GET['id']);
        parent::redirect("/usuario");

    } catch(Exception $e) {
        $model->setError("Ocorreu um erro ao excluir o aluno:");
        $model->setError($e->getMessage());
    } 
    
    parent::render('Usuario/lista_usuario.php', $model);  
}
}