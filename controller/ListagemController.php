<?php

require_once 'model/DatabaseModel.php';

class ListagemController{
private $db;

public function __construct()
{
    $this->db= new Crud();

}

public function listar($filtros){
    return $this->db->read($filtros);
}
}
?>
