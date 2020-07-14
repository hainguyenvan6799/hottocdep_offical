<!DOCTYPE HTML>

<html>
   <head>
      
   </head>
   <title>My Google Map Store</title>
   <style type="text/css">
      #map{
         height: 700px;
         width: 700px;
      }
   </style>
   <body>
      <div id="map" data-ch_lat="{{str_replace('-', '.', $ch_lat)}}" data-ch_lng="{{str_replace('-', '.', $ch_lng)}}"></div>
   </body>
   <script type="text/javascript">
      function initMap(){
         if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            console.log(pos.lat);
            console.log(pos.lng);
            const test = document.querySelector('#map');

            var a = parseFloat(test.dataset.ch_lat);
            var b = parseFloat(test.dataset.ch_lng);
            
            var options = 
         {
            zoom: 15,
            center:{lat:a,lng:b}
         };
         var map= new google.maps.Map(document.getElementById('map'), options);

         var marker = new google.maps.Marker({
            position:{lat:a,lng:b},
            map:map
         });
         var markerofme = new google.maps.Marker({
            position:{lat:pos.lat,lng:pos.lng},
            map:map
         });

         var infoWindow = new google.maps.InfoWindow({
            content:'<h2>Store</h2>'
         });
         var infoWindowofme = new google.maps.InfoWindow({
            content:'<h2>Me</h2>'
         });

         marker.addListener('click', function(){
            infoWindow.open(map, marker);
         });
         markerofme.addListener('click', function(){
          infoWindowofme.open(map,markerofme);
         });

      });
       }
    }
   </script>
   <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJD-Hv4SomH0-BDoKTc9hUTY2SmrWFAzA&callback=initMap">
    </script>
</html>