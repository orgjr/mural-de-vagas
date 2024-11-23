// usando Form
document
  .getElementById("pesquisaForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Impede o envio do formulário (comportamento padrão)
    pesquisar(); // Chama a função pesquisar
  });

function pesquisar() {
  const termoPesquisa = document.getElementById("termoPesquisa").value;
  exibirAnuncios(termoPesquisa);
}
