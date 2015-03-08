
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvWIZiiVdjRkZH0BzmzLWtWjA-Bls38Ps"></script>
    <script type="text/javascript">
    var map;
      function initialize() {
        var mapOptions = {
          center: { lat: 53.3403594, lng: -6.2502732},
          zoom: 12
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
            
        var myLatlng = new google.maps.LatLng(53.343380, -6.283726);
        
        var marker = new google.maps.Marker({
              position: myLatlng,
              map: map,
              icon:'/img/green-marker.png'
         });
         
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>

<div id="map-canvas"></div>
