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
    <title>Cadastro de Eventos</title>
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
        padding: 0;
    }

    .form-container {
        width: 90%;
        max-width: 600px;
        margin: 0 auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
        font-size: 2rem;
    }

    form label {
        font-weight: bold;
        display: block;
        margin-bottom: 8px;
        font-size: 1rem;
        color: #333;
    }

    form input,
    form textarea,
    form select {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    form input:focus,
    form textarea:focus,
    form select:focus {
        border-color: #5cb85c;
        outline: none;
        box-shadow: 0 0 5px rgba(92, 184, 92, 0.6);
    }

    form textarea {
        resize: vertical;
        min-height: 120px;
    }

    .button-container {
        display: flex;
        justify-content: space-between; 
        gap: 10px;
    }

    form button,
    .list-button {
        display: block;
        width: 48%;
        padding: 12px;
        background-color: #5cb85c;
        color: #fff;
        border: none;
        border-radius: 5px;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    form button:hover,
    .list-button:hover {
        background-color: #4cae4c;
    }

    .list-button {
        background-color: #007bff;
    }

    .list-button:hover {
        background-color: #0056b3;
    }

    .mensagem {
        padding: 15px;
        margin-bottom: 25px;
        border-radius: 5px;
        text-align: center;
        font-weight: bold;
        font-size: 1rem;
    }

    .mensagem p {
        margin: 0;
    }

    .mensagem.sucesso {
        background-color: #d4edda;
        color: #155724;
    }

    .mensagem.erro {
        background-color: #f8d7da;
        color: #721c24;
    }

    input[type="datetime-local"],
    input[type="number"] {
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100%;
    }

    input[type="datetime-local"]:focus,
    input[type="number"]:focus {
        border-color: #5cb85c;
        outline: none;
    }
</style>

</head>

<body>

    <div class="form-container">
        <h1>Cadastro de Eventos</h1>
        <form action="../controller/CreateController.php" method="post" id="cadastroForm">

            <label for="tipo">Tipo:</label>
            <select name="tipo">
                <option value="">Selecione</option>
                <option value="social" <?php echo (isset($_POST['tipo']) && $_POST['tipo'] == 'social') ? 'selected' : ''; ?>>Social</option>
                <option value="cultural" <?php echo (isset($_POST['tipo']) && $_POST['tipo'] == 'cultural') ? 'selected' : ''; ?>>Cultural</option>
                <option value="esportivo" <?php echo (isset($_POST['tipo']) && $_POST['tipo'] == 'esportivo') ? 'selected' : ''; ?>>Esportivo</option>
                <option value="corporativo" <?php echo (isset($_POST['tipo']) && $_POST['tipo'] == 'corporativo') ? 'selected' : ''; ?>>Corporativo</option>
                <option value="religioso" <?php echo (isset($_POST['tipo']) && $_POST['tipo'] == 'religioso') ? 'selected' : ''; ?>>Religioso</option>
                <option value="entretenimento" <?php echo (isset($_POST['tipo']) && $_POST['tipo'] == 'entretenimento') ? 'selected' : ''; ?>>Entretenimento</option>
                <option value="outros" <?php echo (isset($_POST['tipo']) && $_POST['tipo'] == 'outros') ? 'selected' : ''; ?>>Outros</option>
            </select><br>

            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?php echo isset($_POST['nome']) ? $_POST['nome'] : ''; ?>"><br>

            <label for="descricao">Descrição:</label>
            <textarea name="descricao" rows="4" cols="50"><?php echo isset($_POST['descricao']) ? htmlspecialchars($_POST['descricao']) : ''; ?></textarea><br>

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" value="<?php echo isset($_POST['endereco']) ? $_POST['endereco'] : ''; ?>"><br>

            <label for="link_endereco">Link:</label>
            <input type="url" name="link_endereco" value="<?php echo isset($_POST['link_endereco']) ? $_POST['link_endereco'] : ''; ?>"><br>

            <label for="datahora_inicio">Data e Hora:</label>
            <input type="datetime-local" name="datahora_inicio" value="<?php echo isset($_POST['datahora_inicio']) ? $_POST['datahora_inicio'] : ''; ?>"><br>

            <label for="preco">Preço:</label>
            <input type="number" step="0.01" name="preco" value="<?php echo isset($_POST['preco']) ? $_POST['preco'] : ''; ?>"><br>

            <div class="button-container">
            <button type="submit">Salvar</button>
            <a href="/index.php" type="button" class="list-button">Listagem</a>
        </div>
        </form>
        <div id="message" class="message"></div>
    </div>

</body>

</html>