// Menú para celulares
const menuToggle = document.querySelector(".menu-toggle");
const navLinks = document.querySelector(".nav-links");

if (menuToggle) {
  menuToggle.addEventListener("click", () => {
    navLinks.classList.toggle("open");
  });
}

// Buscador de demostración
const searchForm = document.querySelector(".search-box");
searchForm.addEventListener("submit", (event) => {
  event.preventDefault();
  const input = searchForm.querySelector("input");
  const term = input.value.trim();

  if (!term) {
    alert("Escribe una palabra para buscar.");
    return;
  }

  alert(`Buscando noticias sobre: ${term}\n\nEn la siguiente etapa podemos conectar este buscador con tus noticias reales.`);
});

// Indicadores de la portada
const dots = document.querySelectorAll(".slider-dots button");

dots.forEach((dot, index) => {
  dot.addEventListener("click", () => {
    dots.forEach(d => d.classList.remove("selected"));
    dot.classList.add("selected");

    // Aquí después podemos conectar cada punto con una portada semanal diferente.
    console.log("Portada seleccionada:", index + 1);
  });
});
