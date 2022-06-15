<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quadrado</title>
</head>
<body>
<?php
    //pega os dados que vem via get para edição
    $acao = isset($_GET['acao'])?$_GET['acao']:"";
    $id = isset($_GET['id'])?$_GET['id']:0;

    // para criar um objeto
    // adicionar arquivo da classe
    require_once("../classes/Quadrado.class.php");

    if ($acao == 'editar'){
        try{
            // busca o quadrado pelo id
            $lista = Quadrado::listar(1,$id); // método estático da classe
            // cria um quadrado qualquer para chamar a função listar
            $quad = new Quadrado($id,$lista[0]['lado'],$lista[0]['cor'],$lista[0]['tabuleiro_idtabuleiro']);            
        }catch(Exception $e){
            print($e->getMessage());
        }
    }
?>
    <form action="processa.php" method='POST'>
        <fieldset>
            <legend>Cadastro</legend>
            <label for="Id">Id</label>
            <input type="text" name="id" readonly value="<?php if (isset($quad)) echo $quad->getId()?>">
            <label for="lado">Lado</label>
            <input type="text" name="lado" value="<?php if (isset($quad)) echo $quad->getLado()?>">
            <label for="cor">Cor</label>
            <input type="color" name="cor" value="<?php if (isset($quad)) echo $quad->getCor()?>">
            <label for="tab">Tabuleiro</label>
            <select name="tab">
                <option value=0>Selecione</option>
                <?php
                    require_once("../classes/Tabuleiro.class.php");
                    $lista = Tabuleiro::listar();
                    $check = "";
                    foreach($lista as $item){                        
                            if (isset($quad)) 
                                if ($quad->getTabuleiro() == $item['idtabuleiro'])
                                    $check = "selected";
                        ?>
                            <option <?=$check?> value="<?=$item['idtabuleiro']?>"
                                ><?php echo "Tab: ".$item['idtabuleiro']." - Lado:"
                                    .$item['lado']?></option>
                        <?php
                            $check = "";
                    }
                ?>
            </select>
            <input type="submit" name="acao" value="Salvar">
        </fieldset>
    </form>
    <br>
    <form>
        <fieldset>
            <legend>Filtro</legend>
            <input type="radio" name="tipo" value=1>Id
            <input type="radio" name="tipo" value=2>Lado
            <input type="radio" name="tipo" value=3>Cor
            <input type="radio" name="tipo" value=4>Tabuleiro
            <input type="text" name="procurar">
            <input type="submit" name="enviar" value="Busca">
        </fieldset>
        
    </form>
<?php    

// criar o objeto
try{ // usar try para pegar erros que podem ocorrer durante a execução
    $quad = new Quadrado(1,1,"a",1);
    $tipo = isset($_GET['tipo'])?$_GET['tipo']:0;
    $procurar = isset($_GET['procurar'])?$_GET['procurar']:0;

    $lista = $quad->listar($tipo,$procurar);
    ?>
    <br>
    <table border="1">
        <thead><th>Id</th><th>Lado</th><th>Cor</th><th>Tabuleiro</th><th>#</th><th>#</th></thead>
    <?php
    foreach($lista as $linha){
        echo "<tr>";
        $excluir = "processa.php?acao=excluir&id=".$linha['idquadrado'];
        $alterar = "index.php?acao=editar&id=".$linha['idquadrado'];
        $consultar = "processa.php?acao=consultar&id=".$linha['idquadrado'];
        echo "<td><a href='".$consultar."'>".$linha['idquadrado']."</a></td><td>".$linha['lado']."</td><td>".$linha['cor']."</td><td>".$linha['tabuleiro_idtabuleiro']."</td><td><a href=".$alterar.">Alterar</a><td><a href=".$excluir.">Excluir</a></td>";
        echo "</tr>";
    }
}catch (Exception $e){ // se ocorrer erros eles cairá nesse catch e apresentará a mensagem 
    print($e->getMessage());
}

?>
    <table>
</body>


</html>