let radio = document.getElementById("radio_assets")
let select_menu = document.getElementById("html_select_box")
let checkbox_autostart = document.getElementById("autostart")
let connexion_btn = document.getElementById("connexion_btn")
let transition_div= document.getElementById("transition_div")
let welcome_banner= document.getElementById("welcome_banner")
let footer= document.getElementById("footer")
let core_section= document.getElementById("core_section")
let connexion_form= document.getElementById("connexion_form")
let welcome_banner_section= document.getElementById("welcome_banner_section")

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

connexion_btn.addEventListener('click',function() {
    transition_div.style.height= "100%";
    welcome_banner.style.opacity="0.0";
    window.setTimeout(clear_index_page_section, 400);
})

function clear_index_page_section() {
    clearTimeout();
    connexion_form.style.display="inline-block";
    core_section.style.display="none";
    footer.style.display="none";
    welcome_banner_section.style.display="none";
    window.setTimeout(function(){
        clearTimeout();
        connexion_form.style.opacity="1.0";
    }, 50);
}
