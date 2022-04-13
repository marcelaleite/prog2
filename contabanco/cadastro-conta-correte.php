<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Conta Corrente</title>
</head>
<body>
    <form action="controle-conta-corrente.php" method="POST">
        <label for="cc-numero">Número:</label>
        <input type="text" name="cc-numero">
        <label for="cc-saldo">Saldo:</label>
        <input type="text" name="saldo">
        <label for="cc-dt-ultima-alteracao">Data de última alteração:</label>
        <input type="text" name="cc-dt-ultima-alteracao">
        <label for="cc-pf">Pessoa Física:</label>
        <select name="cc-pf">
            <?php
                require_once("controle-conta-corrente.php");
                echo lista_pessoa(0);
            ?>
        </select>
        <input type="submit" name="acao" value="salvar">
    </form>
    
</body>
</html>