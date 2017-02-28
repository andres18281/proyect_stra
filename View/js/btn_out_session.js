
     $(function(){
        

        $(".log_out ").click(function(){
              $.ajax({
                type:"post",
                url:"controllers/session_destroy.php",
                data:{"session":"destroy"},
                dataType:'json',
                success:function(dato){
                   window.location.reload();
                   window.location.reload();
                }
              }).done(function(){
                window.location.reload();
                window.location.reload();
              });    
        });
    });
     
  