google.charts.load("current", { packages: ["corechart"] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ["Id", "Total de ventas"],
    ["Work", 11],
    ["Eat", 2],
    ["Commute", 2],
    ["Watch TV", 2],
    ["Sleep", 7],
  ]);

  var options = {
    title: "Reporte de ventas",
  };

  var chart = new google.visualization.PieChart(
    document.getElementById("grafico")
  );

  chart.draw(data, options);
  document.getElementById("variable").value = chart.getImageURI();
}
