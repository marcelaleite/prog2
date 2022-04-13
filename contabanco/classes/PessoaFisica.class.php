<?php
class PessoaFisica{
    private $pf_id;
    private $pf_cpf;
    private $pf_nome;
    private $pf_dt_nascimento;

    public function __construct($id,$cpf,$nome,$dtNasci){
        $this->pf_id = $id;
        $this->pf_cpf = $cpf;
        $this->pf_nome = $nome;
        $this->pf_dt_nascimento = $dtNasci;
    }

    public function getId(){  return $this->pf_id; }
    public function getCpf(){  return $this->pf_cpf; }
    public function getNome(){  return $this->pf_nome; }
    public function getDtNascimento(){  return $this->pf_dt_nascimento; }

    public function setId($id) { $this->pf_id = $id; }
    public function setCpf($cpf) { $this->pf_cpf = $cpf; }
    public function setNome($nome) { $this->pf_nome = $nome; }
    public function setDtNascimento($dt_nascimento) { 
        $this->pf_dt_nascimento = $dt_nascimento; 
    }

    public function buscar($id){

        require_once("conexao.php");
        $query = 'SELECT * FROM pessoa_fisica';
       // $conexao = Conexao::getInstance();
        if($id > 0){
            $query = $query . ' WHERE pf_id = :Id';
            $stmt->bindParam(':Id',$id);
        }

        $stmt = $conexao->prepare($query);
        if ($stmt->execute())
            return $stmt->fetchAll();
        
        return false; 
    }

}








?>