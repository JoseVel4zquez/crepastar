<?php
include 'componentes/header.php';
include 'php/conexion.php';
$servicios = "SELECT * FROM comentarios o INNER JOIN usuarios p on o.id_usuario = p.id_usuario";
$consulta = $conexion->query($servicios);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="css/style.css" />
    <title>Ordenes</title>
</head>

<body>
    <section>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php while($row = mysqli_fetch_assoc($consulta)){ ?>
                    <div class="swiper-slide">
                        <div class="testimonialBox">
                            <div class="content">
                                <p><span>Comentario:</span> <?= $row['descripcion']; ?></p>
                                <br>
                                <div class="details">
                                    <h3><span>Usuario:</span> <?= $row['usuarioNombre'] ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
      var swiper = new Swiper(".swiper-container", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        coverflowEffect: {
          rotate: 50,
          stretch: 0,
          depth: 100,
          modifier: 1,
          slideShadows: true,
        },
        pagination: {
          el: ".swiper-pagination",
        },
      });
    </script>
</body>

</html>

<?php
include 'componentes/footer.php';
?>