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

  

var x = 1, y = 1, maxx = 2, maxy = 1;
$(document).on("click", ".app-pantallacompleta .btn-success", function(){
  toggleFullscreen();
  $(".app-pantallacompleta").removeClass("activo");
});

$(document).on("click", ".app-pantallacompleta .btn-primary, .app-pantallacompleta .btn-cerrar", function(){
  $(".app-pantallacompleta").removeClass("activo");
});
$(document).on("click", ".btnControl", function (e) {
  e.preventDefault();
  let ok = false;
  switch ($(this).attr("action")) {
    case "up":
      if(y-1 == 1 || y-1 >= maxy)
        y--;
    break;

    case "down":
      if(y+1 == 1 || y+1 <= maxy)
        y++;
    break;

    case "left":
      if(x-1 == 1 || x-1 >= maxx)
        x--;
    break;

    case "right":
      if(x+1 == 1 || x+1 <= maxx)
        x++;
    break;

    case "ok":
      ok = true;
    break;

  }
  console.log(x, y);
  socket.emit('control-boton-server', {x: x, y: y, ok: ok});
  
});
