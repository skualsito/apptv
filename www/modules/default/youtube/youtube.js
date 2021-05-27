

  //socket.emit('com-bg-app', 'obtener-recomendados-youtube');

  $(document).on("input", "#ytbuscador", function () {
    socket.emit('servidor-funcion',`document.getElementById("search-input").childNodes[0].value = "${$(this).val()}";`);
  });

  $(document).on("click", ".btn-youtube", function () {
    socket.emit('servidor-funcion',`document.getElementById("search-icon-legacy").click();`);
    $("#ytbuscador").val("");
    $(".app-youtube-videos").scrollTop(0);
    appCargador();
  });

  $(document).on("click", ".app-youtube-logo", function (e) {
    e.preventDefault();
    appCargador();
    setTimeout(() => {
      $('.app-youtube-control').removeClass("activo");
      $('.app-youtube-videos').removeClass("activo").addClass("activo");
    }, 500); 
    socket.emit('servidor-funcion',`location.href = "/";`); 
    $(".app-youtube-videos").scrollTop(0);
    socket.emit('com-bg-app', 'obtener-recomendados-youtube');  
    
  });

  // function scrollYt() {
  //   socket.emit('servidor-funcion',`window.scrollTo({ top: ${$(".app-youtube-videos").scrollTop()}, behavior: 'smooth' });`);
  //   if(($(".app-youtube-videos").scrollTop() % 50) == 0){
  //     if($(".app-youtube-videos").find("h2").length){
  //       socket.emit('com-bg-app', 'obtener-recomendados-youtube');
  //     } else {
  //       socket.emit('com-bg-app', 'obtener-resultados-youtube');
  //     }
  //   }
  // }

  $(document).on("click", ".app-youtube-item", function (e) {
    socket.emit('servidor-funcion',`location.href = "${$(this).attr("href")}";`);
    appCargador();
  });


  $(document).on("click", ".app-youtube-control .btn-up", function (e) {
    e.preventDefault();
    socket.emit('servidor-funcion',`window.history.back()`);
    appCargador();
    setTimeout(() => {
      $('.app-youtube-control').removeClass("activo");
      $('.app-youtube-videos').removeClass("activo").addClass("activo");
    }, 500);        
  });

  $(document).on("click", ".app-youtube-control .btn-down", function (e) {
    e.preventDefault();
    socket.emit('servidor-funcion',`$("ytd-player").find("#movie_player").removeClass("ytp-autohide"); $(".ytp-size-button").trigger("click"); $("ytd-player").find("#movie_player").addClass("ytp-autohide");`);
  });

  $(document).on("click", ".app-youtube-control .btn-left", function (e) {
    e.preventDefault();
    socket.emit('servidor-funcion',`$("ytd-player").find("#movie_player").removeClass("ytp-autohide"); 
      $(".ytp-fullscreen-button").trigger("click"); $("ytd-player").find("#movie_player").addClass("ytp-autohide");`);
  });

  $(document).on("click", ".app-youtube-control .btn-play", function (e) {
    e.preventDefault();
    socket.emit('servidor-funcion',`$("ytd-player").find("#movie_player").removeClass("ytp-autohide"); $(".ytp-play-button").trigger("click"); $("ytd-player").find("#movie_player").addClass("ytp-autohide");`);
  });

  $(document).on("click", ".app-youtube-control .btn-right", function (e) {
    e.preventDefault();
    socket.emit('servidor-funcion',`location.href = $('.ytp-next-button').attr('href');`);
  });

  

  socket.on('yt-on-client', function(data){  
    console.log(data); 
    llenarGrilla(data.recomendados, true);
    $(".app-youtube-user img").attr('src', data.usuario);
    appCargador(false);     
  });

  socket.on('activar-control', function(data){  
    if($("body").hasClass("app-youtube")) {
        $('.app-youtube-control').removeClass("activo").addClass("activo");
        $('.app-youtube-videos').removeClass("activo");
        appCargador(false); 
    }      
  });
  
  socket.on('resultados', function(data){
    if($("body").hasClass("app-youtube")) {
      llenarGrilla(data.recomendados);
      appCargador(false);
    }
  });

  function llenarGrilla(data = [], r = false){
    if(r){
      r = "<h2>Recomendados</h2>";
    }
    $(".app-youtube-videos").html(r);
    data.map((data)=>{
      if(data.href){
          $(".app-youtube-videos").append(`
          <div class="app-youtube-item" href="${data.href}">
            ${(data.img) ? '<img src="'+data.img+'" alt="'+data.titulo+'">' : '<img src="assets/img/yt_icon_mono_dark.png" alt="'+data.titulo+'">'}
            <div class="app-youtube-datos">
              <h4>${data.titulo}</h4>
              <h5 href="${data.canalink}">${data.canal} ${(data.verif) ? '<span class="app-youtube-check"><i class="fas fa-check"></i></span>' : ''}</h5>
              <p>${data.tiempo}</p>
            </div>
          </div>
          `);
        }
      });
  }

