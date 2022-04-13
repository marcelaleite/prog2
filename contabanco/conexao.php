<?php
require_once('config.ini.php');
  try{
      $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
    }catch (PDOException $e){
      print('Erro ao conectar com o banco de dados: '.$e->getMessage());
    }

?>
