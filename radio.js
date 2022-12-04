// Section of the site
let transition_div= document.getElementById("transition_div");
let welcome_banner_section= document.getElementById("welcome_banner_section");
let welcome_banner= document.getElementById("welcome_banner");
let core_section= document.getElementById("core_section");
let footer= document.getElementById("footer");
let connexion_form= document.getElementById("connexion_form");

// Object of the site
let radio = document.getElementById("radio_assets");
let select_menu = document.getElementById("html_select_box");

// Validation button
let open_login_form_btn= document.getElementById("open_login_form_btn");
let login_btn= document.getElementById("login_btn");
let login_abort_btn=document.getElementById("login_abort_btn");
let create_account_btn= document.getElementById("create_account_btn");
let create_account_abort_btn=document.getElementById("create_account_abort_btn");

let prev_station = "RTL2";
let current_marker = null;
let auto_audio = false;
radio.volume = 0.2;

var map = L.map('map').setView([51.505, -0.09], 13);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 13,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

/*select_menu.addEventListener('click',function() {
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
})*/

/////////////////  Accessing connexion form /////////////
open_login_form_btn.addEventListener('click',function() {
    transition_div.style.height= "100%";
    welcome_banner.style.opacity="0.0";
    window.setTimeout(function() {
        clearTimeout();
        connexion_form.style.display="inline-block";
        core_section.style.display="none";
        footer.style.display="none";
        welcome_banner_section.style.display="none";
        window.setTimeout(function(){
            clearTimeout();
            connexion_form.style.opacity="1.0";
        }, 50);
    }, 400);
})

/////////////////  Abort Connexion process /////////////
login_abort_btn.addEventListener('click',function() {
    connexion_form.style.opacity="0.0";
    window.setTimeout(function() {
        clearTimeout();
        connexion_form.style.display="none";
        core_section.style.display="block";
        footer.style.display="block";
        welcome_banner_section.style.display="block";
        
        window.setTimeout(function(){
            clearTimeout();
            welcome_banner.style.opacity="1.0";
            transition_div.style.height= "0%";
        }, 50);
    }, 400);
})

create_account_btn.addEventListener('click',function() {
    transition_div.style.height= "100%";
    welcome_banner.style.opacity="0.0";
    window.setTimeout(function() {
        clearTimeout();
        connexion_form.style.display="inline-block";
        core_section.style.display="none";
        footer.style.display="none";
        welcome_banner_section.style.display="none";
        window.setTimeout(function(){
            clearTimeout();
            connexion_form.style.opacity="1.0";
        }, 50);
    }, 400);
})

/////////////////  Abort Connexion process /////////////
create_account_abort_btn.addEventListener('click',function() {
    connexion_form.style.opacity="0.0";
    window.setTimeout(function() {
        clearTimeout();
        connexion_form.style.display="none";
        core_section.style.display="block";
        footer.style.display="block";
        welcome_banner_section.style.display="block";
        
        window.setTimeout(function(){
            clearTimeout();
            welcome_banner.style.opacity="1.0";
            transition_div.style.height= "0%";
        }, 50);
    }, 400);
})  