import * as $ from 'jquery';
import loadGoogleMapsAPI  from 'load-google-maps-api';

export default (function () {
  if ($('#google-map').length > 0) {
    loadGoogleMapsAPI({
      key: 'AIzaSyDW8td30_gj6sGXjiMU0ALeMu1SDEwUnEA',
      libraries: ['places'],
    }).then((googleMap) => {
      const latitude = 14.637795776121346;
      const longitude = -90.50896548156737;
      const mapZoom = 14;
      // const { google } = window;

      const mapOptions = {
        center : new googleMap.LatLng(latitude, longitude),
        zoom : mapZoom,
        mapTypeId : googleMap.MapTypeId.ROADMAP,
        mapTypeControl: true,
        mapTypeControlOptions: {
          position: googleMap.ControlPosition.LEFT_BOTTOM
        },
        scaleControl: false,
        streetViewControl:false,
        fullscreenControl:true,
        styles: [{
          'featureType': 'landscape',
          'stylers': [
            { 'hue'        : '#FFBB00' },
            { 'saturation' : 43.400000000000006 },
            { 'lightness'  : 37.599999999999994 },
            { 'gamma'      : 1 },
          ],
        }, {
          'featureType': 'road.highway',
          'stylers': [
            { 'hue'        : '#FFC200' },
            { 'saturation' : -61.8 },
            { 'lightness'  : 45.599999999999994 },
            { 'gamma'      : 1 },
          ],
        }, {
          'featureType': 'road.arterial',
          'stylers': [
            { 'hue'        : '#FF0300' },
            { 'saturation' : -100 },
            { 'lightness'  : 51.19999999999999 },
            { 'gamma'      : 1 },
          ],
        }, {
          'featureType': 'road.local',
          'stylers': [
            { 'hue'        : '#FF0300' },
            { 'saturation' : -100 },
            { 'lightness'  : 52 },
            { 'gamma'      : 1 },
          ],
        }, {
          'featureType': 'water',
          'stylers': [
            { 'hue'        : '#0078FF' },
            { 'saturation' : -13.200000000000003 },
            { 'lightness'  : 2.4000000000000057 },
            { 'gamma'      : 1 },
          ],
        }, {
          'featureType': 'poi',
          'stylers': [
            { 'hue'        : '#00FF6A' },
            { 'saturation' : -1.0989010989011234 },
            { 'lightness'  : 11.200000000000017 },
            { 'gamma'      : 1 },
          ],
        }],
      };

      const map = new googleMap.Map(document.getElementById('google-map'), mapOptions);

      window.map = map;

      // new googleMap.Marker({
      //   map,
      //   position : new googleMap.LatLng(latitude, longitude),
      //   visible  : true,
      // });
    });
  }
}())
