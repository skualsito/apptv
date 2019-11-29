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

    <title>Hello, world!</title>
  </head>
  <style>
  @import url('https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap');
  html, body {
    height: 100%;
    font-family: 'Roboto', sans-serif;
  }
  .app-tv {
      background-image: linear-gradient(to right, #667eea 0%, #764ba2 100%);
      color: #fff;
  }
  .app-tv .container {
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -ms-flex-align: center;
      -webkit-align-items: center;
      -webkit-box-align: center;
      height: 100%;
      text-align: center;
  }
  .app-contenedor {
/*       background: rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      padding: 10px; */
      text-shadow: rgba(0, 0, 0, 0.5) 0 0 6px;
  }
  .apptv-input {
      margin: 0 auto;
  }
  .app-contenedor h3 {
      width: 100%;
      margin: 0;
      font-weight: 400;
  }
  .app-contenedor p {
      width: 100%;
  }
  .app-contenedor a {
      color: #fff;
      text-decoration: underline;
  }
  .apptv-input input {
      float: left;
      width: 40px;
      height: 50px;
      margin-left: 5px;
      border: none;
      border-radius: 5px;
      font-size: 30px;
      padding: 11px;
  }
  .btn-conectar {
      border-radius: 10px;
      background-color: #000;
      box-shadow: 0px 4px 9px 0px rgba(0, 0, 0, 0.35);
      color: #ffff;
      font-size: 25px;
      font-weight: 100;
      padding: 5px 40px;
      margin: 20px auto;
      cursor: pointer;
  }
  .btn-conectar:hover, .btn-conectar:focus {
      background-color: #232323;
      color: #fff;
  }
  </style>
  <body class="app-tv">
    <div class="container">
      <div class="col-12">
        <div class="row app-contenedor">
          <h3>Bienvenido</h3>
          <p>Por favor, ingrese el numero de conexión.</p>
          <div class="apptv-input">
            <input type="number" name="txtcon1">
            <input type="number" name="txtcon2">
            <input type="number" name="txtcon3">
            <input type="number" name="txtcon4">
            <input type="number" name="txtcon5">
            <input type="number" name="txtcon6">
          </div>
          <button class="btn btn-conectar">CONECTAR</button>
          <p>Si todavia no descargó la extension <strong>APPTV</strong><br>puede descargarla desde: <br><a href="#">trpledoblebe.link.com</a></p>
        </div>
      </div>
    </div>
    <script>
        const socket = io('http://11.11.15.8:8080');

/*       var fondos = ['rose', 'violet', 'sand', 'blank', ''];    
      var rand = fondos[Math.floor(Math.random() * fondos.length)];
      $('.app-tv').addClass(rand); */
      $(document).on("input", ".apptv-input input", function (event) {
        if($(this).val().length > 0){
          var n = parseInt($(this).attr("name")[6]) + 1;
          if(n < 7){
            $("input[name='txtcon"+n+"']").focus();
          } else {
            this.value = this.value.slice(0, 1);
          }
        }
      });
      $(document).on("keyup", ".apptv-input input", function (event) {
        if(event.keyCode == 8){
            var n = parseInt($(this).attr("name")[6]) - 1;
            if(n > 0){
              $("input[name='txtcon"+n+"']").focus();
            }
        }
      });
      $(document).on("click", ".btn-conectar", function (event) {
          event.preventDefault();
          socket.emit("entrar-conexion", $("input[name='txtcon1']").val()+$("input[name='txtcon2']").val()+$("input[name='txtcon3']").val()+$("input[name='txtcon4']").val()+$("input[name='txtcon5']").val()+$("input[name='txtcon6']").val());
      });
      socket.on("emparejados", function(){
          console.log("entro");
          $("body").attr("class", "app-control").load("control.php");
      });
      socket.on("web-cliente", function(data){
          console.log(data);
      });
    </script>
  </body>
</html>