(function( $ ){
   $.fn.leafleter = function(config) {
   			var id = $(this).attr('id');
   
   			$.getJSON(config['url']+'configuration?token='+config['token']).done(function(configuration){
	   			var mymap = L.map(id).setView([configuration['view']['lat'], configuration['view']['lon']], configuration['view']['initZoom']);
				L.tileLayer("http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png", {
					attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, Tiles courtesy of <a href="http://hot.openstreetmap.org/" target="_blank">Humanitarian OpenStreetMap Team</a>',
					maxZoom: 18,
				}).addTo(mymap);
				
				
				var iconOptionGenerator = function(element, options) {
					var iconOptions = options || {};
					if (!element) {
						return iconOptions;
                    }
					if (element['size']) {
						iconOptions['iconSize'] = element['size'];
					}
					if (element['anchor']) {
						iconOptions['iconAnchor'] = element['anchor'];
					}
					if (element['popupAnchor']) {
						iconOptions['popupAnchor'] = element['popupAnchor'];
					}
					
					return iconOptions;
				};
				var iconUrlGenerator = function(token, url) {
					return url;
				};
				
				// load datapoints
				var MapIcon = L.Icon.extend({
				    options: iconOptionGenerator(configuration['icon'][0])
				});
				var icon = new MapIcon({iconUrl:iconUrlGenerator(config['token'],configuration['icon'][0]['url'])});
				var markerCluster = L.markerClusterGroup();
				$.getJSON(config['url']+'points?token='+config['token']).done(function(data) {
					$.each(data, function(index, element) {
					
					 	var markerConfiguration = iconOptionGenerator(element['img']) ;
						if (element['imgUrl']) {
							markerConfiguration = {
								icon: new MapIcon({iconUrl:'/images/'+config['token']+'/'+element['imgUrl']})
							}
						} else {
							markerConfiguration = {icon: icon}
						}
						var marker = L.marker([element['lat'], element['lng']],  markerConfiguration);
						if (config['callback']) {
							config['callback'](marker, element);
						}
						markerCluster.addLayer(marker);
					});
				});
				mymap.addLayer(markerCluster);
				
				// load features
				$.getJSON(config['url']+'features?token='+config['token']).done(function(region) {
					if ($.isEmptyObject(region)) {
						return;
					}
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