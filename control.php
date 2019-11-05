<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/socket.io.js"></script>
    <script src="https://kit.fontawesome.com/da9aba50d5.js" crossorigin="anonymous"></script>
    <title>Hello, world!</title>
  </head>
  <style>
  @import url('https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap');
  html, body {
    height: 100%;
    font-family: 'Roboto', sans-serif;
  }
  .app-control {
      color: #fff;
      background: #171717;
  }
  .btn-menu {
      color: #fff;
  }
  .app-control-contenedor {
      position: relative;
  }
  .app-control-botonera .btn {
      font-size: 21px;
      float: left;
      width: 60px;
      height: 60px;
      color: #fff;
      border: #000 3px solid;
      border-radius: 50%;
      margin: 0 15px;
  }
  .app-control-botonera {
      margin: 0 auto;
      margin-top: 125px;
      width: 270px;
  }
  .btn-power {
      color: #ce5353!important;
      margin: 20px calc(50% - 30px)!important;
  }
  .app-control-botonmedio {
      width: 250px;
      height: 250px;
      border: 50px solid #3c3c3c;
      border-radius: 50%;
      margin: 45px auto;
      position: relative;
  }
  .app-control-botonmedio .btn {
      color: #858585;
      font-size: 30px;
      position: absolute;
      width: 65px;
      height: 65px;
      padding: 0;
  }
  .btn-up {
      top: calc(-25px - 32.5px);
      right: calc(50% - 32.5px);
  }
  .btn-down {
      bottom: calc(-25px - 32.5px);
      right: calc(50% - 32.5px);
  }
  .btn-left {
      left: calc(-25px - 32.5px);
      top: calc(50% - 32.5px);
  }
  .btn-right {
      right: calc(-25px - 32.5px);
      top: calc(50% - 32.5px);
  }
  .btn-ok {
      top: calc(50% - 32.5px);
      right: calc(50% - 32.5px);
  }
  .app-control-footer {
      border-radius: 10px;
      background-color: rgb(60, 60, 60);
      position: absolute;
      left: calc(50% - 125px);
      bottom: 15px;
      width: 250px;
      height: 10px;
  }
  .app-pantallacompleta {
      position: absolute;
      width: 100%;
      padding: 15px;
      z-index: 9999999;
      background-color: #060606;
      top: -100%;
      -webkit-transition: all .5s ease-in-out;
      -moz-transition: all .5s ease-in-out;
      -o-transition: all .5s ease-in-out;
      transition: all .5s ease-in-out;
  }
  .app-pantallacompleta.activo {
    top: 0%;
  }

  .app-pantallacompleta .btn-cerrar {
      position: absolute;
      right: 5px;
      top: 5px;
      color: #fff;
      font-size: 20px!important;
  }

  .app-pantallacompleta p {
    width: 90%;
  }

  .app-pantallacompleta .btn {
      padding: 2px 10px;
      font-size: 15px;
  }
  @media only screen and (max-width: 350px) {
    .app-control-botonera {
      margin-top: 40px;
    }
  }
  </style>
  <body class="app-control">
    <div class="app-pantallacompleta">
      <button class="btn btn-cerrar">X</button>
      <p>¿Desea activar la pantalla completa para una mejor experiencia?</p>
      <button class="btn btn-success">Aceptar</button>
      <button class="btn btn-primary">Cancelar</button>
    </div>
    <div class="container">
      <div class="col-12">
        <div class="row app-control-contenedor">
          <div class="app-control-botonera">
            <button class="btn btn-power"><i class="fas fa-power-off"></i></button>
            <button class="btn btn-menu"><i class="fas fa-bars"></i></button>
            <button class="btn btn-home"><i class="fas fa-home"></i></button>
            <button class="btn btn-search"><i class="fas fa-search"></i></button>
          </div>
          <div class="app-control-botonmedio">
            <button class="btn btn-up"><i class="fas fa-angle-up"></i></button>
            <button class="btn btn-down"><i class="fas fa-angle-down"></i></button>
            <button class="btn btn-left"><i class="fas fa-angle-left"></i></button>
            <button class="btn btn-right"><i class="fas fa-angle-right"></i></button>
            <button class="btn btn-ok">OK</button>
          </div>
        </div>
      </div>
      <div class="app-control-footer"></div>
    </div>
    <script>
      function toggleFullscreen(elem) {
        elem = elem || document.documentElement;
        if (!document.fullscreenElement && !document.mozFullScreenElement &&
          !document.webkitFullscreenElement && !document.msFullscreenElement) {
          if (elem.requestFullscreen) {
            elem.requestFullscreen();
          } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
          } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
          } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
          }
        } else {
          if (document.exitFullscreen) {
            document.exitFullscreen();
          } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
          } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
          } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
          }
        }
      }
      $(function () {
        if(!document.fullscreenElement && !document.mozFullScreenElement &&
          !document.webkitFullscreenElement && !document.msFullscreenElement){
            $(".app-pantallacompleta").addClass("activo");
        }
        
      });
      $(".app-pantallacompleta .btn-success").on("click", function () {
        toggleFullscreen();
        $(".app-pantallacompleta").removeClass("activo");
      });
      $(".app-pantallacompleta .btn-primary, .app-pantallacompleta .btn-cerrar").on("click", function () {
        $(".app-pantallacompleta").removeClass("activo");
      });
    </script>
  </body>
</html>