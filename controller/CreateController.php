<?php
require_once 'model/DatabaseModel.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $create = [
        "tipo" => $_POST["tipo"],
        "nome" => $_POST["nome"],
        "descricao" => $_POST["descricao"],
        "endereco" => $_POST["endereco"],
        "link_endereco" => $_POST["link_endereco"],
        "datahora_inicio" => $_POST["datahora_inicio"],
        "preco" => $_POST["preco"]
    ];

    $crud = new Crud();

    if ($crud->create($create)) {
        $_SESSION["mensagem"] = "Evento cadastrado com sucesso!";
        $_SESSION["tipo_mensagem"] = "sucesso";
        header("Location: ../index.php");
        exit;
    } else {
        $_SESSION["mensagem"] = "Erro ao cadastrar evento. Tente novamente!";
        $_SESSION["tipo_mensagem"] = "erro";

        header("Location: ../views/cadastro.php");
        exit;
    }
}
