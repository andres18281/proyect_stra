$(function(){
  $("#btn_login").click(function(){
    var email = $("#email_count").val();
    var pass = $("#password_count").val();
    $.ajax({
      dataType:"json",
      type:"post",
      url:"controllers/Clientes_Controller.php",
      data:{"count":email,"pass":pass},
      success:function(data){
        if(data.data == true){
           window.location.reload();
           window.location.reload();
        }else{
          alert("usuario o contraseña invalida, por favor intente de nuevo");
        }
      }
    });
  });
});