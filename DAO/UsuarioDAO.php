<?php

namespace APP\Dao;

use APP\Model\Aluno;

final class AlunoDAO extends DAO{
    public function __construct(){
        parent::__construct();
    }

    public function save(Aluno $model) : Aluno{
        return ($model->Id ==null) ? $this->insert($model):
            $this->update($model);
    }

    public function insert(Aluno $model) : Aluno{
        $sql = "INSERT INTO usuario(nome, email, senha) VALUES (?,?,?) ";
        $stmt = parent::$conexao->prepare($sql);

        $stml->bindValue(1, $model->Nome);
        $stml->bindValue(2, $model->Email);
        $stml->bindValue(3, $model->Senha);

        $stmt->execute();

        $model->Id = parent::$conexao->lastInsertId();

        return $model;
    }

    public function update(Aluno $model) : Aluno{
        $sql = "UPDATE usuario SET nome=?, email=?, senha=? WHERE id=? ";
        $stmt = parent::$conexao->prepare($sql);

        $stml->bindValue(1, $model->Nome);
        $stml->bindValue(2, $model->Email);
        $stml->bindValue(3, $model->Senha);
        $stml->bindValue(3, $model->Id);
        $stmt->execute();
        $model->Id = parent::$conexao->lastInsertId();

        return $model;
    }


    public function selectById(int $id) : ?Aluno{
        $sql = "SELECT * FROM usuario WHERE id=? ";
        
        
        $stmt = parent::$conexao->prepare($sql);

        $stml->bindValue(1, $id);
        $stml->bindValue(2, $model->Email);
        $stml->bindValue(3, $model->Nome);

        $stmt->execute();

        $model->Id = parent::$conexao->lastInsertId();

        return $model;
    }



    public function select() : array
    {
        $sql = "SELECT * FROM usuario ";

        $stmt = parent::$conexao->prepare($sql);  
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\Usuario");
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM usuario WHERE id=? ";

        $stmt = parent::$conexao->prepare($sql);  
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}