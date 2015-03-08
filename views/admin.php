<?php
$db = baseController::getDB();
$stations       = $db->select('stations');
$reported_bikes = $db->select('registered_bikes', 'bike_status = 1');
?>
    <header>
        <h1>Administration Panel</h1>
    </header>
    
    <div id="reported-bikes" class="col-1-3">
        <h2>Reported bikes</h2>
        <select id="reported-selection">
            <?php 
            foreach($reported_bikes as $bike) { 
                $data = null;
                $logs = $db->select('logs', 'chip_number = ' . $bike['chip_number'] . ' AND timestamp >= ' . $bike['stolen_date']);
                if (is_array($logs)) foreach($logs as $log) $data .= $log['sensor_id'] . '|';
            ?>
            
            <option value="<?=$data?>"><?=$bike['full_name']?></option>
            <?php } ?>
        </select>
        <br><br>
        <button id="show_spotted">View spotted locations</button>
        <button>Contact owner</button>
    </div>
    
    <div class="col-1-3">
        <form action="/admin" method="POST">
            <h2>Add sensor station</h2>
            <input type="text" name="station_id" placeholder="Enter station ID">
            <input type="text" name="cctv_feed" placeholder="Enter CCTV feed">
            <input type="text" name="x_coord" placeholder="Enter x-coordinate">
            <input type="text" name="y_coord" placeholder="Enter y-coordinate">
            
            <input type="hidden" name="request_type" value="add_station">
            <input type="hidden" name="token" value="<?=$this->token?>">
            <input type="submit" value="Add">
        </form>
    </div>
    
    <div class="col-1-3">
        <form action="/admin" method="POST">
            <h2>Edit sensor station</h2>
            <select>
                <?php foreach($stations as $value) { ?>
                <option value="<?=$value['station_id']?>">Sensor: <?=$value['station_id']?></option>
                <?php } ?>
            </select>
            <input type="text" name="station_id" placeholder="CCTV Feed">
            <input type="text" name="x_coord" placeholder="Enter x-coordinate">
            <input type="text" name="y_coord" placeholder="Enter y-coordinate">
            
            <input type="hidden" name="request_type" value="add_station">
            <input type="hidden" name="token" value="<?=$this->token?>">
            <input type="submit" value="Edit">
        </form>
    </div>
</div>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvWIZiiVdjRkZH0BzmzLWtWjA-Bls38Ps"></script>
    <script type="text/javascript">
    var map;
    var marker = [];
    
      function initialize() {
        var mapOptions = {
          center: { lat: 53.3469952, lng: -6.2669672},
          zoom: 14,
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
        
        <?php foreach($stations as $station) { ?>
        var myLatlng = new google.maps.LatLng(<?=$station['x_coord']?>, <?=$station['y_coord']?>);
        
        marker[<?=$station['station_id']?>] = new google.maps.Marker({
            position: myLatlng,
            map: map,
            icon:'/img/green-marker.png'
        });
        <?php } ?>
         
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>

<h3 id="map-title">- Station View -</h3>
<div id="map-canvas"></div>