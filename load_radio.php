<?php

    if(is_logged()) { // Load user's radios
        $all_radio = get_radio_by_owner($_SESSION['email']);
        for($i=0; $i< count($all_radio); ++$i) {
            echo "<option value=\"".$all_radio[$i]['name']."\">".$all_radio[$i]['name']."</option>";
        }
        echo "<script> document.getElementById('html_select_box').addEventListener('click',function() {\n
                if (select_menu.value != prev_station) {\n";
        for($i=0; $i< count($all_radio); ++$i) {
                if($i > 0) { echo "else if"; }
                else { echo "if"; }
                echo " (select_menu.value == '".$all_radio[$i]['name']."') {
                        radio.setAttribute('src', '".$all_radio[$i]['url']."');
                        if(current_marker != null) map.removeLayer(current_marker);
                        current_marker = L.marker([".$all_radio[$i]['long'].", ".$all_radio[$i]['lat']."]).addTo(map);
                        current_marker.bindPopup('".$all_radio[$i]['name']."').openPopup();
                        map.setView([".$all_radio[$i]['long'].", ".$all_radio[$i]['lat']."], 19);
                    }";
        }
        echo " prev_station = select_menu.value;
        }}); </script>";
    } else { // load default radios
        echo "<option value='RTL2' selected>RTL2</option> 
            <option value='France info'>France info</option>
            <option value='Sud Radio'>Sud Radio</option>
            <option value='Radio Classique'>Radio Classique</option>";

        echo "<script> document.getElementById('html_select_box').addEventListener('click',function() {
            if (select_menu.value != prev_station) {
                if (select_menu.value == 'RTL2') {
                    radio.setAttribute('src', 'http://streaming.radio.rtl.fr/rtl-1-44-128'); 
                    if(current_marker != null) map.removeLayer(current_marker);
                    current_marker = L.marker([48.88405934210131, 2.2723762360776267]).addTo(map);
                    current_marker.bindPopup('RTL').openPopup();
                    map.setView([48.88405934210131, 2.2723762360776267], 19);
                }
                else if (select_menu.value == 'France info') {
                    radio.setAttribute('src', 'https://icecast.radiofrance.fr/franceinter-midfi.mp3');
                    if(current_marker != null) map.removeLayer(current_marker);
                    current_marker = L.marker([48.85326698142289, 2.2781261047018315]).addTo(map);
                    current_marker.bindPopup('France info').openPopup();
                    map.setView([48.85326698142289, 2.2781261047018315], 19);
                }
                else if (select_menu.value == 'Sud Radio') {
                    radio.setAttribute('src', 'https://start-sud.ice.infomaniak.ch/start-sud-high.mp3'); 
                    if(current_marker != null) map.removeLayer(current_marker);
                    current_marker = L.marker([48.903531879069234, 2.2403908651476234]).addTo(map);
                    current_marker.bindPopup('Sud Radio').openPopup();
                    map.setView([48.903531879069234, 2.2403908651476234], 19);
                }
                else if (select_menu.value == 'Radio Classique') {
                    radio.setAttribute('src', 'https://radioclassique.ice.infomaniak.ch/radioclassique-high.mp3'); 
                    if(current_marker != null) map.removeLayer(current_marker);
                    current_marker = L.marker([48.87653675275951, 2.3205542137869104]).addTo(map);
                    current_marker.bindPopup('Radio Classique').openPopup();
                    map.setView([48.87653675275951, 2.3205542137869104], 19);
                }
                prev_station = select_menu.value;
            }}); </script>";
    }