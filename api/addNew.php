<?php
    include_once "../config/config.php";

    //getting form data
    $data = $_POST['data'];
    
    $date = "";

    if($data['date'] != "") {
        $date = "(STR_TO_DATE('" . $data['date'] . "',\'%m/%d/%Y\')";
    } else {
        $date = "NULL";
    }
   
    $os = $room = $type = $model = $status = "";

    if($data['os'] != "") {
        $os = "(SELECT os_id FROM systems WHERE os_name = '". $data['os'] . "')";
    } else {
        $os = "NULL";
    }

    if($data['room'] != "") {
        $room = "(SELECT room_id FROM rooms WHERE room_number = '". $data['room'] . "')";
    } else {
        $room = "NULL";
    }

    if($data['type'] != "") {
        $type = "(SELECT dev_type_id FROM dev_types WHERE dev_type = '". $data['type'] . "')";
    } else {
        $type = "NULL";
    }

    if($data['model'] != "") {
        $model = "(SELECT model_id FROM models WHERE model_name = '". $data['model'] . "')";
    } else {
        $model = "NULL";
    }

    if($data['status'] != "") {
        $status = "(SELECT status_id FROM dev_status WHERE status_name = '". $data['status'] . "')";
    } else {
        $status = "NULL";
    }

    $insert_rooms = 'INSERT IGNORE INTO rooms (building_id,room_number)
                     VALUES ((SELECT buildings.building_id FROM buildings WHERE buildings.building_code = "' . $data['bldg'] . '"), "' . $data['room'] . '");';

    mysqli_query($link, $insert_rooms); 


    // insert column 8 into brands table if it does not already exist
    $insert_brands = 'INSERT IGNORE
        INTO  brands (brand_name)
        VALUES (\'' . $data['brand']. '\');';

    mysqli_query($link, $insert_brands); 

    // insert column 9 into models table if it does not already exist
    $insert_models = 'INSERT IGNORE INTO  models (brand_id,model_name)
                      VALUES ((SELECT brand_id FROM brands WHERE brand_name = \''. $data['brand'] .'\'), \'' . $data['model'] . '\');';
    
    mysqli_query($link, $insert_models); 

    // insert data into assets table
    $insert_assets = 'INSERT IGNORE INTO  assets
                      (asset_tag, asset_location, asset_name, asset_serial, model_id, room_id, status_id, dev_type_id,
                       os_id, asset_cpu, asset_hdd_type, asset_hdd_size, asset_mem, asset_static_ip, asset_wlan_mac,
                       asset_lan_mac, asset_sped_tag, asset_bios_password, asset_date, asset_price)
                      VALUES (' . $data['id'] . ',"' . $data['loc'] . '", "' . $data['name'] . '", "' . $data['sn'] . '",
                      ' . $model . ',' . $room . ','. $status . ',' . $type .',' . $os .', 
                      "' . $data['cpu'] .'", "' . $data['s_type'] .'", "' . $data['s_size'] .'", 
                      "' . $data['mem'] .'", "' . $data['ip'] .'", "' . $data['wlan'] .'", 
                      "' . $data['lan'] .'", "' . $data['sped'] .'", "' . $data['bios'] .'", 
                      ' . $date .', "' . $data['price'] .'");';

    // echo $insert_assets;
    mysqli_query($link, $insert_assets); 

    $new_asset = "SELECT * FROM assets ORDER BY asset_tag DESC LIMIT 1";

    $result = mysqli_query($link, $new_asset);

    $data = $result->fetch_assoc();

    echo json_encode($data);
?>