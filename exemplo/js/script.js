window.onload = function(){
  document.getElementById('busca').addEventListener('keyup',function(){
    buscaUsuarios();
  });
}

function buscaUsuarios(){
  ajax = new XMLHttpRequest();
  ajax.onreadystatechange = function(){
    if (this.status == 200 && this.readyState == 4){
      dados = JSON.parse(this.responseText);
      str = "";
      options = document.getElementById('minhaLista');
      while (options.hasChildNodes()){
        options.firstChild.remove();
      }
      for (i in dados){
        el = document.createElement('OPTION');
        el.innerHTML = dados[i].nome;
        document.getElementById('minhaLista').appendChild(el);

      }
    }
  }
  nome = document.getElementById('busca').value;
  ajax.open('GET','listaUsuarios.php?name='+nome,true);
  ajax.send();
}
