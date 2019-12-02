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
    appCargador();
    socket.emit("entrar-conexion", $("input[name='txtcon1']").val()+$("input[name='txtcon2']").val()+$("input[name='txtcon3']").val()+$("input[name='txtcon4']").val()+$("input[name='txtcon5']").val()+$("input[name='txtcon6']").val());
});
socket.on("emparejados", function(){
    
    $(".container-general").load("control.php", function(){
      $("body").attr("class", "app-control");
      appCargador(false);
    });
});
var webActiva;
socket.on("web-cliente", function(data){
    // clases body: app-yt app-control app-netflix app-tv
    console.log(data);
    appCargador();
    if(webActiva == data)
      return false;

    switch (data) {
      case "youtube":
        $(".container-general").load("youtube.php", function(){
          $("body").attr("class", "app-yt");
          webActiva = data;
          appCargador(false);
        });
      break;
      case "netflix":
        $(".container-general").load("netflix.php", function(){
          $("body").attr("class", "app-netflix");
          webActiva = data;
          appCargador(false);
        });
      break;
    
      default:
        $(".container-general").load("control.php", function(){
          $("body").attr("class", "app-control");
          webActiva = data;
          appCargador(false);
        });
      break;
    }
});

$(document).on("click", ".btn-home", function () {
    socket.emit('com-bg-app', 'index');
    $(".app-tv-menu-general").toggleClass("activo");
    appCargador();
});

$(document).on("click", ".app-tv-menu-footer", function (e) {
  e.preventDefault();
  $(".app-tv-menu-general").toggleClass("activo");
});

function appCargador(t = true) {

  if(!t){
    $("#cargador").removeClass("activo");
  } else {
    $("#cargador").addClass("activo");
  }
}
