var botaoModal = document.getElementById("botao-modal");
var modal = document.getElementById("modal");
var fecharModal = document.getElementsByClassName("fechar")[0];

botaoModal.addEventListener("click", function() {
  modal.style.display = "block";
});

fecharModal.addEventListener("click", function() {
  modal.style.display = "none";
});

window.addEventListener("click", function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
});
