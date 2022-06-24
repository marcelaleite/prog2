<?php

require_once "Forma.class.php";
/**
 * A classe quadrado é uma especialização da classe Forma
 * Essa classe mantém as informações de um quadrado
 */
class Quadrado extends Forma{ 
    private $lado;

    /**
     * O construtor da classe quadrado deve chamar o construtor da
     * super classe (classe pai) enviando os argumentos que esse espera
     * por isso também deve incluir em seus parâmetros essas variáveis  
     * 
     */
    public function __construct($id,$lado,$cor,$tab){
        parent::__construct($id,$cor,$tab);
        $this->setLado($lado);  
    }
    

    public function setLado($l){ 
        if ($l > 0)
            $this->lado = $l;
        else 
            throw new Exception("O lado deve ser maior que zero.");
    }    

    public function getLado(){ return $this->lado;}
   
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
    public function insere(){             
        // montar sql - comando para inserir os dados
        $sql = "INSERT INTO quadrado (lado, cor, tabuleiro_idtabuleiro) VALUES(:l,:c, :t)";
        $parametros = array(":l"=>$this->getLado(),
                            ":c"=>$this->getCor(),
                            ":t"=>$this->getTabuleiro());
        return parent::executaComando($sql,$parametros);
    }

    /**
     * Excluir um quadrado no banco de dados
     * @access public
     * @return boolean
     *  */ 
    public function excluir(){  
        // montar sql - comando para inserir os dados
        $sql = "DELETE FROM quadrado WHERE idquadrado = :id";
        $par = array(':id'=>$this->getId());
        // executar e retornar o resultado
        return parent::executaComando($sql,$par);
    }

    /**
     * Alterar um quadrado no banco de dados 
     * @access public
     * @return boolean
     */   
    public function alterar(){
        // montar sql - comando para inserir os dados
        $sql = "UPDATE quadrado 
               SET lado = :l, cor = :c, tabuleiro_idtabuleiro = :idt
               WHERE idquadrado = :idq";
        
        // vincular os parâmetros
        $par = array(':l'=>$this->getLado(),
                     ':c'=>$this->getCor(),
                     ':idt'=>$this->getTabuleiro(),
                     ':idq'=>$this->getId());
        // executar e retornar o resultado
        return parent::executaComando($sql,$par);

    }

    /**
     * Listar ou buscar um elemento da tabela 
     * @access public
     * @param int $tipo informar o tipo de pesquisa, 0 para listar todos
     * @param String $info informar texto para a pesquisa
     * @return Array vetor multidimensional com todos os dados
     */
    public static function listar($tipo = 0,$info = ""){
        
        $sql = "SELECT * FROM quadrado";
        // adicionar parâmetros
        if ($tipo > 0)
            switch($tipo){
                case(1): $sql .= " WHERE idquadrado = :info"; break;
                case(2): $sql .= " WHERE lado like :info"; $info .="%";  break;
                case(3): $sql .= " WHERE cor like :info";  $info = "%".$info."%"; break;
                case(4): $sql .= " WHERE tabuleiro_idtabuleiro = :info";  break;
            }
        
        if ($tipo > 0)
            $par = array(':info'=>$info);
        else
            $par = array();
        return parent::buscar($sql,$par);
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