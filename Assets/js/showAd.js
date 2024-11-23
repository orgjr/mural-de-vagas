document.addEventListener("DOMContentLoaded", function () {
  exibirAnuncios();
});

function exibirAnuncios(termoPesquisa = "") {
  const url = termoPesquisa
    ? `/backend/Exibe.php?pesquisar=${encodeURIComponent(termoPesquisa)}`
    : "/backend/Exibe.php";

  fetch(url)
    .then((response) => response.text())
    .then((data) => {
      document.getElementById("boxFirst").innerHTML = data;
    })
    .catch((error) => {
      console.error("Erro ao obter anúncios:", error);
    });
}
