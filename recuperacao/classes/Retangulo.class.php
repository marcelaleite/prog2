<?php

require_once('Forma.class.php');

class Retangulo extends Forma{
    private $altura;
    private $base;

    public function __construct($id,$cor,$tab,$altura,$base){
        parent::__construct($id,$cor,$tab);
        $this->setAltura($altura);        
        $this->setBase($base);        
    }

    /**
     * Get the value of altura
     */
    public function getAltura()
    {
        return $this->altura;
    }

    /**
     * Set the value of altura
     */
    public function setAltura($altura)
    {
        $this->altura = $altura;

        return $this;
    }

    /**
     * Get the value of base
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * Set the value of base
     */
    public function setBase($base)
    {
        $this->base = $base;

        return $this;
    }

    public function __toString() {
        $str = parent::__toString();
        $str .= " Altura:".$this->getAltura().", Base:".$this->getBase();
        return $str;
    }
}


$ret = new Retangulo(1,'rosa',1,10,40);
var_dump($ret);
//echo $ret;
?>