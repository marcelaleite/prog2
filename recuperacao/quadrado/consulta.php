<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Quadrado</title>
</head>
<body>
    <?php
        $id = isset($_GET['id'])?$_GET['id']:0;
        require_once("../classes/Quadrado.class.php");
        $quad = new Quadrado($id,1," ",1);
        $busca = $quad->listar(1,$id);
        $quad->setLado($busca[0]['lado']);
        $quad->setCor($busca[0]['cor']);
        $quad->setTabuleiro($busca[0]['tabuleiro_idtabuleiro']);
        echo $quad->desenha();
    ?>
</body>
</html>