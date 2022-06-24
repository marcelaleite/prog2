window.onload = function(){
  document.getElementById('name').addEventListener('keyup',function(){
    buscaUsuarios();
  });
}

function buscaUsuarios(){
  ajax = new XMLHttpRequest();
  ajax.onreadystatechange = function(){
    if (this.status == 200 && this.readyState == 4){
      dados = JSON.parse(this.responseText);
      lista = document.getElementById('minhaLista');
      while(lista.hasChildNodes())
        lista.firstChild.remove();
      for(i in dados){
        el = document.createElement('OPTION');
        el.innerHTML = dados[i].nome;
        lista.appendChild(el);
      }
    }
  }
  nome = document.getElementById('name').value;
  ajax.open('GET','listaUsuarios.php?name='+nome,true);
  ajax.send();

}
