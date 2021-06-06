var socket = io("http://192.168.0.104:3000");


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
$(document).on("input", ".apptv-input input", function (event) {
  if (this.value.length > 1) this.value = this.value.slice(0, 1);
});
$(document).on("keyup", ".apptv-input input", function (event) {
  if(event.keyCode == 13){
    conectar();
  }
  if(event.keyCode == 8){
      var n = parseInt($(this).attr("name")[6]) - 1;
      if(n > 0){
        $("input[name='txtcon"+n+"']").focus();
      }
  }
});
$(document).on("click", ".btn-conectar", function (event) {
    event.preventDefault();
    conectar();
      
});
socket.on("emparejados", function(){
    
    $(".container-general").load("./modules/default/control/control.html", function(){
      $("body").attr("class", "app-control");
      appCargador(false);
    });
});
var webActiva;
socket.on("web-cliente", function(data){
    // clases body: app-yt app-control app-netflix app-tv
    //console.log(data);
    appCargador();
    if(webActiva == data)
      return false;

    cargarPagina(data);
});

$(document).on("click", ".app-tv-menu-botonera .btn-home", function () {
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

function cargarPagina(pagina = "control"){
  $(".container-general").load(`./modules/default/${pagina}/${pagina}.html`, function(){
    $("body").attr("class", `app-${pagina}`);
    webActiva = pagina;
    if(pagina == "control")
      appCargador(false);
  });
}

function conectar(){
  let numConexion = $("input[name='txtcon1']").val()+$("input[name='txtcon2']").val()+$("input[name='txtcon3']").val()+$("input[name='txtcon4']").val()+$("input[name='txtcon5']").val()+$("input[name='txtcon6']").val();
  if(numConexion != '' && numConexion.length == 6){
    appCargador();
    socket.emit("entrar-conexion", numConexion);
  } else {
    alert("Te faltan numeritos");
  }
}