<?php
require_once "../classes/Database.class.php";
/**
 * Super classe Forma que irá definir aquilo que é comum para toda
 * as formas (Classe Pai)
 */
class Forma extends Database{
    private $id;
    private $cor;
    private $tabuleiro;
    public static $contador = 0; // compartilhar entre todos os objetos

    /**
     * Construtor da classe Forma
     * @access public
     * @return void
     * @param int $id Informar o id do banco do quadrado..
     * @param String $cor cor do quadrado
     * @param int $tab id do tabuleiro
     */
    public function __construct($id,$cor,$tab){
        $this->setCor($cor);
        $this->setTabuleiro($tab);
        $this->setId($id);
        self::$contador = self::$contador + 1 ;
    }
    
    public function setId($id){ 
        $this->id = $id;
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
    public function getTabuleiro(){ return $this->tabuleiro;}
    public function getId(){ return $this->id;}

    /**
     * Função que converte o objeto para uma String para impressão
     * @access public
     * @return String
     */
    public function __toString()
    {
        return "Id: ".$this->getId().", Cor: ".$this->getCor().", Tab: ".$this->getTabuleiro(). "Contador: ".self::$contador;
    }    

}

?>