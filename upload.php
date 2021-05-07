<?php 

require_once './config.php';

if(isset($_POST["submit"])) {
    $filepath = $_FILES["filepath"]["tmp_name"];

    if($_FILES["filepath"]["size"] > 0) {
        
        // open the file
        $file = fopen($filepath, "r");

        // insert strings:
        $insert_rooms = "INSERT INTO rooms (building_id, room_name) VALUES ";
        $insert_brands = "INSERT INTO rooms (brand_name) VALUES ";
        $insert_models = "INSERT INTO rooms (brand_id, model_name) VALUES ";
        $insert_assets = "INSERT INTO rooms (building_id, room_name) VALUES ";

        // skip header row
        $skip = 0;

        // read each row of the csv file into the csv_rows[] array
        While (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $skip++;
            if($skip == 1) {continue;}

            $bldg = "";
            if (isset($column[0])) {
                $bldg = mysqli_real_escape_string($link, $column[0]);
            } 
            $rm = "";
            if (isset($column[1])) {
                $room = mysqli_real_escape_string($link, $column[1]);
            }           
            $loc = "";
            if (isset($column[2])) {
                $loc = mysqli_real_escape_string($link, $column[2]);
            }    
            $user = "";
            if (isset($column[3])) {
                $user = mysqli_real_escape_string($link, $column[3]);
            }    
            $name = "";
            if (isset($column[4])) {
                $name = mysqli_real_escape_string($link, $column[4]);
            }    
            $tag = "";
            if (isset($column[5])) {
                $tag = mysqli_real_escape_string($link, $column[5]);
            }    
            $type = "";
            if (isset($column[6])) {
                $type = mysqli_real_escape_string($link, $column[6]);
            }    
            $make = "";
            if (isset($column[7])) {
                $make = mysqli_real_escape_string($link, $column[7]);
            }
            $mdl = "";
            if (isset($column[8])) {
                $model = mysqli_real_escape_string($link, $column[8]);
            }     
            $sn = "";
            if (isset($column[9])) {
                $sn = mysqli_real_escape_string($link, $column[9]);
            }    
            $os = "";
            if (isset($column[10])) {
                $os = mysqli_real_escape_string($link, $column[10]);
            }    
            $cpu = "";
            if (isset($column[11])) {
                $cpu = mysqli_real_escape_string($link, $column[11]);
            }    
            $s_type = "";
            if (isset($column[12])) {
                $s_type = mysqli_real_escape_string($link, $column[12]);
            }    
            $s_size = "";
            if (isset($column[13])) {
                $s_size = mysqli_real_escape_string($link, $column[13]);
            }    
            $mem = "";
            if (isset($column[14])) {
                $mem = mysqli_real_escape_string($link, $column[14]);
            }    
            $ip = "";
            if (isset($column[15])) {
                $ip = mysqli_real_escape_string($link, $column[15]);
            }    
            $w_mac = "";
            if (isset($column[16])) {
                $w_mac = mysqli_real_escape_string($link, $column[16]);
            }    
            $l_mac = "";
            if (isset($column[17])) {
                $l_mac = mysqli_real_escape_string($link, $column[17]);
            }    
            $d_purchase = "";
            if (isset($column[18])) {
                $d_purchase = mysqli_real_escape_string($link, $column[18]);
            }    
            $d_checkout = "";
            if (isset($column[19])) {
                $d_checkout = mysqli_real_escape_string($link, $column[19]);
            }    
            $d_checkin = "";
            if (isset($column[20])) {
                $d_checkin = mysqli_real_escape_string($link, $column[20]);
            }    
            $status = "";
            if (isset($column[21])) {
                $status = mysqli_real_escape_string($link, $column[21]);
            }    
            $price = "";
            if (isset($column[22])) {
                $price = mysqli_real_escape_string($link, $column[22]);
            }    
            $sped = "";
            if (isset($column[23])) {
                $sped = mysqli_real_escape_string($link, $column[23]);
            }    
            
            $insert_rooms .= "((SELECT building_id FROM buildings WHERE building_code = '" . $bldg . "'),'" . $rm . "'),";
            $insert_brands .= "('" . $make . "')";
            $model = mysqli_prepare($link,"INSERT IGNORE INTO models (brand_id,model_name) VALUES ((SELECT brand_id FROM brands WHERE brand_name = ?), ?);");
            mysqli_stmt_bind_param($model, 'ss', $make, $mdl);
            $insert_models .= $model;
            $asset = mysqli_prepare($link,"INSERT IGNORE INTO assets (asset_tag,asset_location,asset_name,asset_serial,model_id,room_id,status_id,dev_type_id,os_id,
                            asset_cpu,asset_hdd_type,asset_hdd_size,asset_mem,asset_static_ip,asset_wlan_mac,asset_lan_mac,asset_sped_tag,asset_date,asset_price) VALUES
                            (?,?,?,?, (SELECT model_id FROM models WHERE model_name = ?),(SELECT room_id FROM rooms WHERE room_number = ?),
                            (SELECT status_id FROM dev_status WHERE status_name = ?),(SELECT dev_type_id FROM dev_types WHERE dev_type = ?),
                            (SELECT os_id FROM systems WHERE os_name = ?),?,?,?,?,?,?,?,?,(STR_TO_DATE(?,'%m/%d/%Y'),?);");
            $pAsset = "issssssssssssssssid";
            mysqli_bind_param($asset, $pAsset, $tag, $loc, $name, $sn, $mdl, $rm, $status, $type, $os, $cpu, $s_type, $s_size, $mem, $ip, $w_mac, $l_mac, $sped, $d_purchase, $price);
            $insert_assets .= $asset;
        }

        $sql = $insert_rooms . $insert_brands . $insert_models . $insert_assets;

        if(mysqli_multi_query($link, $sql)) {
            echo 1;
        } else {
            echo 0;
        }
    }
}

?>