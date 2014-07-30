<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      .map-canvas { height:500px; width:1000px }
      table { visibility:hidden; }
      table,th,td { border:1px solid black; border-collapse:collapse }
    </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1H88PyXHfW2qihya9R0VwoOF3cKmlSmY&sensor=FALSE&libraries=places">
    </script>
    <script type="text/javascript" src="../../static/js/index.js"></script>
  </head>
  <body>
    Latitude : <input type="number" step="0.000001" id="latitude"/>
    Longitude : <input type="number" step="0.000001" id="longitude"/>
    <button id="submit" onclick="initialize4()">Submit</button>
    </br></br>
    <div class="map-canvas" id="map-market"></div>
    <table id="table-market">
      <caption>20 Markets Closest to the PLace you Entered</caption>
      <tr>
        <th>Place</th>
        <th>Distance</th>
      </tr>
    </table>
    </br></br></br></br>
    <div class="map-canvas" id="map-atm"></div>
    <table id="table-atm">
      <caption>20 ATMs Closest to the PLace you Entered</caption>
      <tr>
        <th>Place</th>
        <th>Distance</th>
      </tr>
    </table>
    </br></br></br></br>
    <div class="map-canvas" id="map-metro"></div>
    <table id="table-metro">
      <caption>20 Metro Stations Closest to the PLace you Entered</caption>
      <tr>
        <th>Place</th>
        <th>Distance</th>
      </tr>
    </table>
    </br></br></br></br>
    <div class="map-canvas" id="map-restaurant"></div>
    <table id="table-restaurant">
      <caption>20 Restaurants Closest to the PLace you Entered</caption>
      <tr>
        <th>Place</th>
        <th>Distance</th>
      </tr>
    </table>
    </br></br></br></br>
  </body>
</html>