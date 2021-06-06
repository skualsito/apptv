//socket.emit('com-bg-app', 'obtener-netflix-home');

socket.on('netflix-home-client', function(data){   
  console.log(data);
  $('.app-netflix-login, .app-netflix-home, .app-netflix-control-contenedor, .app-netflix-buscador, .app-netflix-navbar').removeClass("activo");
  if(data.tipo == 1){
    llenarLogin(data);
    $('.app-netflix-login').addClass("activo");
  } else {
    llenarHome(data);
    $('.app-netflix-home, .app-netflix-navbar').addClass("activo");

  }
  appCargador(false);     
});

socket.on('resultados', function(data){   
  if($("body").hasClass("app-netflix")) {
    $('.app-netflix-login, .app-netflix-home, .app-netflix-control-contenedor, .app-netflix-buscador, .app-netflix-navbar').removeClass("activo");
    $('.app-netflix-home, .app-netflix-buscador, .app-netflix-navbar').addClass("activo");
    llenarBusqueda(data);
  }
});

$(document).on("click", ".netflix-item-usuario", function (e) {
  e.preventDefault();
  socket.emit('servidor-funcion',`location.href = "${$(this).attr("href")}";`); 
  appCargador();
});

$(document).on("click", ".app-netflix-item, .btn-netlfix-reproducir, .netflix-item-busqueda", function (e) {
  e.preventDefault();
  appCargador();
  limpiarBusqueda(); 
  socket.emit('servidor-funcion',`location.href = "${"https://www.netflix.com"+$(this).attr("href")}";`);
});

$(document).on("click", ".app-netflix-perfil", function (e) {
  e.preventDefault();
  appCargador();
  socket.emit('servidor-funcion',`location.href = "https://www.netflix.com/profiles";`);
});

$(document).on("click", ".app-netflix-btn-buscador", function (e) {
  e.preventDefault();
  $('.app-netflix-buscador').addClass("activo");
  socket.emit('servidor-funcion',`$(".searchTab").trigger("click"); $(".searchInput input").focus()`);
});

$(document).on("keyup", "#search-netflix", function () {
  socket.emit('servidor-funcion',`location.href ="https://www.netflix.com/search?q=${$(this).val()}"`);
});

$(document).on("click", ".cerrar-buscador", function () {
  $('.app-netflix-buscador').removeClass("activo");
  socket.emit('servidor-funcion',`location.href ="https://www.netflix.com/browse"`);
  
});

$(document).on("click", ".cerrar-subtitulos", function () {
  $('.app-netflix-subtitulos').removeClass("activo");        
  socket.emit('servidor-funcion',`$(".button-nfplayerPlay, .PlayView .nf-big-play-pause").click();`);
});

$(document).on("click", ".btn-netflix-omitir", function (e) {
  
  socket.emit('servidor-funcion',`$(".skip-credits a")[0].click();`);
});

$(document).on("click", ".app-netflix-control .btn-play", function (e) {
  socket.emit('servidor-funcion',`
  if($(".PlayView .nf-big-play-pause").length > 0){
    $(".PlayView .nf-big-play-pause").click();
  } else {
    if($(".nf-big-play-pause button").length > 0){
      document.getElementsByClassName("nf-big-play-pause")[0].click();
    } else {
      if($(".button-nfplayerPause").length > 0){
        $(".button-nfplayerPause").click();
      } else {
        $(".button-nfplayerPlay").click();
      }
    };
  }
  `);
});

$(document).on("click", ".app-netflix-control .btn-right", function (e) {
  socket.emit('servidor-funcion',`$(".button-nfplayerFastForward").trigger("click");`);
});

$(document).on("click", ".app-netflix-control .btn-left", function (e) {
  socket.emit('servidor-funcion',`$(".button-nfplayerBackTen").trigger("click");`);
});

$(document).on("click", ".app-netflix-control .btn-up", function (e) {
  appCargador(true); 
  $('.app-netflix-subtitulos').addClass("activo");
  socket.emit('com-bg-app',"obtener-netflix-audsub");
});

$(document).on("click", ".app-netflix-control .btn-down", function (e) {
  socket.emit('servidor-funcion',`window.history.back();`);
});


$(document).on("click", ".app-contenedor-audsub button", function () {
  $(this).siblings().removeClass("selected");
  $(this).addClass("selected");
  socket.emit('servidor-funcion',`$("li.track[data-uia='${$(this).attr("uia")}']").click();`);
});


function limpiarBusqueda(){
  $(".app-netflix-buscador-resultados").html("");
  $("#search-netflix").val("");
}

/* 
$(window).on('scroll', function (e){
  if($(".app-netflix-control-contenedor").hasClass("activo") && $("body").hasClass("app-netflix"))
    return false;
  socket.emit('servidor-funcion',`window.scrollTo({ top: ${$(this).scrollTop()+($(this).scrollTop())}, behavior: 'smooth' });`);
  if(($(this).scrollTop() % 50) == 0){
    socket.emit('com-bg-app', 'obtener-netflix-home');
  }
}); */

socket.on('activar-control', function(data){
  if($("body").hasClass("app-netflix")) {
    $('.app-netflix-login, .app-netflix-home').removeClass("activo");
    $('.app-netflix-control-contenedor').addClass("activo");
    appCargador(false);   
  }
});

socket.on('netflix-subtitulos-client', function(data){
  llenarSubs(data[0]);
  appCargador(false);   
});

function llenarSubs(data = []){
  $(".audsub-aud").html(`<h5>${data.titAud}</h5>`);
  $(".audsub-text").html(`<h5>${data.titTex}</h5>`);
  data.audio.map((data)=>{
    $(".audsub-aud").append(`
      <button uia="${data.uia}" class="${(data.selected) ? 'selected':''}">
        ${data.nombre}
      </button>
    `);
  });
  data.textos.map((data)=>{
    $(".audsub-text").append(`
      <button uia="${data.uia}" class="${(data.selected) ? 'selected':''}">
        ${data.nombre}
      </button>
    `);
  });
}

function llenarBusqueda(data = []){
  $(".app-netflix-buscador-resultados").html("");
  $("#search-netflix").val(data.busqueda);
  data.resultados.map((data)=>{
    $(".app-netflix-buscador-resultados").append(`
      <div class="netflix-item-busqueda" href="${data.href}">
        <img src="${data.img}" alt="${data.titulo}">
      </div>
    `);
  });
  appCargador(false); 
}

function llenarLogin(data = []){
  $(".app-netflix-login h3").html(data.pregunta);
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