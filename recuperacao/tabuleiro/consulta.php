<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Tabuleiro</title>
</head>
<body>
    <?php
        $id = isset($_GET['id'])?$_GET['id']:0;
        require_once("../classes/Tabuleiro.class.php");
        $tab = new Tabuleiro($id,1);
        $busca = $tab->listar(1,$id);
        $tab->setLado($busca[0]['lado']);
        echo $tab->desenha();
    ?>
</body>
</html>