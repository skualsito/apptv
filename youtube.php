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
  .btn.focus, .btn:focus {
    outline: 0;
    box-shadow: none;
  }
  .app-tv-menu-general {
      position: fixed;
      width: 100%;
      height: 100%;
      top: 100%;
      z-index: 9999;
      background-color: #000;
      -webkit-transition: all .3s ease-in-out;
      -moz-transition: all .3s ease-in-out;
      -o-transition: all .3s ease-in-out;
      transition: all .3s ease-in-out;
  }
  .app-tv-menu-general.activo {
      top: 0%;
  }

  .app-tv-menu-botonera {
      width: 100%;
      height: 100%;
      padding: 20px;
  }

  .app-tv-menu-botonera .btn {
      width: calc(50% - 20px);
      height: 80px;
      color: #fff;
      background-color: #292929;
      margin: 9px;
  }

  .app-tv-menu-botonera .btn i {
      width: 100%;
      font-size: 30px;
      margin-top: 10px;
  }

  .app-tv-menu-botonera .btn span {
      width: 100%;
      font-size: 10px;
      color: #8c8c8c;
      text-transform: uppercase;
      font-weight: 600;
  }
  .app-tv-menu-general.activo .app-tv-menu-footer {
      bottom: 93%;
      transform: rotate(180deg);
  }
  .app-tv-menu-footer {
      position: fixed;
      bottom: 0%;
      left: calc(50% - 40px);
      width: 80px;
      height: 40px;
      background-color: #000;
      color: #fff;
      font-size: 18px;
      text-align: center;
      line-height: 50px;
      -moz-border-radius: 100px 100px 0 0;
      -webkit-border-radius: 100px 100px 0 0;
      border-radius: 100px 100px 0 0;
      padding: 0;
      -webkit-transition: all .3s ease-in-out;
      -moz-transition: all .3s ease-in-out;
      -o-transition: all .3s ease-in-out;
      transition: all .3s ease-in-out;
  }
  .app-tv-menu-footer:hover {
      color: #fff;
  }
  #cargador {
      position: fixed;
      z-index: -1;
      background: #282828;
      width: 100%;
      height: 100%;
      text-align: center;
      opacity: 0;
      -webkit-transition: all .5s ease-in-out;
      -moz-transition: all .5s ease-in-out;
      -o-transition: all .5s ease-in-out;
      transition: all .5s ease-in-out;
  }
  #cargador.activo {
    z-index: 9999;
    opacity: 1;
  }
  #cargador .lds-ellipsis {
      position: absolute;
      left: calc(50% - 32px);
      top: calc(50% - 32px);
  }
  .lds-ellipsis {
    display: inline-block;
    position: relative;
    width: 64px;
    height: 64px;
  }
  .lds-ellipsis div {
    position: absolute;
    top: 27px;
    width: 11px;
    height: 11px;
    border-radius: 50%;
    background: #fff;
    animation-timing-function: cubic-bezier(0, 1, 1, 0);
  }
  .lds-ellipsis div:nth-child(1) {
    left: 6px;
    animation: lds-ellipsis1 0.6s infinite;
  }
  .lds-ellipsis div:nth-child(2) {
    left: 6px;
    animation: lds-ellipsis2 0.6s infinite;
  }
  .lds-ellipsis div:nth-child(3) {
    left: 26px;
    animation: lds-ellipsis2 0.6s infinite;
  }
  .lds-ellipsis div:nth-child(4) {
    left: 45px;
    animation: lds-ellipsis3 0.6s infinite;
  }
  @keyframes lds-ellipsis1 {
    0% {
      transform: scale(0);
    }
    100% {
      transform: scale(1);
    }
  }
  @keyframes lds-ellipsis3 {
    0% {
      transform: scale(1);
    }
    100% {
      transform: scale(0);
    }
  }
  @keyframes lds-ellipsis2 {
    0% {
      transform: translate(0, 0);
    }
    100% {
      transform: translate(19px, 0);
    }
  }

  </style>
  <style>
  @import url('https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap');
  html, body {
    height: 100%;
    font-family: 'Roboto', sans-serif;
  }
  .app-yt{
      background-color: #282828;
  }
  .app-yt-menu {
      width: 100%;
      margin-top: 30px;
  }

  .app-yt-logo img {
      width: 100%;
  }

  .app-yt-logo {
      width: 175px;
      float: left;
  }

  .app-yt-user {
      float: right;
      width: 50px;
      height: 50px;
      overflow: hidden;
      border-radius: 50%;
      margin-top: -5px;
  }

  .app-yt-user img {
      width: 100%;
  }

  .app-yt-item {
      width: 100%;
      margin-bottom: 15px;
  }

  .app-yt-item img {
      width: 100%;
  }

  .app-yt-datos h4 {
      color: #fff;
      font-size: 16px;
      font-weight: 400;
      margin-top: 10px;
      margin-bottom: 5px;
  }

  .app-yt-datos h5 {
      color: #939393;
      position: relative;
      width: fit-content;
      font-size: 16px;
      margin-bottom: 5px;
      z-index: 9;
  }

  .app-yt-datos h5 span {
      color: #fff;
      background-color: #939393;
      font-size: 8px;
      border-radius: 50%;
      width: 16px;
      height: 16px;
      float: right;
      text-align: center;
      line-height: 16px;
      margin-left: 5px;
  }

  .app-yt-datos p {
      color: #545454;
      margin: 0;
      font-size: 12px;
  }
  .app-yt-videos h2 {
      color: #fff;
      font-size: 18px;
      margin-bottom: 10px;
  }

  .app-yt-videos {
     max-height: 70vh;
     overflow: auto;
     display: none;
  }
  .app-yt-buscador {
      width: 100%;
      margin: 25px 0px;
  }

  .app-yt-buscador input {
      width: 80%;
      border: none;
      background-color: #121212;
      border-top-left-radius: 5px;
      border-bottom-left-radius: 5px;
      float: left;
      padding: 5px;
      color: hsla(0, 100%, 100%, .88);
  }

  .app-yt-buscador button {
      background-color: #3d3d3d;
      color: #787878;
      height: 34px;
      border-radius: 0;
      border-top-right-radius: 5px;
      border-bottom-right-radius: 5px;
      width: 20%;
  }
  
  .app-yt-control {
      width: 250px;
      height: 250px;
      border: 50px solid #3c3c3c;
      border-radius: 50%;
      margin: 45px auto;
      position: relative;
      display: none;
  }
  .app-yt-control .btn {
      color: #858585;
      font-size: 25px;
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
  .btn-play {
      top: calc(50% - 32.5px);
      right: calc(50% - 32.5px);
      font-size: 21px!important;
  }
  .activo {
    display: block;
  }
  @media only screen and (max-width: 350px) {
  }
  </style>
  <body class="app-yt">
  <div id="cargador"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>
    <div class="container">
      <div class="col-12">
        <div class="row app-yt-contenedor">
          <div class="app-yt-menu">
            <div class="app-yt-logo"><img src="assets/img/youtube.png" alt="YouTube"></div>
            <div class="app-yt-user"><img src="assets/img/user.png" alt="User"></div>
          </div>
          <div class="app-yt-buscador">
            <input type="text" id="ytbuscador">
            <button class="btn btn-yt"><i class="fas fa-search"></i></button>
          </div>
          <div class="app-yt-videos activo">            

          </div>
          <div class="app-yt-control">
            <button class="btn btn-up"><i class="fas fa-undo-alt"></i></button>
            <button class="btn btn-down"><i class="far fa-square"></i></button>
            <button class="btn btn-left"><i class="fas fa-expand"></i></button>
            <button class="btn btn-right"><i class="fas fa-step-forward"></i></button>
            <button class="btn btn-play"><i class="fas fa-play"></i>  /  <i class="fas fa-pause"></i></button>
          </div>
        </div>
      </div>
    </div>
    <div class="app-tv-menu-general">
      <button class="btn app-tv-menu-footer">
        <i class="fas fa-bars"></i>
      </button>
      <div class="app-tv-menu-botonera">
        <button class="btn btn-home"><i class="fas fa-home"></i> <span>Home</span></button>
      </div>
    </div>
    
    
    <script>
      
      
      $(".btn-home").on("click", function () {
        socket.emit('com-bg-app', 'index');
      });

      const socket = io('http://11.11.15.8:8080');
      socket.emit('com-bg-app', 'obtener-recomendados-yt');
      appCargador();
      $("#ytbuscador").on("input", function () {
        socket.emit('servidor-funcion',`document.getElementById("search-input").childNodes[0].value = "${$(this).val()}";`);
      });

      $(".btn-yt").on("click", function () {
        socket.emit('servidor-funcion',`document.getElementById("search-icon-legacy").click();`);
        $("#ytbuscador").val("");
        $(".app-yt-videos").scrollTop(0);
        appCargador();
      });

      $(".app-yt-logo").on("click", function (e) {
        e.preventDefault();
        appCargador();
        setTimeout(() => {
          $('.app-yt-control').removeClass("activo");
          $('.app-yt-videos').removeClass("activo").addClass("activo");
        }, 500); 
        socket.emit('servidor-funcion',`location.href = "/";`); 
        $(".app-yt-videos").scrollTop(0);
        socket.emit('com-bg-app', 'obtener-recomendados-yt');  
        
      });

      $(".app-yt-videos").on("scroll", function (e) {
        socket.emit('servidor-funcion',`window.scrollTo({ top: ${$(this).scrollTop()}, behavior: 'smooth' });`);
        if(($(this).scrollTop() % 50) == 0){
          if($(".app-yt-videos").find("h2").length){
            socket.emit('com-bg-app', 'obtener-recomendados-yt');
          } else {
            socket.emit('com-bg-app', 'obtener-resultados-yt');
          }
        }
      });

      $(document).on("click", ".app-yt-item", function (e) {
        socket.emit('servidor-funcion',`location.href = "${$(this).attr("href")}";`);
        appCargador();
      });


      $(".btn-up").on("click", function (e) {
        e.preventDefault();
        socket.emit('servidor-funcion',`window.history.back()`);
        appCargador();
        setTimeout(() => {
          $('.app-yt-control').removeClass("activo");
          $('.app-yt-videos').removeClass("activo").addClass("activo");
        }, 500);        
      });

      $(".btn-down").on("click", function (e) {
        e.preventDefault();
        socket.emit('servidor-funcion',`$("ytd-player").find("#movie_player").removeClass("ytp-autohide"); $(".ytp-size-button").trigger("click"); $("ytd-player").find("#movie_player").addClass("ytp-autohide");`);
      });

      $(".btn-left").on("click", function (e) {
        e.preventDefault();
        socket.emit('servidor-funcion',`$("ytd-player").find("#movie_player").removeClass("ytp-autohide"); 
          $(".ytp-fullscreen-button").trigger("click"); $("ytd-player").find("#movie_player").addClass("ytp-autohide");`);
      });

      $(".btn-play").on("click", function (e) {
        e.preventDefault();
        socket.emit('servidor-funcion',`$("ytd-player").find("#movie_player").removeClass("ytp-autohide"); $(".ytp-play-button").trigger("click"); $("ytd-player").find("#movie_player").addClass("ytp-autohide");`);
      });

      $(".btn-right").on("click", function (e) {
        e.preventDefault();
        socket.emit('servidor-funcion',`location.href = $('.ytp-next-button').attr('href');`);
      });

      $(".app-tv-menu-footer").on("click", function (e) {
        e.preventDefault();
        $(".app-tv-menu-general").toggleClass("activo");
      });

      socket.on('yt-on-client', function(data){   
        llenarGrilla(data[0].recomendados, true);
        $(".app-yt-user img").attr('src', data[0].usuario);
        appCargador(false);     
      });

      socket.on('activar-control', function(data){        
        $('.app-yt-control').removeClass("activo").addClass("activo");
        $('.app-yt-videos').removeClass("activo");
        appCargador(false);   
      });
      
      socket.on('resultados', function(data){
          llenarGrilla(data[0].recomendados);
          appCargador(false);
      });
      function llenarGrilla(data = [], r = false){
        if(r){
          r = "<h2>Recomendados</h2>";
        }
        $(".app-yt-videos").html(r);
        data.map((data)=>{
              $(".app-yt-videos").append(`
              <div class="app-yt-item" href="${data.href}">
                ${(data.img) ? '<img src="'+data.img+'" alt="'+data.titulo+'">' : '<img src="assets/img/yt_icon_mono_dark.png" alt="'+data.titulo+'">'}
                <div class="app-yt-datos">
                  <h4>${data.titulo}</h4>
                  <h5 href="${data.canalink}">${data.canal} ${(data.verif) ? '<span class="app-yt-check"><i class="fas fa-check"></i></span>' : ''}</h5>
                  <p>${data.tiempo}</p>
                </div>
              </div>
              `);
          });
      }

      function appCargador(t = true) {

        if(!t){
          $("#cargador").removeClass("activo");
        } else {
          $("#cargador").addClass("activo");
        }
      }
    </script>
  </body>
</html>