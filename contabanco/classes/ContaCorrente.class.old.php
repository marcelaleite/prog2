<?php
class ContaCorrente{
    private $cc_numero;
    private $cc_saldo;
    private $cc_pf_id;
    private $cc_dt_ultima_alteracao;

    public function __construct($numero,$saldo,$pf_id,$dt){
        $this->setNumero($numero);
        $this->setSaldo($saldo);
        $this->setPf($pf_id);
        $this->setDtUltimaAlteracao($dt);

    }

    public function getNumero(){ return $this->cc_numero;}

    public function setNumero($numero){
        if ($numero > 0 && $numero <> "")
            $this->cc_numero = $numero; 
        else
            throw new Exception("Número de conta 
                                inválido: ".$numero);
    }

    public function getSaldo(){ return $this->cc_saldo;}

    public function setSaldo($saldo){ 
        if ($saldo >= 0 && $saldo <> "")
            $this->cc_saldo = $saldo; 
        else
            throw new Exception("Saldo  
                                inválido: ".$saldo);
    }

    public function getPf(){ return $this->cc_pf_id;}
    
    public function setPf($pf){ 
        if ($pf > 0 && $pf <> "")
            $this->cc_pf_id = $pf; 
        else
            throw new Exception("Pessoa Física 
                                inválida: ".$pf);
       
    }

    public function getDtUltimaAlteracao(){ return $this->cc_dt_ultima_alteracao;}
    
    public function setDtUltimaAlteracao($dt){ 
        if ($dt > 0 && $dt <> "")
        $this->cc_dt_ultima_alteracao = $dt; 
    else
        throw new Exception("Data de última alteração 
                            inválida: ".$dt);
    }

    public function insere(){
        require_once("conexao.php");
        // criar variável conexão]
        // $conexao = Conexao::getInstance();
        $query = 'INSERT INTO conta_corrente
                   VALUES(:numero,:saldo,:pf_id,:dt)';
       
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':numero',$this->cc_numero);
        $stmt->bindParam(':saldo',$this->cc_saldo);
        $stmt->bindParam(':pf_id',$this->cc_pf_id);
        $stmt->bindParam(':dt',$this->cc_dt_ultima_alteracao);

        return $stmt->execute();
    }

    public function buscar($id){
        // id da pessoa 
        require_once("conexao.php");
        $query = 'SELECT * FROM conta_corrente';
       // $conexao = Conexao::getInstance();
        if($id > 0){
            $query = $query . ' WHERE cc_pf_id = :Id';
            $stmt->bindParam(':Id',$id);
        }

        $stmt = $conexao->prepare($query);
        if ($stmt->execute())
            return $stmt->fetchAll();
        
        return false; 
    }
    
}

?>