<?php   
    include_once '../config/config.php';

    //getting form data
    $data = $_POST['data'];

    $rowID = $data['row'];
    
    $update = '';

    if($rowID == $data['id']) {
        $update = 'UPDATE assets SET asset_name ="' . $data['name'] . '",';     
    } else {
        $update = 'UPDATE assets SET asset_tag ="' . $data['id'] . '",asset_name ="' . $data['name'] . '",';
    }

    $update .= 'room_id = (SELECT room_id FROM rooms WHERE room_number = "' . $data['room'] . '"),';
    $update .= 'asset_location = "' . $data['loc'] . '",';
    $update .= 'asset_serial = "' . $data['sn'] . '",';
    $update .= 'model_id = (SELECT model_id FROM models WHERE model_name = "' . $data['model'] . '"),';
    $update .= 'status_id = (SELECT status_id FROM dev_status WHERE status_name = "' . $data['status'] . '"),';
    $update .= 'dev_type_id = (SELECT dev_type_id FROM dev_types WHERE dev_type = "' . $data['type'] . '"),';
    $update .= 'os_id = (SELECT os_id FROM systems WHERE os_name = "' . $data['os'] . '"),';
    $update .= 'asset_cpu = "' . $data['cpu'] . '",';
    $update .= 'asset_hdd_type = "' . $data['s_type'] . '",';
    $update .= 'asset_hdd_size = "' . $data['s_size'] . '",';
    $update .= 'asset_mem = "' . $data['mem'] . '",';
    $update .= 'asset_static_ip = "' . $data['ip'] . '",';
    $update .= 'asset_wlan_mac = "' . $data['wlan'] . '",';
    $update .= 'asset_lan_mac = "' . $data['lan'] . '",';
    $update .= 'asset_sped_tag = "' . $data['sped'] . '",';
    $update .= 'asset_bios_password = "' . $data['bios'] . '",';
    $update .= 'asset_date = (STR_TO_DATE("' . $data['date'] . '", "%Y-%m-%d")),';
    $update .= 'asset_price ="' . $data['price'] . '" ';
    $update .= 'WHERE asset_tag = ' . $rowID . ';';

    // echo $update;
    mysqli_query($link, $update);

    $updated_row = "";

    if($rowID == $data['id']) {
        $updated_row = 'SELECT * FROM assets WHERE asset_tag = '. $data['row'];     
    } else {
        $updated_row = 'SELECT * FROM assets WHERE asset_tag = '. $data['id'];     
    }

    $result = mysqli_query($link, $updated_row);

    $resultData = $result->fetch_assoc();

    echo json_encode($resultData);
?>