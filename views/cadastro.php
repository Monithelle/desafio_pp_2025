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
<link rel="stylesheet" type="text/css" href="../styles/styles.css">
    
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
            </select><br><br>

            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?php echo isset($_POST['nome']) ? $_POST['nome'] : ''; ?>"><br><br>

            <label for="descricao">Descrição:</label>
            <textarea name="descricao" rows="4" cols="50"><?php echo isset($_POST['descricao']) ? htmlspecialchars($_POST['descricao']) : ''; ?></textarea><br><br>

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" value="<?php echo isset($_POST['endereco']) ? $_POST['endereco'] : ''; ?>"><br><br>

            <label for="link_endereco">Link:</label>
            <input type="url" name="link_endereco" value="<?php echo isset($_POST['link_endereco']) ? $_POST['link_endereco'] : ''; ?>"><br><br>

            <label for="datahora_inicio">Data e Hora:</label>
            <input type="datetime-local" name="datahora_inicio" value="<?php echo isset($_POST['datahora_inicio']) ? $_POST['datahora_inicio'] : ''; ?>"><br><br>

            <label for="preco">Preço:</label>
            <input type="number" step="0.01" name="preco" value="<?php echo isset($_POST['preco']) ? $_POST['preco'] : ''; ?>"><br><br>

            <button type="submit">Salvar</button>
            <a href="/index.php" type="button" class="list-button">Listagem</a>
        </form>
        <div id="message" class="message"></div>
    </div>

</body>

</html>