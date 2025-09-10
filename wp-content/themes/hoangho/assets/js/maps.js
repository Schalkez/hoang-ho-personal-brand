jQuery(document).ready(function () {
    var styleMap = [
        {
            elementType: "geometry",
            stylers: [
                {
                    color: "#f5f5f5",
                },
            ],
        },
        {
            elementType: "labels.icon",
            stylers: [
                {
                    visibility: "off",
                },
            ],
        },
        {
            elementType: "labels.text.fill",
            stylers: [
                {
                    color: "#616161",
                },
            ],
        },
        {
            elementType: "labels.text.stroke",
            stylers: [
                {
                    color: "#f5f5f5",
                },
            ],
        },
        {
            featureType: "administrative.land_parcel",
            elementType: "labels.text.fill",
            stylers: [
                {
                    color: "#bdbdbd",
                },
            ],
        },
        {
            featureType: "poi",
            elementType: "geometry",
            stylers: [
                {
                    color: "#eeeeee",
                },
            ],
        },
        {
            featureType: "poi",
            elementType: "labels.text.fill",
            stylers: [
                {
                    color: "#757575",
                },
            ],
        },
        {
            featureType: "poi.park",
            elementType: "geometry",
            stylers: [
                {
                    color: "#e5e5e5",
                },
            ],
        },
        {
            featureType: "poi.park",
            elementType: "labels.text.fill",
            stylers: [
                {
                    color: "#9e9e9e",
                },
            ],
        },
        {
            featureType: "road",
            elementType: "geometry",
            stylers: [
                {
                    color: "#ffffff",
                },
            ],
        },
        {
            featureType: "road.arterial",
            elementType: "labels.text.fill",
            stylers: [
                {
                    color: "#757575",
                },
            ],
        },
        {
            featureType: "road.highway",
            elementType: "geometry",
            stylers: [
                {
                    color: "#dadada",
                },
            ],
        },
        {
            featureType: "road.highway",
            elementType: "labels.text.fill",
            stylers: [
                {
                    color: "#616161",
                },
            ],
        },
        {
            featureType: "road.local",
            elementType: "labels.text.fill",
            stylers: [
                {
                    color: "#9e9e9e",
                },
            ],
        },
        {
            featureType: "transit.line",
            elementType: "geometry",
            stylers: [
                {
                    color: "#e5e5e5",
                },
            ],
        },
        {
            featureType: "transit.station",
            elementType: "geometry",
            stylers: [
                {
                    color: "#eeeeee",
                },
            ],
        },
        {
            featureType: "water",
            elementType: "geometry",
            stylers: [
                {
                    color: "#c9c9c9",
                },
            ],
        },
        {
            featureType: "water",
            elementType: "labels.text.fill",
            stylers: [
                {
                    color: "#9e9e9e",
                },
            ],
        },
    ];
    $("[data-location]").each(function () {
        var data = $(this).data("location").split(",");

        if (data.length) {
            var mapPoints = [
                {
                    lat: parseFloat(data[0]),
                    lng: parseFloat(data[1]),
                    info: {
                        title: "",
                        link: "",
                        thumb: "",
                        price: "",
                    },
                },
            ];
            funcMap(mapPoints, this);
        }
    });

    function funcMap(mapPoints, mapEl) {
        var centerMap = {
            lat: mapPoints[0].lat,
            lng: mapPoints[0].lng,
        };
        map = new google.maps.Map(mapEl, {
            center: centerMap,
            zoom: 13,
            styles: styleMap,
        });
        var marker = new google.maps.Marker({
            position: centerMap,
            title: mapPoints[0].title,
            map: map,
            animation: google.maps.Animation.DROP,
            draggable: false,
            icon: {
                url: assets + "/images/icons/map.svg",
                size: new google.maps.Size(58, 86),
                origin: new google.maps.Point(0, 0),
            },
        });
        function resizeMarker() {
            if ($(window).width() < 1200) {
                marker.setIcon({
                    url: assets + "/images/icons/map-small.svg",
                    size: new google.maps.Size(29, 43),
                    origin: new google.maps.Point(0, 0),
                });
            } else {
                marker.setIcon({
                    url: assets + "/images/icons/map.svg",
                    size: new google.maps.Size(58, 86),
                    origin: new google.maps.Point(0, 0),
                });
            }
        }
        resizeMarker();
        $(window).resize(resizeMarker);
        // markers.push(marker);
    }
});
