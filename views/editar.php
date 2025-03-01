<?php
require_once 'model/DatabaseModel.php';

$db = new Crud();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $endereco = $_POST['endereco'];
    $link_endereco = $_POST['link_endereco'];
    $datahora_inicio = $_POST['datahora_inicio'];
    $preco = $_POST['preco'];

    $db->atualizarevento($id, $tipo, $nome, $descricao, $endereco, $link_endereco, $datahora_inicio, $preco);
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'] ?? null;
$registro = $db->getevento($id);

$datahora_inicio = date('Y-m-d\TH:i', strtotime($registro['datahora_inicio']));
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
    <style>
    
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f4f4f4;
    color: #333;
    margin: 20px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 60%;
    margin: 0 auto;
}

form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
}

form input, form select, form textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 16px;
}

form input[type="datetime-local"] {
    font-size: 15px;
}

form button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
}

form button:hover {
    background-color: #45a049;
}

form textarea {
    resize: vertical;
}

div {
    margin-top: 20px;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
}

div[style*="background-color: lightgreen"] {
    background-color: #d4edda;
}

div[style*="background-color: lightcoral"] {
    background-color: #f8d7da;
}

    </style>
</head>

<body>
    <h2>Editar Registro</h2>
    <form method="POST">
    <input type="hidden" name="id" value="<?php echo $registro['id']; ?>">

    <label for="tipo">Tipo:</label>
    <select name="tipo">
        <option value="">Selecione</option>
        <option value="social" <?php echo ($registro['tipo'] == 'social') ? 'selected' : ''; ?>>Social</option>
        <option value="cultural" <?php echo ($registro['tipo'] == 'cultural') ? 'selected' : ''; ?>>Cultural</option>
        <option value="esportivo" <?php echo ($registro['tipo'] == 'esportivo') ? 'selected' : ''; ?>>Esportivo</option>
        <option value="corporativo" <?php echo ($registro['tipo'] == 'corporativo') ? 'selected' : ''; ?>>Corporativo</option>
        <option value="religioso" <?php echo ($registro['tipo'] == 'religioso') ? 'selected' : ''; ?>>Religioso</option>
        <option value="entretenimento" <?php echo ($registro['tipo'] == 'entretenimento') ? 'selected' : ''; ?>>Entretenimento</option>
        <option value="outros" <?php echo ($registro['tipo'] == 'outros') ? 'selected' : ''; ?>>Outros</option>
    </select><br><br>

    <label for="nome">Nome:</label>
    <input type="text" name="nome" value="<?php echo htmlspecialchars($registro['nome']); ?>"><br><br>

    <label for="descricao">Descrição:</label>
    <textarea name="descricao" rows="4" cols="50"><?php echo htmlspecialchars($registro['descricao']); ?></textarea><br><br>

    <label for="endereco">Endereço:</label>
    <input type="text" name="endereco" value="<?php echo htmlspecialchars($registro['endereco']); ?>"><br><br>

    <label for="link_endereco">Link:</label>
    <input type="url" name="link_endereco" value="<?php echo htmlspecialchars($registro['link_endereco']); ?>"><br><br>

    <label for="datahora_inicio">Data e Hora:</label>
    <input type="datetime-local" name="datahora_inicio" value="<?php echo date('Y-m-d\TH:i', strtotime($registro['datahora_inicio'])); ?>"><br><br>

    <label for="preco">Preço:</label>
    <input type="number" step="0.01" name="preco" value="<?php echo htmlspecialchars($registro['preco']); ?>"><br><br>

    <button type="submit">Editar</button>
</form>

</body>

</html>