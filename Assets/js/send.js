function enviar() {
  var titulo = document.getElementById("titulo").value;
  var descricao = document.getElementById("descricao").value;
  var imagem = document.getElementById("imagem").files[0];

  // Criar um objeto FormData
  var formData = new FormData();
  formData.append("titulo", titulo);
  formData.append("descricao", descricao);
  formData.append("imagem", imagem);

  // Enviar os dados para o backend usando fetch
  fetch("/backend/Cadastra.php", {
    method: "POST",
    body: formData, // Envia o FormData diretamente
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      alert(data.message); // Exibir mensagem do servidor
      // Redirecionar para a página inicial após enviar
      window.location.href = "/index.html";
    })
    .catch((error) => {
      console.error("Erro ao enviar dados:", error);
    });
}
