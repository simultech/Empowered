<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbsqfxbxr3WXtWEbMmNpA9uYPUDah9dO4"></script>
<script type="text/javascript">

	var mapstyle = [
    {
        "featureType": "landscape",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 65
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 51
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 30
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.local",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 40
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "transit",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "lightness": -25
            },
            {
                "saturation": -100
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#ffff00"
            },
            {
                "lightness": -25
            },
            {
                "saturation": -97
            }
        ]
    }
];

      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(<?php echo $map_lat; ?>, <?php echo $map_lng; ?>),
          zoom: 10,
          streetViewControl: false,
          mapTypeControl: false,
          styles: mapstyle,
        };
        var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
        var contentString = 'fdsljkadflskj';
        var infowindow = new google.maps.InfoWindow({
			content: contentString
	  	});
        var map = new google.maps.Map(document.getElementById("<?php echo $map_id; ?>"),
            mapOptions);
        var marker = new google.maps.Marker({
			position: new google.maps.LatLng(-34.397, 150.644),
			map: map,
			title: 'Uluru (Ayers Rock)',
			icon: 'http://mapicons.nicolasmollet.com/wp-content/uploads/mapicons/shape-default/color-128e4d/shapecolor-color/shadow-1/border-dark/symbolstyle-white/symbolshadowstyle-dark/gradient-no/garden.png'
		});
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map,marker);
		});
      }
      google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div id='<?php echo $map_id; ?>' class='map <?php echo $map_class; ?>' style="height:<?php echo $map_height;?>px;">fsda</div>