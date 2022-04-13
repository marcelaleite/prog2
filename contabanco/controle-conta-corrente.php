<?php

require_once("classes/PessoaFisica.class.php");
require_once("classes/ContaCorrente.class.php");

function exibir_como_select($chave,$dados){
    $str = "<option value=0>Selecione</option>";
    foreach($dados as $linha){
       $str .= "<option value='".$linha[$chave[0]]."'>".$linha[$chave[1]]."</option>";
    }
    return $str;
}


function lista_pessoa($id){
    $pessoa = new PessoaFisica("","","","");
    $lista = $pessoa->buscar($id);
    return exibir_como_select(array('pf_id','pf_nome'),$lista);
}

if($_POST["acao"] == "salvar"){
    $numero = isset($_POST['cc-numero'])?$_POST['cc-numero']:0;
    $saldo = isset($_POST['cc-saldo'])?$_POST['cc-saldo']:0;
    $dt = isset($_POST['cc-dt-ultima-alteracao'])?$_POST['cc-dt-ultima-alteracao']:0;
    $pf = isset($_POST['cc-pf'])?$_POST['cc-pf']:0;
    // criar conta corrente

    $conta = new ContaCorrente($numero,$saldo,$pf,$dt);
    // chamar função inserir
    if($conta->insere())
        echo "Cadastro Efetuado com sucesso";
    else
        echo "Erro ao efetuar cadastro";

    


}


?>