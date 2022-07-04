$(document).ready(function () {
  //   alert("JQuery esta funcionando");
  $.ajax({
    url: "assets/list.php",
    type: "GET",
    success: function (response) {
      let res = JSON.parse(response);
      let template = "";
      res.forEach((result) => {
        template += `
          <tr>
            <td></td>
            <td>${result.created_at}</td>
            <td>${result.comensales}</td>
            <td>${result.Id_Mesa}</td>
            <td>${result.id_usuario}</td>
            <td>pendiente</td> 
            <td><a class="btn btn-outline-primary" href="view_order.php?id=${result.id}"><i class="fas fa-eye"></i></a></td> 
          </tr>
          `;
      });
      $("#result").html(template);
    },
  });
});
