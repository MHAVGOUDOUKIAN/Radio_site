let radio = document.getElementById("radio_assets")
let select_menu = document.getElementById("html_select_box")
let checkbox_autostart = document.getElementById("autostart")
let prev_station = "RTL2"
let current_marker = null
let auto_audio = false
radio.volume = 0.2

var map = L.map('map').setView([51.505, -0.09], 13);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 13,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

select_menu.addEventListener('click',function() {
    if (select_menu.value != prev_station) 
        if (select_menu.value == "RTL2") {
            radio.setAttribute("src", "http://streaming.radio.rtl.fr/rtl-1-44-128"); 
            if(current_marker != null) map.removeLayer(current_marker)
            current_marker = L.marker([48.88405934210131, 2.2723762360776267]).addTo(map);
            current_marker.bindPopup("RTL").openPopup();
            map.setView([48.88405934210131, 2.2723762360776267], 19)
        }
        else if (select_menu.value == "France info") {
            radio.setAttribute("src", "https://icecast.radiofrance.fr/franceinter-midfi.mp3");
            if(current_marker != null) map.removeLayer(current_marker) 
            current_marker = L.marker([48.85326698142289, 2.2781261047018315]).addTo(map);
            current_marker.bindPopup("France info").openPopup();
            map.setView([48.85326698142289, 2.2781261047018315], 19)
        }
        else if (select_menu.value == "Sud Radio") {
            radio.setAttribute("src", "https://start-sud.ice.infomaniak.ch/start-sud-high.mp3"); 
            if(current_marker != null) map.removeLayer(current_marker)
            current_marker = L.marker([48.903531879069234, 2.2403908651476234]).addTo(map);
            current_marker.bindPopup("Sud Radio").openPopup();
            map.setView([48.903531879069234, 2.2403908651476234], 19)
        }
        else if (select_menu.value == "Radio Classique") {
            radio.setAttribute("src", "https://radioclassique.ice.infomaniak.ch/radioclassique-high.mp3"); 
            if(current_marker != null) map.removeLayer(current_marker)
            current_marker = L.marker([48.87653675275951, 2.3205542137869104]).addTo(map);
            current_marker.bindPopup("Radio Classique").openPopup();
            map.setView([48.87653675275951, 2.3205542137869104], 19)
        }
        prev_station = select_menu.value
})

checkbox_autostart.addEventListener("click", function() {
    auto_audio = !auto_audio
    console.log(auto_audio)
    radio.setAttribute("autoplay", auto_audio.toString());
})



