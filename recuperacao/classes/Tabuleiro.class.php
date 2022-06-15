<?php
class Tabuleiro{

    /**
     * Grava o identificador do Tabuleiro, usado para tabuleiros já definidos
     * @access private
     * @name idTabuleiro
     */
    private $idTabuleiro;
    /**
     * Armazena o tamanho em centímetros do lado do tabuleiro, como tem forma de quadrado
     * @access private
     * @name lado
     */
    private $lado;

    /**
     * Construtor da classe. O parâmetro id não é obrigatório
     * @access public
     * @param int identificador
     * @param int lado 
     * @return void
     */
    public function __construct($id,$ld){
        $this->setIdTabuleiro($id);
        $this->setLado($ld);
    }

    public function setIdTabuleiro($id){
        $this->idTabuleiro = $id;
    }

    public function setLado($ld){
        $this->lado = $ld;
    }

    public function getLado() {return $this->lado; }
    public function getId() {return $this->idTabuleiro; }

    /**
     * Lista todos os tabuleiros do banco conforme argumentos enviados
     * @access public
     * @param int $tipo tipo de pesquisa
     * @param String $info informação de pesquisa
     * @return Array retorna um array multidimensional com a lista dos tabuleiros
     */
    public static function listar($tipo = 0,$info = ""){
        // adicionar arquivo de conexao
        require_once("../classes/Conexao.class.php");
        // abrir conexao com o banco
        $conexao = Conexao::getInstance();
        // montar sql - comando para inserir os dados
        $sql = "SELECT * FROM tabuleiro";
        // adicionar parâmetros
        if ($tipo > 0)
            switch($tipo){
                case(1): $sql .= " WHERE idtabuleiro = :info"; break;
                case(2): $sql .= " WHERE lado like :info"; $info .="%";  break;
            }
        // preparar o comando
        $comando = $conexao->prepare($sql);        
        // vincular os parâmetros
        if ($tipo > 0)
            $comando->bindValue(':info',$info);
        // executar e retornar o resultado
        $comando->execute();
        // retorna os resultados da consulta    
        return $comando->fetchAll();
    }

   /**
     * Insere um tabuleiro no banco de dados
     * @access public
     * @return boolean
     *  */ 
    public function insere(){
        // adicionar arquivo de conexao
        require_once("../classes/Conexao.class.php");
        // abrir conexao com o banco
        $conexao = Conexao::getInstance();
          
        // montar sql - comando para inserir os dados
        $sql = "INSERT INTO tabuleiro (lado) VALUES(:l)";
        // preparar o comando
        $comando = $conexao->prepare($sql);        
        // vincular os parâmetros
        $comando->bindValue(':l',$this->getLado(),PDO::PARAM_INT);
        // executar e retornar o resultado
        if ($comando->execute())
            return $conexao->lastInsertId();
        else{
            throw new Exception($comando->debugDumpParams());
        }
    }

    /**
     * Excluir um tabuleiro no banco de dados
     * @access public
     * @return boolean
     *  */ 
    public function excluir(){
        // adicionar arquivo de conexao
        require_once("../classes/Conexao.class.php");
        // abrir conexao com o banco
        $conexao = Conexao::getInstance();
        
        if ($this->validaRelacao() == 0){
            // montar sql - comando para inserir os dados
            $sql = "DELETE FROM tabuleiro WHERE idtabuleiro = :q";
            // preparar o comando
            $comando = $conexao->prepare($sql);        
            // vincular os parâmetros
            $comando->bindValue(':q',$this->getId(),PDO::PARAM_INT);
            // executar e retornar o resultado

            if ($comando->execute())
                return true;
            else{
                throw new Exception($comando->errorInfo()[0]);
            }
        }else{
            throw new Exception('Não pode excluir o tabuleiro '.$this->getId().". Já possui quadrado associado.");
        }

    }

    public function validaRelacao(){
        // adicionar arquivo de conexao
        require_once("../classes/Conexao.class.php");
        // abrir conexao com o banco
        $conexao = Conexao::getInstance();
    
        // montar sql - comando para inserir os dados
        $sql = "SELECT * FROM quadrado WHERE tabuleiro_idtabuleiro = :q";
        // preparar o comando
        $comando = $conexao->prepare($sql);        
        // vincular os parâmetros
        $comando->bindValue(':q',$this->getId(),PDO::PARAM_INT);
        // executar e retornar o resultado

        $comando->execute();
        return $comando->rowCount();
  
    }

    /**
     * Alterar um  tabuleiro no banco de dados 
     * @access public
     * @return boolean
     */   
    public function alterar(){
        // adicionar arquivo de conexao
        require_once("../classes/Conexao.class.php");
        // abrir conexao com o banco
        $conexao = Conexao::getInstance();

        // montar sql - comando para inserir os dados
        $sql = "UPDATE tabuleiro 
               SET lado = :l
               WHERE idtabuleiro = :idq";
        // preparar o comando
        $comando = $conexao->prepare($sql);        
        // vincular os parâmetros
        $comando->bindValue(':l',$this->getLado(),PDO::PARAM_INT);
        // executar e retornar o resultado
        return $comando->execute();
    }
    /**
     * Função que retorna uma String com as informações para apresentar a forma
     * @access public
     * @return String
     */
    public function desenha(){
        $str = "<div style='display:block;border:1px;background-color:white;width:".$this->getLado()."px;height:".$this->getLado()."px'></div>";
        return $str;
    }
    
}

?>