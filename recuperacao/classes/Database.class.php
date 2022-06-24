<?php

class Database{
    public static function iniciaConexao(){
        // adicionar arquivo de conexao
        require_once("../classes/Conexao.class.php");
        // abrir conexao com o banco
        return Conexao::getInstance();
    }
    public static function vinculaParametros($comando,$parametros=array()){
        foreach($parametros as $chave=>$valor){
            $comando->bindValue($chave,$valor);
        }
        return $comando;
    }
    /**
     * Insere um quadrado no banco de dados
     * @access public
     * @return boolean
     *  */ 
    public static function executaComando($sql,$parametros=array()){
        $conexao = self::iniciaConexao();          
        $comando = $conexao->prepare($sql);       
        $comando = self::vinculaParametros($comando,$parametros);
        try{
            return $comando->execute();
        }catch (PDOException $e){
            throw new Exception('Erro na execução do comando: '.$e->getMessage());
        }            
    }

    /**
     * Buscar um elemento da tabela 
     * @access static public
     * @return Array vetor multidimensional com todos os dados
     */
    public static function buscar($sql, $parametros=array()){
        $conexao = self::iniciaConexao();          
        $comando = $conexao->prepare($sql);       
        $comando = self::vinculaParametros($comando,$parametros);
        $comando->execute();
        return $comando->fetchAll();
    }

}


?>