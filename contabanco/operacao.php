<?php

require_once("utils.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operações na conta: Saque e Depósito</title>
</head>
<body>
    <form action="controle-operacoes.php">
        <label for="pf-id">Pessoa:</label>
        <select name="pf-id">
            <?php
                echo lista_pessoa(0);
            ?>
        </select>
        <label for="cc-id">Conta Corrente:</label>
        <select name="cc-id">
            <?php
                $pessoa = isset($_POST['pf-id'])?$_POST['pf-id']:0;
                echo lista_conta($pessoa);
            ?>
        </select>
        <label for="op">Operação:</label>
        <input name="op" type="radio"> Saque
        <input name="op" type="radio"> Depósito
        <label for="valor">Valor:</label>
        <input type="text" name="valor">
        <input type="submit" value="salvar" name="acao">
    </form>
    
</body>
</html>