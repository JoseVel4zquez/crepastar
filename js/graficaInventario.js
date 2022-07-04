(async () => {
  // Llamar a nuestra API. Puedes usar cualquier librería para la llamada, yo uso fetch, que viene nativamente en JS
  const respuestaRaw = await fetch("assets/graficaInventarios.php");
  // Decodificar como JSON
  const respuesta = await respuestaRaw.json();
  // Ahora ya tenemos las etiquetas y datos dentro de "respuesta"
  // Obtener una referencia al elemento canvas del DOM
  const $grafica = document.querySelector("#graficaInventario");

  const etiquetas = respuesta.etiquetas; // <- Aquí estamos pasando el valor traído usando AJAX
  // Podemos tener varios conjuntos de datos. Comencemos con uno
  const datos = respuesta.datos;
  etiquetas.map(function (res) {});

  //   var data = datos.map(function (resul) {
  //     resul.forEach((element) => {
  //       var datosR = parseInt(element);
  //       console.log(datosR);
  //       return datosR;
  //     });
  //   });
  console.log(datos);
  const datosVentas2020 = {
    label: "Productos en existencia",
    // Pasar los datos igualmente desde PHP
    data: datos, // <- Aquí estamos pasando el valor traído usando AJAX
    backgroundColor: [
      "rgba(163,221,203,0.2)",
      "rgba(232,233,161,0.2)",
      "rgba(232,233,161,0.2)",
      "rgba(232,233,161,0.2)",
      "rgba(230,181,102,0.2)",
      "rgba(229,112,126,0.2)",
    ], // Color de fondo
    borderColor: [
      "rgba(163,221,203,1)",
      "rgba(232,233,161,1)",
      "rgba(230,181,102,1)",
      "rgba(229,112,126,1)",
    ], // Color del borde
    borderWidth: 1, // Ancho del borde
  };

  new Chart($grafica, {
    type: "bar", // Tipo de gráfica
    data: {
      labels: etiquetas,
      datasets: [
        datosVentas2020,
        // Aquí más datos...
      ],
    },
    options: {
      scales: {
        yAxes: [
          {
            ticks: {
              beginAtZero: true,
            },
          },
        ],
      },
    },
  });
})();
