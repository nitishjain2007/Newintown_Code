      function initialize2(ids) {
        var tname = ids + "table";
        var table = document.getElementsByClassName(tname);
        for(var i=0;i<table.length;i++){
          var tr = table[i].getElementsByTagName("tr");
          while(tr.length>1){
            table[i].deleteRow(1);
          }
        }
        var latd = ids + "latitude";
        var lngd = ids + "longitude";
        latitude = document.getElementById(latd).value;
        longitude = document.getElementById(lngd).value;
        mycenter = new google.maps.LatLng(latitude, longitude);
        var mapOptions = {
          center: mycenter,
          zoom: 14
        };
        var mapname = ids + "map";
        var map_market = new google.maps.Map(document.getElementById(mapname),mapOptions);
//        var map_atm = new google.maps.Map(document.getElementById("map-atm"),mapOptions);
  //      var map_metro = new google.maps.Map(document.getElementById("map-metro"),mapOptions);
    //    var map_restaurant = new google.maps.Map(document.getElementById("map-restaurant"),mapOptions);

        var tablemarket = "shoppingview" + ids;
        var tableatm = "atmview" + ids;
        var tablemetro = "metroview" + ids;
        var tablerestaurant = "restaurantview" + ids;
        var marker_market = new google.maps.Marker({
          map : map_market,
          position : mycenter,
          animation : google.maps.Animation.BOUNCE
        });
      /*  var marker_atm = new google.maps.Marker({
          map : map_atm,
          position : mycenter,
          animation : google.maps.Animation.BOUNCE
        });
        var marker_metro = new google.maps.Marker({
          map : map_metro,
          position : mycenter,
          icon : 'https://maps.gstatic.com/mapfiles/ms2/micons/restaurant.png'
        });
        var marker_restaurant = new google.maps.Marker({
          map : map_restaurant,
          position : mycenter,
          animation : google.maps.Animation.BOUNCE
        });*/


        var request = {
          location: mycenter,
          rankBy: google.maps.places.RankBy.DISTANCE,
          types: ['grocery_or_supermarket']
        };
        var service = new google.maps.places.PlacesService(map_market);
        service.nearbySearch(request, function (results, status) {
          callback(results, status, map_market, tablemarket);
        });

        var request = {
          location: mycenter,
          rankBy: google.maps.places.RankBy.DISTANCE,
          types: ['atm']
        };
        var service = new google.maps.places.PlacesService(map_market);
        service.nearbySearch(request, function (results, status) {
          callback(results, status, map_market, tableatm);
        });

        var request = {
          location: mycenter,
          rankBy: google.maps.places.RankBy.DISTANCE,
          name : 'Metro Station'
        };
        var service = new google.maps.places.PlacesService(map_market);
        service.nearbySearch(request, function (results, status) {
          callback_metro(results, status, map_market, tablemetro);
        });

        var request = {
          location: mycenter,
          rankBy: google.maps.places.RankBy.DISTANCE,
          types: ['restaurant']
        };
        var service = new google.maps.places.PlacesService(map_market);
        service.nearbySearch(request, function (results, status) {
          callback(results, status, map_market, tablerestaurant);
        });

        function callback(results, status, map_var, id) {
          if (status == google.maps.places.PlacesServiceStatus.OK) {
            document.getElementById(id).style.visibility="visible";
            for (var i = 0; i < 7; i++) {
              var table = document.getElementById(id);
              var tr = document.createElement("TR");
              var td1 = document.createElement("TD");
              var text1 = document.createTextNode(results[i].name);
              var td2 = document.createElement("TD");
              var text2 = document.createTextNode("");
              td1.appendChild(text1);
              td2.appendChild(text2);
              tr.appendChild(td1);
              tr.appendChild(td2);
              table.appendChild(tr);
              createMarker(results[i], map_var, id);
            }
            var tr_t = document.getElementById(id).getElementsByTagName("tr");
            var dest = new Array;
            for (var i=0; i<7; i++){
              dest[i] = results[i].geometry.location;
            }
              
            var service1 = new google.maps.DistanceMatrixService();
            service1.getDistanceMatrix(
            {
              origins: [mycenter],
              destinations: dest,
              travelMode: google.maps.TravelMode.DRIVING,
              unitSystem: google.maps.UnitSystem.METRIC,
              avoidHighways: false,
              avoidTolls: false
            }, function (response, status) {
              distance(response, status, tr_t);
            });
          }
        }
        function distance(response, status, tr) {
          if (status == google.maps.DistanceMatrixStatus.OK) {
            var element = response.rows[0].elements;
            for(var j=0; j<element.length; j++){
              tr[j+1].getElementsByTagName("td")[1].innerHTML = element[j].distance.text;
            }
          }
        }
        function callback_metro(results, status, map_var, id) {
          if (status == google.maps.places.PlacesServiceStatus.OK) {
            var flag = new Array;
            document.getElementById(id).style.visibility="visible";
            for (var i = 0; i < results.length; i++) {
              var type = results[i].types;
              for(var j = type.length - 1; j >= 0; j--) {
                if(type[j]=='establishment' || type[j]=='subway_station' || type[j]=='train_station') {
                  type.splice(j, 1);
                }
              }
              if(type.length == 0 && results[i].name.indexOf('Cafe Coffee Day') == -1){
                flag[i]=1;
                var table = document.getElementById(id);
                var tr = document.createElement("TR");
                var td1 = document.createElement("TD");
                var text1 = document.createTextNode(results[i].name);
                var td2 = document.createElement("TD");
                var text2 = document.createTextNode("");
                td1.appendChild(text1);
                td2.appendChild(text2);
                tr.appendChild(td1);
                tr.appendChild(td2);
                table.appendChild(tr);
                createMarker(results[i], map_var, id);
              }
              else flag[i]=0;
            }
            var tr_t = document.getElementById(id).getElementsByTagName("tr");
            var dest = new Array;
            var len = 0;
            for (var i=0; i<results.length; i++){
              if(flag[i]==1)
                dest[len++] = results[i].geometry.location;
            }
            
            var service1 = new google.maps.DistanceMatrixService();
            service1.getDistanceMatrix(
            {
              origins: [mycenter],
              destinations: dest,
              travelMode: google.maps.TravelMode.DRIVING,
              unitSystem: google.maps.UnitSystem.METRIC,
              avoidHighways: false,
              avoidTolls: false
            }, function (response, status) {
              distance(response, status, tr_t);
            });
          }
        }

        var infowindow = new google.maps.InfoWindow();
        function createMarker(place, map_var, id) {
	  if(id.charAt(0) == "r"){
          var marker = new google.maps.Marker({
            map: map_var,
            position: place.geometry.location,
	    icon : '../../static/images/restaurant.png'
          });
	}
	else if(id.charAt(0) == "m"){
	   var marker = new google.maps.Marker({
            map: map_var,
            position: place.geometry.location,
	    icon : '../../static/images/rail.png'
          });
	}
  else if(id.charAt(0) == "a"){
      var marker = new google.maps.Marker({
            map: map_var,
            position: place.geometry.location,
      icon : '../../static/images/rupee-icon.png'
          });
  }
  else if(id.charAt(0) == "s"){
      var marker = new google.maps.Marker({
            map: map_var,
            position: place.geometry.location,
      icon : '../../static/images/shopping.png'
          });
  }
          google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(place.name);
            infowindow.open(map_var, this);
          });
        }
      }
