<?php

require_once("classes/PessoaFisica.class.php");
require_once("classes/ContaCorrente.class.php");



if($_POST["acao"] == "salvar"){
    $numero = isset($_POST['cc-numero'])?$_POST['cc-numero']:0;
    $saldo = isset($_POST['cc-saldo'])?$_POST['cc-saldo']:0;
    $dt = isset($_POST['cc-dt-ultima-alteracao'])?$_POST['cc-dt-ultima-alteracao']:0;
    $pf = isset($_POST['cc-pf'])?$_POST['cc-pf']:0;
    // criar conta corrente

    try{
        $conta = new ContaCorrente($numero,$saldo,$pf,$dt);
        // chamar função inserir
        if($conta->insere())
            echo "Cadastro Efetuado com sucesso";
        else
            echo "Erro ao efetuar cadastro";
    }catch(Exception $e){
        echo "<h1> Erro ao cadastrar conta.</h1>
             <br> Erro: ".$e->getMessage();
    }
}


?>