var ContactPage = function () {

    return {
        
    	//Basic Map
        initMap: function (lat, lng) {
			var map;
			$(document).ready(function(){
			  map = new GMaps({
				div: '#map',
				scrollwheel: false,
				lat: lat,
				lng: lng,
                zoom: 17
			  });
			  var marker = map.addMarker({
                lat: lat,
                lng: lng,
	            title: 'Kads Group'
		       });
			});
        },

        //Panorama Map
        initPanorama: function () {
		    var panorama;
		    $(document).ready(function(){
		      panorama = GMaps.createPanorama({
		        el: '#panorama',
		        lat : 40.748866,
		        lng : -73.988366
		      });
		    });
		}
    };

}();