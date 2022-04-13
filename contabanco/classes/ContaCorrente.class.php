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
    public function setNumero($numero){ $this->cc_numero = $numero; }

    public function getSaldo(){ return $this->cc_saldo;}
    public function setSaldo($saldo){ $this->cc_saldo = $saldo; }

    public function getPf(){ return $this->cc_pf_id;}
    public function setPf($pf){ $this->cc_pf_id = $pf;}

    public function getDtUltimaAlteracao(){ return $this->cc_dt_ultima_alteracao;}
    public function setDtUltimaAlteracao($dt){ $this->cc_dt_ultima_alteracao = $dt;}

    public function insere(){
        require_once("conexao.php");
        // criar variável conexão
        $query = 'INSERT INTO conta_corrente
                   VALUES(:numero,:saldo,:pf_id,:dt)';
       
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':numero',$this->cc_numero);
        $stmt->bindParam(':saldo',$this->cc_saldo);
        $stmt->bindParam(':pf_id',$this->cc_pf_id);
        $stmt->bindParam(':dt',$this->cc_dt_ultima_alteracao);

        return $stmt->execute();
    }
    
}

?>