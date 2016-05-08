<?php
if(!empty($_GET['location'])){
    $maps_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($_GET['location']);
    $maps_json = file_get_contents($maps_url);
    $maps_array = json_decode($maps_json, true);
    
    $lat = $maps_array['results'][0]['geometry']['location']['lat'];
    $lng = $maps_array['results'][0]['geometry']['location']['lng'];
    
    $instagram_url = 'https://api.instagram.com/v1/media/search?lat=' . $lat . '&lng=' . $lng . '&client_id=c51199cbf2ea435693578445bd1c5e88';
    
    $instagram_json = file_get_contents($instagram_url);
    $instagram_array = json_decode($instagram_json, true);
    
}
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <title>GeoPics - View Photos from Around the World</title>
 </head>
 <body>
  <form action="">
      <input type="text" name="location">
      <button type="submit">Submit</button>
      <br>
      <br>
      <?php
        if(!empty($instagram_array)){
           foreach($instagram_array['data'] as $image){
              echo '<img src="'.$image['images']['low_resolution']['url'].'"  alt=""/>';
           }
        }
      ?>
  </form>
 </body>
</html>