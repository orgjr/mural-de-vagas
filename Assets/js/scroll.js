let lastScrollPosition = 0; // Última posição do scroll
const topBar = document.getElementById("top");

window.addEventListener("scroll", () => {
  const currentScrollPosition = window.scrollY;

  if (currentScrollPosition > lastScrollPosition) {
    // Rolando para baixo - esconde o #top
    topBar.style.transform = "translateY(-100%)";
  } else {
    // Rolando para cima - mostra o #top
    topBar.style.transform = "translateY(0)";
  }

  lastScrollPosition = currentScrollPosition; // Atualiza a última posição
});
