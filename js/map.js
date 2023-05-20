function initMap() {
    var place = { lat: 54.352025, lng: 18.646638 };
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: place
    });
    var marker = new google.maps.Marker({
        position: place,
        map: map,
    });
}
