

  //socket.emit('com-bg-app', 'obtener-recomendados-yt');

  $(document).on("input", "#ytbuscador", function () {
    socket.emit('servidor-funcion',`document.getElementById("search-input").childNodes[0].value = "${$(this).val()}";`);
  });

  $(document).on("click", ".btn-yt", function () {
    socket.emit('servidor-funcion',`document.getElementById("search-icon-legacy").click();`);
    $("#ytbuscador").val("");
    $(".app-yt-videos").scrollTop(0);
    appCargador();
  });

  $(document).on("click", ".app-yt-logo", function (e) {
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

  function scrollYt() {
    socket.emit('servidor-funcion',`window.scrollTo({ top: ${$(".app-yt-videos").scrollTop()}, behavior: 'smooth' });`);
    if(($(".app-yt-videos").scrollTop() % 50) == 0){
      if($(".app-yt-videos").find("h2").length){
        socket.emit('com-bg-app', 'obtener-recomendados-yt');
      } else {
        socket.emit('com-bg-app', 'obtener-resultados-yt');
      }
    }
  }

  $(document).on("click", ".app-yt-item", function (e) {
    socket.emit('servidor-funcion',`location.href = "${$(this).attr("href")}";`);
    appCargador();
  });


  $(document).on("click", ".app-yt-control .btn-up", function (e) {
    e.preventDefault();
    socket.emit('servidor-funcion',`window.history.back()`);
    appCargador();
    setTimeout(() => {
      $('.app-yt-control').removeClass("activo");
      $('.app-yt-videos').removeClass("activo").addClass("activo");
    }, 500);        
  });

  $(document).on("click", ".app-yt-control .btn-down", function (e) {
    e.preventDefault();
    socket.emit('servidor-funcion',`$("ytd-player").find("#movie_player").removeClass("ytp-autohide"); $(".ytp-size-button").trigger("click"); $("ytd-player").find("#movie_player").addClass("ytp-autohide");`);
  });

  $(document).on("click", ".app-yt-control .btn-left", function (e) {
    e.preventDefault();
    socket.emit('servidor-funcion',`$("ytd-player").find("#movie_player").removeClass("ytp-autohide"); 
      $(".ytp-fullscreen-button").trigger("click"); $("ytd-player").find("#movie_player").addClass("ytp-autohide");`);
  });

  $(document).on("click", ".app-yt-control .btn-play", function (e) {
    e.preventDefault();
    socket.emit('servidor-funcion',`$("ytd-player").find("#movie_player").removeClass("ytp-autohide"); $(".ytp-play-button").trigger("click"); $("ytd-player").find("#movie_player").addClass("ytp-autohide");`);
  });

  $(document).on("click", ".app-yt-control .btn-right", function (e) {
    e.preventDefault();
    socket.emit('servidor-funcion',`location.href = $('.ytp-next-button').attr('href');`);
  });

  

  socket.on('yt-on-client', function(data){   
    llenarGrilla(data[0].recomendados, true);
    $(".app-yt-user img").attr('src', "https:"+data[0].usuario);
    appCargador(false);     
  });

  socket.on('activar-control', function(data){  
    if($("body").hasClass("app-yt")) {
        $('.app-yt-control').removeClass("activo").addClass("activo");
        $('.app-yt-videos').removeClass("activo");
        appCargador(false); 
    }      
  });
  
  socket.on('resultados', function(data){
    if($("body").hasClass("app-yt")) {
      llenarGrilla(data[0].recomendados);
      appCargador(false);
    }
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

