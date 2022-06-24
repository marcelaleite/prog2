<?php
// Cada página chama essa função, informando seu caminho à raiz como parâmetro
function valida_secao($root_path) {
  session_start();
  if(!isset($_SESSION['username'])) {
    header("location:" . $root_path . "entrar");
  }
}

function valida_secao_tipo ($root_path, $tipo) {
  valida_secao($root_path);
  
  if (is_array($tipo)) {
    
    if (!in_array($_SESSION['tipo'], $tipo)) {
      header("location:" . $root_path . "entrar");  
    }

  } else {

    if ($_SESSION['tipo'] != $tipo) {
      header("location:" . $root_path . "entrar");
    }

  }
}
?>
