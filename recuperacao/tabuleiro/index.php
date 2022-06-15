<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabuleiro</title>
</head>
<body>
<?php
    //pega os dados que vem via get para edição
    $acao = isset($_GET['acao'])?$_GET['acao']:"";
    $id = isset($_GET['id'])?$_GET['id']:0;

    // para criar um objeto
    // adicionar arquivo da classe
    require_once("../classes/Tabuleiro.class.php");

    if ($acao == 'editar'){
        try{
            // cria um tabuleiro qualquer para chamar a função listar
            $tab = new Tabuleiro($id,1);
            // busca o tabuleiro pelo id
            $lista = $tab->listar(1,$id);

            // atualiza os dados do tabuleiro com os valores corretos trazidos pela função listar
            $tab->setLado($lista[0]['lado']);
            
        }catch(Exception $e){
            print($e->getMessage());
        }
    }
?>
    <form action="processa.php" method='POST'>
        <fieldset>
            <legend>Cadastro</legend>
            <label for="Id">Id</label>
            <input type="text" name="id" readonly value="<?php if (isset($tab)) echo $tab->getId()?>">
            <label for="lado">Lado</label>
            <input type="text" name="lado" value="<?php if (isset($tab)) echo $tab->getLado()?>">
            <input type="submit" name="acao" value="Salvar">
        </fieldset>
    </form>
    <br>
    <form>
        <fieldset>
            <legend>Filtro</legend>
            <input type="radio" name="tipo" value=1>Id
            <input type="radio" name="tipo" value=2>Lado
            <input type="text" name="procurar">
            <input type="submit" name="enviar" value="Busca">
        </fieldset>
        
    </form>
<?php    

// criar o objeto
try{ // usar try para pegar erros que podem ocorrer durante a execução
    $tab = new Tabuleiro(1,1);
    $tipo = isset($_GET['tipo'])?$_GET['tipo']:0;
    $procurar = isset($_GET['procurar'])?$_GET['procurar']:0;

    $lista = $tab->listar($tipo,$procurar);
    ?>
    <br>
    <table border="1">
        <thead><th>Id</th><th>Lado</th><th>#</th><th>#</th></thead>
    <?php
    foreach($lista as $linha){
        echo "<tr>";
        $excluir = "processa.php?acao=excluir&id=".$linha['idtabuleiro'];
        $alterar = "index.php?acao=editar&id=".$linha['idtabuleiro'];
        $consultar = "processa.php?acao=consultar&id=".$linha['idtabuleiro'];
        echo "<td><a href='".$consultar."'>".$linha['idtabuleiro']."</a></td><td>".$linha['lado']."</td><td><a href=".$alterar.">Alterar</a><td><a href=".$excluir.">Excluir</a></td>";
        echo "</tr>";
    }
}catch (Exception $e){ // se ocorrer erros eles cairá nesse catch e apresentará a mensagem 
    print($e->getMessage());
}

?>
    <table>
</body>


</html>