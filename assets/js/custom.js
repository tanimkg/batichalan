/* BUtton actions */
$(document).ready(function(){
   $('#loastLoaderBtn').click(function(){
       $.getJSON(
           baseUrl + "/lost/recent",
           null,
           function(losts) {
               $('#serviceName').html(losts);
           }

       );
   })
});