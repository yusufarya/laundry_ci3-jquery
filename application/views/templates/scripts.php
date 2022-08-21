   <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   <!-- jquery cdn -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

   <!-- Bootbox Bootstrap -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

   <!-- other script -->
   <script>
      // $('.info-topBar').
      $(".info-topBar").hover(
         function() {
            $(this).append($("<span>&nbsp; Buka setiap hari, dari jam 09:00 s/d jam 17:30 </span>"));
            $(this).find(".info-topBar").remove();
         },
         function() {
            $(this).find("span").last().remove();
         }
      );
      $(".info-topBar").hover(function() {
         $(this).fadeOut(500);
         $(this).fadeIn(600);
      });
   </script>