<script defer>
    var createMarker;
    document.getElementById('map-location-search').addEventListener('keydown', preventSubmit, true);

    function preventSubmit(e) {
        if (!e) e = window.event;
        const keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    }


    $(window).on('load', function() {
        const map = window.map;
        let marker = null;

        map.addListener('click', event => {
            createMarker(event.latLng);
        });

        const input = document.getElementById('map-location-search');
        
        const options = {
            componentRestrictions: {country: 'gt'}
        };
        const searchBox = new google.maps.places.Autocomplete(input, options);

        const contenedor = document.getElementsByClassName('map-location-search-wrapper')[0];
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(contenedor);

        map.addListener('bounds_changed', () => {
            searchBox.setBounds(map.getBounds());
        });

        searchBox.addListener('place_changed', () => {
            let place = searchBox.getPlace();
            if (place.length == 0) {
                return;
            }

            if (!place.geometry) {
                console.log(`No hay detalles disponibles para: ${place.name}`);
                return;
            }

            createMarker(place.geometry.location);
        });

        createMarker = location => {
            if(!marker){
                marker = new google.maps.Marker({
                    map,
                    position: location,
                    draggable:true
                });

                marker.addListener('position_changed', () => {
                    document.getElementById('lat').value = marker.getPosition().lat();
                    document.getElementById('lng').value = marker.getPosition().lng();
                })
            } else {
                marker.setPosition(location);
            }
            map.setZoom(16);
            map.panTo(marker.position);

            document.getElementById('lat').value = location.lat();
            document.getElementById('lng').value = location.lng();
        }
    });

</script>