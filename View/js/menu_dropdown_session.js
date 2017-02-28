
      
 $(function(){
    $(document).on('click',"#log_out",function() {
        $.ajax({
          dataType:'json',
          type:"post",
          url:"Controller/session_destroy.php",
          data:{"session":"destroy"}
        }).done(function(data){
           if(data.salir){
           
            window.location.reload(true);  
            location.reload(true);
           }
          

        });
      });
  }); 