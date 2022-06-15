<?php
/**
 * A classe quadrado é uma especialização da classe Forma
 * Essa classe mantém as informações de um quadrado
 */
class Quadrado extends Forma{ 
    private $lado;

    /**
     * O construtos da classe quadrado deve chamar o construtor da
     * super classe (classe pai) enviando os argumentos que esse espera
     * por isso também deve incluir em seus parâmetros essas variáveis  
     */
    public function __construct($id,$lado,$cor,$tab){
        parent::__construct($id,$cor,$tab);
        $this->setLado($lado);  
    }
    
    public function setId($id){ 
        $this->id = $id;
    }

    public function setLado($l){ 
        if ($l > 0)
            $this->lado = $l;
        else 
            throw new Exception("O lado deve ser maior que zero.");
    }
        
    public function setCor($c){ 
        if ($c != "")
            $this->cor = $c;
        else
            throw new Exception("Cor $c inválida. Informe uma cor.");
    }

    public function setTabuleiro($tab){ 
        if ($tab > 0)
            $this->tabuleiro = $tab;
        else 
            throw new Exception("Tabuleiro Inválido. Selecione um tabuleiro para adicionar o quadrado.");
    }

    public function getCor(){ return $this->cor; }
    public function getLado(){ return $this->lado;}
    public function getTabuleiro(){ return $this->tabuleiro;}
    public function getId(){ return $this->id;}

    /**
     * Calcula o perímetro do quadrado
     * @access public
     * @return int
     */
    public function perimetro(){      

        return $this->getLado()*4;
    }


    /**
     * Insere um quadrado no banco de dados
     * @access public
     * @return boolean
     *  */ 
    public static function insere($lado,$cor,$tabuleiro){
        // adicionar arquivo de conexao
        require_once("../classes/Conexao.class.php");
        // abrir conexao com o banco
        $conexao = Conexao::getInstance();
          
        // montar sql - comando para inserir os dados
        $sql = "INSERT INTO quadrado (lado, cor, tabuleiro_idtabuleiro) VALUES(:l,:c, :t)";
        // preparar o comando
        $comando = $conexao->prepare($sql);        
        // vincular os parâmetros
        $comando->bindValue(':l',$lado,PDO::PARAM_INT);
        $comando->bindValue(':c',$cor,PDO::PARAM_STR);
        $comando->bindValue(':t',$tabuleiro,PDO::PARAM_INT);
        // executar e retornar o resultado
        if ($comando->execute())
            return $conexao->lastInsertId();
        else{
            throw new Exception($comando->debugDumpParams());
        }

    }

    /**
     * Excluir um quadrado no banco de dados
     * @access public
     * @return boolean
     *  */ 
    public function excluir(){
        // adicionar arquivo de conexao
        require_once("../classes/Conexao.class.php");
        // abrir conexao com o banco
        $conexao = Conexao::getInstance();
        
        // montar sql - comando para inserir os dados
        $sql = "DELETE FROM quadrado WHERE idquadrado = :q";
        // preparar o comando
        $comando = $conexao->prepare($sql);        
        // vincular os parâmetros
        $comando->bindValue(':q',$this->getId(),PDO::PARAM_INT);
        // executar e retornar o resultado
        if ($comando->execute())
            return $conexao->lastInsertId();
        else{
            throw new Exception($comando->debugDumpParams());
        }

    }

    /**
     * Alterar um  um quadrado no banco de dados 
     * @access public
     * @return boolean
     */   
    public function alterar(){
        // adicionar arquivo de conexao
        require_once("../classes/Conexao.class.php");
        // abrir conexao com o banco
        $conexao = Conexao::getInstance();

        // montar sql - comando para inserir os dados
        $sql = "UPDATE quadrado 
               SET lado = :l, cor = :c, tabuleiro_idtabuleiro = :idt
               WHERE idquadrado = :idq";
        // preparar o comando
        $comando = $conexao->prepare($sql);        
        // vincular os parâmetros
        $comando->bindValue(':l',$this->getLado(),PDO::PARAM_INT);
        $comando->bindValue(':c',$this->getCor(),PDO::PARAM_STR);
        $comando->bindValue(':idt',$this->getTabuleiro(),PDO::PARAM_INT);
        $comando->bindValue(':idq',$this->getId(),PDO::PARAM_INT);
        // executar e retornar o resultado
        if ($comando->execute())
            return $conexao->lastInsertId();
        else{
            throw new Exception($comando->debugDumpParams());
        }

    }

    /**
     * Listar ou buscar um elemento da tabela 
     * @access public
     * @param int $tipo informar o tipo de pesquisa, 0 para listar todos
     * @param String $info informar texto para a pesquisa
     * @return Array vetor multidimensional com todos os dados
     */
    public static function listar($tipo = 0,$info = ""){
        // adicionar arquivo de conexao
        require_once("../classes/Conexao.class.php");
        // abrir conexao com o banco
        $conexao = Conexao::getInstance();
        // montar sql - comando para inserir os dados
        $sql = "SELECT * FROM quadrado";
        // adicionar parâmetros
        if ($tipo > 0)
            switch($tipo){
                case(1): $sql .= " WHERE idquadrado = :info"; break;
                case(2): $sql .= " WHERE lado like :info"; $info .="%";  break;
                case(3): $sql .= " WHERE cor like :info";  $info = "%".$info."%"; break;
                case(4): $sql .= " WHERE tabuleiro_idtabuleiro = :info";  break;
            }
        // preparar o comando
        $comando = $conexao->prepare($sql);        
        // vincular os parâmetros
        if ($tipo > 0)
            $comando->bindValue(':info',$info);
        // executar e retornar o resultado
        $comando->execute();
        return $comando->fetchAll();
    }

    /**
     * Função que converte o objeto para uma String para impressão
     * @access public
     * @return String
     */
    public function __toString()
    {   
        $str = parent::__toString();
        return $str." Lado: ".$this->getLado(). ", Perímetro: ".$this->perimetro();
    }

    /**
     * Função que retorna uma String com as informações para apresentar a forma
     * @access public
     * @return String
     */
    public function desenha(){
        $str = "<div style='display:block;border:1px;background-color:".$this->getCor().";width:".$this->getLado()."px;height:".$this->getLado()."px'></div>";
        return $str;
    }

}

?>