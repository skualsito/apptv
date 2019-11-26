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
  .app-netflix {
      background-color: #000000;
  }
  .netflix-login-logo {
      width: 135px;
      margin: 0 auto;
  }

  .netflix-login-logo img {
      width: 100%;
  }

  .app-netflix-login {
      width: 100%;
      display: none;
  }

  .app-netflix-contenedor h3 {
      text-align: center;
      font-size: 14px;
      color: #fff;
      font-weight: 400;
  }

  .netflix-item-usuario {
      width: 110px;
      margin: 10px 5px;
      display: inline-block;
  }

  .netflix-imagen-usuario img {
      width: 100%;
  }

  .netflix-list-usuarios {
      display: block;
      width: 244px;
      margin: 0 auto;
  }

  .netflix-titulo-usuario {
      text-align: center;
      margin-top: 10px;
      color: #fff;
      font-size: 11px;
  }
  
  .app-netflix-big {
      margin: 0 -15px;
      width: calc(100% + 30px);
      height: 70vh;
      overflow: hidden;
      position: relative;
  }

  .app-netflix-big-bg img {
      height: 100%;
      margin-left: -50%;
  }

  .app-netflix-big-bg {
      overflow: hidden;
      height: 100%;
  }

  .app-netflix-home {
      width: 100%;
      display: none;
  }

  .app-netflix-big-logo {
      position: absolute;
      width: 200px;
      bottom: 35%;
      left: calc(50% - 100px);
  }

  .app-netflix-big-logo img {
      width: 100%;
  }

  .app-netflix-big p {
      color: #fff;
      position: absolute;
      bottom: 20%;
      font-size: 12px;
      margin: 0;
      text-align: center;
      padding: 0 20px;
  }

  .btn-netlfix-reproducir {
      position: absolute;
      bottom: 5%;
      left: calc(50% - 42px);
      background-color: #fff;
      border-radius: 5px;
      font-weight: 500;
      font-size: 14px;
  }

  .app-netflix-big-bg:before {content: " ";background: rgb(0,0,0);background: linear-gradient(0deg, rgba(0,0,0,1) 0%, rgba(0,0,0,0.4) 100%);width: 100%;height: 100%;top: 0;left: 0;position: absolute;}

  .app-netflix-itemslide p {
      font-size: 12px;
      font-weight: 600;
      color: #fff;
      margin-bottom: 5px;
  }

  .app-netflix-itemslide-contenedor {
      height: 140px;
      width: max-content;
      overflow: hidden;
  }

  .app-netflix-item {
      display: inline-block;
      width: 100px;
      height: 140px;
      margin-right: 5px;
  }

  .app-netflix-item img {
      height: 100%;
  }

  .app-netflix-itemslide {
      overflow: hidden;
  }
  .app-netflix-itemslide-scroll {
      overflow-y: auto;
      margin-bottom: 20px;
  }
  .activo {
    display: block!important;
  }
  .app-netflix-itemslide-scroll[contexto="netflixOriginals"] .app-netflix-itemslide-contenedor, .app-netflix-itemslide-scroll[contexto="netflixOriginals"] .app-netflix-item {
      height: 200px;
  }

  .app-netflix-itemslide-scroll[contexto="netflixOriginals"] {
      height: 200px;
  }
  .app-netflix-control {
      width: 250px;
      height: 250px;
      border: 50px solid #3c3c3c;
      border-radius: 50%;
      margin: 45px auto;
      position: relative;
  }
  .app-netflix-control .btn {
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
  .app-netflix-control-contenedor {
      width: 100%;
      height: 100%;
      display: none;
  }
  .app-netflix-subtitulos {
      position: fixed;
      top: 0;
      left: 100%;
      width: 100%;
      height: 100%;
      background-color: #3c3c3c;
      color: #fff;
      padding: 20px;
  }

  .app-netflix-subtitulos h5 {
      font-size: 24px;
      font-weight: 500;
      margin-top: 10px;
  }

  .app-netflix-subtitulos button {
      background: transparent;
      border: none;
      padding: 0;
      width: 100%;
      text-align: left;
      color: #bbb;
      font-weight: 400;
  }

  .app-netflix-subtitulos h5:first-child {
      margin-top: 0;
  }
  .app-netflix-buscador-contenedor {
      float: right;
      color: #fff;
      font-size: 24px;
      margin-right: 20px;
  }

  .app-netflix-navbar {
      position: absolute;
      top: 10px;
      left: 0;
      z-index: 10;
      width: 100%;
  }

  .app-netflix-perfil {
      float: right;
  }

  .app-netflix-buscador {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: #000;
      display: none;
  }

  </style>
  <body class="app-netflix">
  <div id="cargador"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>
    <div class="container">
      <div class="col-12">
        <div class="row app-netflix-contenedor">

          <div class="app-netflix-login">
            <div class="netflix-login-logo">
              <img src="assets/img/netflix.png" alt="Netflix">
            </div>
            <h3></h3>
            <div class="netflix-list-usuarios">
            </div>
          </div>

          <div class="app-netflix-home">
          
            <div class="app-netflix-navbar">
              <div class="app-netflix-perfil"></div>
              <div class="app-netflix-buscador-contenedor">
                <div class="app-netflix-btn-buscador"><i class="fas fa-search"></i></div>
                <div class="app-netflix-buscador">
                  <h3>Buscar</h3>
                  <input type="text" id="search-netflix">
                  <div class="app-netflix-buscador-resultados"></div>
                </div>
              </div>
            </div>
            <div class="app-netflix-big">
              <div class="app-netflix-big-bg">
                <img src="assets/img/netflix.png" alt="bigPicture">
              </div>
              <div class="app-netflix-big-logo">
                <img src="assets/img/netflix.png" alt="bigLogo">
              </div>
              <p></p>
              <div class="btn btn-netlfix-reproducir"><i class="fas fa-play"></i> Reproducir</div>
            </div>

            <div class="app-netflix-contenedor-general">

              

            </div>

            
            
          </div>
          <div class="app-netflix-control-contenedor">
            <div class="app-netflix-control">
              <button class="btn btn-up"><i class="fas fa-comment-dots"></i></button>
              <button class="btn btn-down"><i class="fas fa-expand"></i></button>
              <button class="btn btn-left"><i class="fas fa-backward"></i></button>
              <button class="btn btn-right"><i class="fas fa-forward"></i></button>
              <button class="btn btn-play"><i class="fas fa-play"></i>  /  <i class="fas fa-pause"></i></button>
            </div>
            <div class="app-netflix-subtitulos">
              <h5>Audio</h5>
              <button>Español</button>
              <h5>Subtitulos</h5>
              <button>Español</button>
            </div>
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
      

      const socket = io('http://11.11.15.8:8080');
      socket.emit('com-bg-app', 'obtener-netflix-home');
      appCargador();
      socket.on('netflix-home-client', function(data){   
        $('.app-netflix-login, .app-netflix-home, .app-netflix-control-contenedor').removeClass("activo");
        if(data[0].tipo == 1){
          llenarLogin(data[0]);
          $('.app-netflix-login').addClass("activo");
        } else {
          llenarHome(data[0]);
          $('.app-netflix-home').addClass("activo");

        }
        appCargador(false);     
      });
      
      $(document).on("click", ".netflix-item-usuario", function (e) {
        e.preventDefault();
        socket.emit('servidor-funcion',`location.href = "${$(this).attr("href")}";`); 
      });

      $(document).on("click", ".app-netflix-item, .btn-netlfix-reproducir", function (e) {
        e.preventDefault();
        appCargador();
        socket.emit('servidor-funcion',`location.href = "${"https://www.netflix.com"+$(this).attr("href")}";`);
      });

      $(document).on("click", ".app-netflix-perfil", function (e) {
        e.preventDefault();
        appCargador();
        socket.emit('servidor-funcion',`location.href = "https://www.netflix.com/profiles";`);
      });

      $(document).on("click", ".app-netflix-btn-buscador", function (e) {
        e.preventDefault();
        socket.emit('servidor-funcion',`$(".searchTab").trigger("click"); $(".searchInput input").focus()`);
      });
      
      

      $(window).on('scroll', function (e){
        if($(".app-netflix-control-contenedor").hasClass("activo"))
          return false;
        socket.emit('servidor-funcion',`window.scrollTo({ top: ${$(this).scrollTop()+($(this).scrollTop())}, behavior: 'smooth' });`);
        if(($(this).scrollTop() % 50) == 0){
          socket.emit('com-bg-app', 'obtener-netflix-home');
        }
      });

      socket.on('activar-control', function(data){      
        $('.app-netflix-login, .app-netflix-home').removeClass("activo");
        $('.app-netflix-control-contenedor').addClass("activo");
        appCargador(false);   
      });
      
      
   

      function llenarLogin(data = []){
        $(".app-netflix-contenedor h3").html(data.pregunta);
        $(".netflix-list-usuarios").html("");
        data.recomendados.map((data)=>{
              $(".netflix-list-usuarios").append(`
              <div class="netflix-item-usuario" href="${(data.href) ? data.href : ''}">
                <div class="netflix-imagen-usuario">
                  <img src="${data.img}" alt="${data.nombre}">
                </div>
                <div class="netflix-titulo-usuario">
                  ${data.nombre}
                </div>
              </div>
              `);
          });
      }

      function llenarHome(data = []){
        $(".app-netflix-big-bg img").attr("src", data.grande.imgFondo);
        $(".app-netflix-big-logo img").attr("src", data.grande.logoTitulo);
        $(".app-netflix-big p").html(data.grande.sinop);
        $(".btn-netlfix-reproducir").attr("href", data.grande.href);
        $(".app-netflix-contenedor-general").html("");
        $(".app-netflix-perfil").html(`<img src="${data.avatar}" alt="Perfil">`) 
        data.todo.map((datita)=>{
          $(".app-netflix-contenedor-general").append(`
            <div class="app-netflix-itemslide">
              <p>${datita.titulo}</p>
              <div class="app-netflix-itemslide-scroll" contexto="${datita.contexto}">
                <div class="app-netflix-itemslide-contenedor">
                  
                </div>
              </div>
            </div>
          `);
          datita.pelis.map((data)=>{
              $(".app-netflix-itemslide-scroll[contexto='"+datita.contexto+"'] .app-netflix-itemslide-contenedor").append(`
              <div class="app-netflix-item" href="${(data.link) ? data.link : ''}">
                <img src="${(data.img) ? data.img : ''}" alt="${data.titulo}">
              </div>
              `);
          });
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