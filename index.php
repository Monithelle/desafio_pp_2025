<?php
require_once "controller/ListagemController.php";

$controller = new ListagemController();

$filtros = [
    'tipo' => isset($_GET['tipo']) ? $_GET['tipo'] : "",
    'nome' => isset($_GET['nome']) ? $_GET['nome'] : "",
    'descricao' => isset($_GET['descricao']) ? $_GET['descricao'] : "",
    'endereco' => isset($_GET['endereco']) ? $_GET['endereco'] : "",
    'link_endereco' => isset($_GET['link_endereco']) ? $_GET['link_endereco'] : "",
    'datahora_inicio' => isset($_GET['datahora_inicio']) ? $_GET['datahora_inicio'] : "",
    'preco' => isset($_GET['preco']) ? $_GET['preco'] : "",
];

$registros = $controller->listar($filtros);
?>

<?php session_start(); ?>
<?php if (isset($_SESSION["mensagem"])): ?>
    <div style="padding: 10px; background-color: <?php echo $_SESSION["tipo_mensagem"] === "sucesso" ? 'lightgreen' : 'lightcoral'; ?>; color: black;">
        <?php echo $_SESSION["mensagem"]; ?>
    </div>
    <?php unset($_SESSION["mensagem"], $_SESSION["tipo_mensagem"]); ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Registros</title>
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

.search-box {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.search-box label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.search-box input, .search-box select {
    width: 100%;
    padding: 8px;
    margin: 10px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.search-box button {
    background-color: #5cb85c;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
}

.search-box button:hover {
    background-color: #4cae4c;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table th {
    background-color: #f1f1f1;
    font-weight: bold;
}

table tr:hover {
    background-color: #f9f9f9;
}

.btn {
    padding: 6px 12px;
    text-decoration: none;
    border-radius: 5px;
    color: white;
    font-weight: bold;
}

.btn-edit {
    background-color: #007bff;
}

.btn-edit:hover {
    background-color: #0056b3;
}

.btn-delete {
    background-color: #d9534f;
    margin-left: 10px;
}

.btn-delete:hover {
    background-color: #c9302c;
}

div {
    margin: 20px 0;
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

    <h2>Lista de Eventos</h2>

    <form method="GET" class="search-box">
        <label for="tipo">Tipo:</label>
        <select name="tipo">
            <option value="">Selecione</option>
            <option value="social" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'social') ? 'selected' : ''; ?>>Social</option>
            <option value="cultural" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'cultural') ? 'selected' : ''; ?>>Cultural</option>
            <option value="esportivo" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'esportivo') ? 'selected' : ''; ?>>Esportivo</option>
            <option value="corporativo" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'corporativo') ? 'selected' : ''; ?>>Corporativo</option>
            <option value="religioso" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'religioso') ? 'selected' : ''; ?>>Religioso</option>
            <option value="entretenimento" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'entretenimento') ? 'selected' : ''; ?>>Entretenimento</option>
            <option value="outros" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'outros') ? 'selected' : ''; ?>>Outros</option>
        </select><br><br>
        <label for="tipo">Nome:</label>
        <input type="text" name="nome" placeholder="Nome" value="<?php echo htmlspecialchars($filtros['nome']); ?>">

        <label for="tipo">Descrição:</label>
        <input type="text" name="descricao" placeholder="Descrição" value="<?php echo htmlspecialchars($filtros['descricao']); ?>">

        <label for="tipo">Endereço:</label>
        <input type="text" name="endereco" placeholder="Endereço" value="<?php echo htmlspecialchars($filtros['endereco']); ?>">

        <label for="tipo">Link:</label>
        <input type="url" name="link_endereco" placeholder="Link" value="<?php echo htmlspecialchars($filtros['link_endereco']); ?>">

        <label for="tipo">Data e Hora:</label>
        <input type="datetime-local" name="datahora_inicio" placeholder=" " value="<?php echo htmlspecialchars($filtros['datahora_inicio']); ?>">
        <input type="number" name="preco" placeholder="Preço" value="<?php echo htmlspecialchars($filtros['preco']); ?>">
        <button type="submit">Pesquisar</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Nome</th>
                <th>descricao</th>
                <th>endereco</th>
                <th>Data e Hora</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($registros)): ?>
                <?php foreach ($registros as $registro): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($registro['tipo']); ?></td>
                        <td><?php echo htmlspecialchars($registro['nome']); ?></td>
                        <td><?php echo htmlspecialchars($registro['descricao']); ?></td>
                        <td><?php echo htmlspecialchars($registro['endereco']); ?></td>
                        <td><?php echo htmlspecialchars($registro['datahora_inicio']); ?></td>
                        <td><?php echo htmlspecialchars($registro['preco']); ?></td>
                        <td>
                            <a href="views/editar.php?id=<?php echo $registro['id']; ?>" class="btn btn-edit">Editar</a>
                            <a href="controller/DeleteController.php?id=<?php echo $registro['id']; ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nenhum Evento encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table><br>
    <a href="views/cadastro.php" class="btn btn-edit">Cadastrar Novo Evento</a>
</body>

</html>