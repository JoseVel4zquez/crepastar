$(document).ready(function () {
  //   alert("JQuery esta funcionando");
  $.ajax({
    url: "assets/productosAgotados.php",
    type: "GET",
    success: function (response) {
      let res = JSON.parse(response);
      let template = "";
      res.forEach((result) => {
        template += `
            <tr>
            
            <td>${result.id_producto}</td>
              <td>${result.nombre}</td>
              <td>${result.cantidad}</td>
              <td>$ ${result.precio} mxn</td>
               
              
            </tr>
            `;
      });
      $("#agotado").html(template);
    },
  });
});
