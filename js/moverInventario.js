function moverInvenario(e) {
  if (confirm("¿Esta seguro que desea mover el inventario a otra sucursal?")) {
    return true;
  } else {
    e.preventDefault();
  }
}

let mover = document.querySelectorAll(".mover");

for (var i = 0; i < linkDelete.length; i++) {
  mover[i].addEventListener("click", moverInvenario);
}
