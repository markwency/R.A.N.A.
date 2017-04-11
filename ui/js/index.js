$(document).ready(function(){

   Materialize.toast('Retrieving', 2000);
   $.ajax({
        type: 'POST',
        url: 'retrieve',
        success: function(data) {

          data = JSON.parse(data);

          Materialize.toast('Inquiries successfully retrieved.', 3000);
          console.log(data);
          
        }
  });
});