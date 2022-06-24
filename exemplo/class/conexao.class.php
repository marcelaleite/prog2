<?php
require_once('config/config.ini.php');
class Conexao{
  private $conexao;
  private static $instance;

  private function __construct(){
    try{
      $this->conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
    }catch (PDOException $e){
      print('Erro ao conectar com o banco de dados: '.$e->getMessage());
    }
  }
  public static function getInstance(){
    if (empty(self::$instance)){
      self::$instance = new self();
    }
    return self::$instance;
  }
  public function getConexao(){
    return $this->conexao;
  }
}
 ?>
