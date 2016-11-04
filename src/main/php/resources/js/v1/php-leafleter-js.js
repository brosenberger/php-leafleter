(function( $ ){
   $.fn.leafleter = function(config) {
   			var id = $(this).attr('id');
   
   			$.getJSON(config['url']+'configuration?token='+config['token']).done(function(configuration){
	   			var mymap = L.map(id).setView([configuration['view']['lat'], configuration['view']['lon']], configuration['view']['initZoom']);
				L.tileLayer("http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png", {
					attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, Tiles courtesy of <a href="http://hot.openstreetmap.org/" target="_blank">Humanitarian OpenStreetMap Team</a>',
					maxZoom: 18,
				}).addTo(mymap);
				
				// load datapoints
				var MapIcon = L.Icon.extend({
				    options: {
				    	iconSize:     configuration['icon'][0]['size'],
				        iconAnchor:   configuration['icon'][0]['anchor'],
				        popupAnchor:  configuration['icon'][0]['popupAnchor']
				    }
				});
				var icon = new MapIcon({iconUrl:configuration['icon'][0]['url']});
				$.getJSON(config['url']+'points?token='+config['token']).done(function(data) {
					$.each(data, function(index, element) {
						var marker = L.marker([element['lat'], element['lng']],  {icon: icon}).addTo(mymap);
						if (config['callback']) {
							config['callback'](marker, element);
						}
					});
				});
				
				// load features
				$.getJSON(config['url']+'features?token='+config['token']).done(function(region) {
					L.geoJson(region, {style: function(feature) {
						return {
							fillColor: configuration['region'][0]['fillColor'],
							opacity: configuration['region'][0]['opacity'],
							color: configuration['region'][0]['color']
						};
					}}).addTo(mymap);
				});
   			});
   
      return this;
   }; 
})( jQuery );