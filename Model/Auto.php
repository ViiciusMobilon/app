<?php

namespace APP\Model;


use APP\DAO\AutorDAO;
use Exception;


final class Autor extends Model{
    public ?int $Id = null;

    public ?string $Nome{
        set
        {
            if(strlen($value)<1)
            {
                throw new Exception("O nome deve ter pelo menos 1 caracter");

                $this->Nome = $value;
            }
        }
        get=>$this->Nome ?? null;
    }

    public ?string $CPF{
        set
        {
            if(strlen($value)<11)
            {
                throw new Exception("Preencha o CPF corretamente");

                $this->CPF = $value;
            }

            
        }
        get=>$this->CPF ?? null;

    }

    public ?string $Nascimento{
        set
        {
            if(empty($value))
            {
                throw new Exception("preencha a data ");

                $this->Nascimento = $value;
            }
        }
        get=>$this->Nascimento ?? null;
    }


    function save() : Autor
    {
        return new AutorDAO()->save($this);
    }

    function selectById() : ?Autor
    {
        return new AutorDAO()->selectById($Id);
    }

    function getAllRows() : array
    {
        $this->rows = new AutorDAO()->select();
        return $this->rows;
    }

    function delete() : bool
    {
        return new AutorDAO()->delete();
    }
}