let agregar = document.getElementById("agregar");
let contenido = document.getElementById("contenedor");

agregar.addEventListener("click", (e) => {
  e.preventDefault();
  let clonar = document.querySelector(".clonar");
  let clon = clonar.cloneNode(true);
  contenido.appendChild(clon).classList.remove("clonar");
});
