<?php
class ContaCorrente{
    // definir atributos da classe
    private $cc_numero = 0;  // número da conta
    private $cc_saldo = 0;
    private $cc_pf_id;
    private $cc_dt_ultima_alteracao;


    public function __construct($nm, $saldo,$pf,$dt){
        $this->setCcNumero($nm);
        $this->setCcSaldo($saldo);
        $this->setCcPfId($pf);
        $this->setCcDtUltimaAlteracao($dt);        
    }   




    /**
     * Get the value of cc_numero
     */
    public function getCcNumero()
    {
        return $this->cc_numero;
    }

    /**
     * Set the value of cc_numero
     */
    public function setCcNumero($cc_numero): self
    {
        $this->cc_numero = $cc_numero;

        return $this;
    }

    /**
     * Get the value of cc_saldo
     */
    public function getCcSaldo()
    {
        return $this->cc_saldo;
    }

    /**
     * Set the value of cc_saldo
     */
    public function setCcSaldo($cc_saldo) {
        if ($cc_saldo >= 0)
            $this->cc_saldo = $cc_saldo;

    }

    /**
     * Get the value of cc_pf_id
     */
    public function getCcPfId()
    {
        return $this->cc_pf_id;
    }

    /**
     * Set the value of cc_pf_id
     */
    public function setCcPfId($cc_pf_id)  {
        $this->cc_pf_id = $cc_pf_id;

    }

    /**
     * Get the value of cc_dt_ultima_alteracao
     */
    public function getCcDtUltimaAlteracao()
    {
        return $this->cc_dt_ultima_alteracao;
    }

    /**
     * Set the value of cc_dt_ultima_alteracao
     */
    public function setCcDtUltimaAlteracao($cc_dt_ultima_alteracao): self
    {
        $this->cc_dt_ultima_alteracao = $cc_dt_ultima_alteracao;

        return $this;
    }


    // criar função para efetuar o saque
    public function saque($valor){

        // atualizar o valor do saldo com $this->saldo - valor informado
        $novoSaldo = $this->getCcSaldo() - $valor;
        // validar se saldo suficiente 
        $this->setCcSaldo($novoSaldo);

        // atualizar dt_ultima_alteração
        $this->setCcDtUltimaAlteracao(date('dd/mm/aaaa',time()));

        // atualizar banco de dados
        $this->update();

        // retornar ultimo saldo atualizado
        return $this->getCcSaldo();
    }


    public function update(){
        // requires ..
        // cria conexão
        // monta sql
        // prepara e efetua os binds
        // executa
        // retorna processamento
    }
}


?>