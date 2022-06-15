<?php
// carregar dados enviados pelo formulário na página index.php
$lado = isset($_POST['lado'])?$_POST['lado']:1;

$id = 0;
if (isset($_POST['id']))  // se o id for enviado via post é uma edição
    $id = $_POST['id'];
else  // se for exclusão os dados virão via GET
    $id = isset($_GET['id'])?$_GET['id']:0;
$acao = "";
if (isset($_POST['acao']))
    $acao = $_POST['acao'];
else // se for exclusão os dados virão via GET
    $acao = isset($_GET['acao'])?$_GET['acao']:"";

// para criar um objeto
// adicionar arquivo da classe
require_once("../classes/Tabuleiro.class.php");

try{ 
    // cria objeto Tabuleiro com os valores carregados acima
    $tab = new Tabuleiro($id,$lado);

    if ($acao == "Salvar"){
        if ($id > 0) // atualizar existente
            $tab->alterar();
        else         // novo registro pq o id não foi enviado
            $tab->insere();

    }elseif($acao == "excluir"){  // excluir um registro
           $tab->excluir();
           
    }elseif($acao == "consultar"){
        header("location:consulta.php?id=".$id);    
        exit();
    }
    header("location:index.php");
}catch(Exception $e){ // pega todos os erros de execução
    print($e->getMessage()); // apresenta a mensagem de erro disparada pela classe
}

?>