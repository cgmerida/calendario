import * as $ from "jquery";
import loadGoogleMapsAPI from "load-google-maps-api";

export default (function() {
    if ($("#google-map").length > 0) {
        loadGoogleMapsAPI({
            key: "AIzaSyDW8td30_gj6sGXjiMU0ALeMu1SDEwUnEA",
            libraries: ["places"]
        }).then(googleMap => {
            const latitude = 14.637795776121346;
            const longitude = -90.50896548156737;
            const mapZoom = 14;
            // const { google } = window;

            const mapOptions = {
                center: new googleMap.LatLng(latitude, longitude),
                zoom: mapZoom,
                mapTypeId: googleMap.MapTypeId.ROADMAP,
                mapTypeControl: true,
                mapTypeControlOptions: {
                    position: googleMap.ControlPosition.LEFT_BOTTOM
                },
                scaleControl: false,
                streetViewControl: false,
                fullscreenControl: true,
                styles: [
                    {
                        featureType: "all",
                        elementType: "labels.text.fill",
                        stylers: [
                            {
                                saturation: 36
                            },
                            {
                                color: "#000000"
                            },
                            {
                                lightness: 40
                            }
                        ]
                    },
                    {
                        featureType: "all",
                        elementType: "labels.text.stroke",
                        stylers: [
                            {
                                visibility: "on"
                            },
                            {
                                color: "#000000"
                            },
                            {
                                lightness: 16
                            }
                        ]
                    },
                    {
                        featureType: "all",
                        elementType: "labels.icon",
                        stylers: [
                            {
                                visibility: "off"
                            }
                        ]
                    },
                    {
                        featureType: "administrative",
                        elementType: "geometry.fill",
                        stylers: [
                            {
                                color: "#000000"
                            },
                            {
                                lightness: 20
                            }
                        ]
                    },
                    {
                        featureType: "administrative",
                        elementType: "geometry.stroke",
                        stylers: [
                            {
                                color: "#000000"
                            },
                            {
                                lightness: 17
                            },
                            {
                                weight: 1.2
                            }
                        ]
                    },
                    {
                        featureType: "landscape",
                        elementType: "geometry",
                        stylers: [
                            {
                                color: "#000000"
                            },
                            {
                                lightness: 20
                            }
                        ]
                    },
                    {
                        featureType: "poi",
                        elementType: "geometry",
                        stylers: [
                            {
                                color: "#000000"
                            },
                            {
                                lightness: 21
                            }
                        ]
                    },
                    {
                        featureType: "road.highway",
                        elementType: "geometry.fill",
                        stylers: [
                            {
                                color: "#000000"
                            },
                            {
                                lightness: 17
                            }
                        ]
                    },
                    {
                        featureType: "road.highway",
                        elementType: "geometry.stroke",
                        stylers: [
                            {
                                color: "#000000"
                            },
                            {
                                lightness: 29
                            },
                            {
                                weight: 0.2
                            }
                        ]
                    },
                    {
                        featureType: "road.arterial",
                        elementType: "geometry",
                        stylers: [
                            {
                                color: "#000000"
                            },
                            {
                                lightness: 18
                            }
                        ]
                    },
                    {
                        featureType: "road.local",
                        elementType: "geometry",
                        stylers: [
                            {
                                color: "#000000"
                            },
                            {
                                lightness: 16
                            }
                        ]
                    },
                    {
                        featureType: "transit",
                        elementType: "geometry",
                        stylers: [
                            {
                                color: "#000000"
                            },
                            {
                                lightness: 19
                            }
                        ]
                    },
                    {
                        featureType: "water",
                        elementType: "geometry",
                        stylers: [
                            {
                                color: "#000000"
                            },
                            {
                                lightness: 17
                            }
                        ]
                    }
                ]
            };

            const map = new googleMap.Map(
                document.getElementById("google-map"),
                mapOptions
            );

            window.map = map;

            // new googleMap.Marker({
            //   map,
            //   position : new googleMap.LatLng(latitude, longitude),
            //   visible  : true,
            // });
        });
    }
})();
