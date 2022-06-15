<?php
// carregar dados enviados pelo formulário na página index.php
$lado = isset($_POST['lado'])?$_POST['lado']:1;
$cor = isset($_POST['cor'])?$_POST['cor']:" ";
$tab = isset($_POST['tab'])?$_POST['tab']:1;

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
require_once("../classes/Quadrado.class.php");

try{ 
    // cria objeto quadrado com os valores carregados acima
    $quad = new Quadrado($id,$lado,$cor,$tab);
    if ($acao == "Salvar"){
        if ($id > 0) // atualizar existente
            $quad->alterar();
        else         // novo registro pq o id não foi enviado
            $quad->insere();

    }elseif($acao == "excluir"){  // excluir um registro
            $quad->excluir();
    }elseif($acao == "consultar"){
        header("location:consulta.php?id=".$id);    
        exit();
    }
    header("location:index.php");
}catch(Exception $e){ // pega todos os erros de execução
    print($e->getMessage()); // apresenta a mensagem de erro disparada pela classe
}

?>