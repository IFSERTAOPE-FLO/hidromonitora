function QTDsenha(){
  var senha = document.getElementById('senha');
  if(senha.value.length < 6){
    alert('Informe uma senha com no mínimo 6 caracteres');
    return false;
  }
  else{
    return true;
  }
}