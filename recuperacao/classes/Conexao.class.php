<?php
require_once('../conf/config.inc.php');
class Conexao{
  private static $instance;

  private function __construct(){
 //
  }
  
  public static function getInstance(){
    if (empty(self::$instance)){
      try{
        self::$instance = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
      }catch (PDOException $e){
        print('Erro ao conectar com o banco de dados: '.$e->getMessage());
      }
    }
    return self::$instance;
  }

}
 ?>