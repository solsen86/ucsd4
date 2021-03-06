<?php
include_once '../config/config.php';

$rows = array();
$total = 0;


$sql = "SELECT buildings.building_code, rooms.room_number, dev_types.dev_type, assets.asset_tag,
    assets.asset_name, assets.asset_location, brands.brand_name, models.model_name, assets.asset_serial, systems.os_name,
    assets.asset_cpu, assets.asset_hdd_type, assets.asset_hdd_size, assets.asset_mem, 
    assets.asset_wlan_mac, assets.asset_lan_mac, assets.asset_static_ip, assets.asset_bios_password,
    assets.asset_sped_tag, assets.asset_date, assets.asset_price,
    dev_status.status_name
FROM assets
    LEFT JOIN rooms ON rooms.room_id = assets.room_id
    LEFT JOIN buildings ON buildings.building_id = rooms.building_id
    LEFT JOIN models ON models.model_id = assets.model_id
    LEFT JOIN brands ON brands.brand_id = models.brand_id
    LEFT JOIN dev_status ON dev_status.status_id = assets.status_id
    LEFT JOIN dev_types ON dev_types.dev_type_id = assets.dev_type_id
    LEFT JOIN systems ON systems.os_id = assets.os_id
ORDER BY assets.asset_tag ASC, buildings.building_code, rooms.room_number";

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0) {
        
        while($row = mysqli_fetch_array($result)){
            $building_code = $row['building_code'];
            $room_number = $row['room_number'];
            $asset_location = $row['asset_location'];
            $dev_type = $row['dev_type'];
            $asset_tag = $row['asset_tag'];
            $asset_name = $row['asset_name'];
            $brand_name = $row['brand_name'];
            $model_name = $row['model_name'];
            $asset_serial = $row['asset_serial'];
            $os_name = $row['os_name'];
            if($os_name == null) {
                $os = "";
            } else {
                $os = $os_name;
            }
            $asset_cpu = $row['asset_cpu'];
            $asset_hdd_type = $row['asset_hdd_type'];
            $asset_hdd_size = $row['asset_hdd_size'];
            $asset_mem = $row['asset_mem'];
            $asset_wlan_mac = $row['asset_wlan_mac'];
            $asset_lan_mac = $row['asset_lan_mac'];
            $asset_static_ip = $row['asset_static_ip'];
            $asset_bios_password = $row['asset_bios_password'];
            $asset_sped_tag = $row['asset_sped_tag'];
            $asset_date  = date_create($row['asset_date']);
            $purchase_date = $asset_date->format("Y-m-d");
            $asset_age = date_diff($asset_date, date_create(date('Y-m-d')))->format('%y');
            $asset_price = $row['asset_price'];
            if($asset_price != "") {
                $price = "$" . $asset_price;
            } else {
                $price = null;
            }

            $status_name = $row['status_name'];

            $rows[] = array(
                "bldg" => $building_code,
                "room" => $room_number,
                "loc" => $asset_location,
                "type" => $dev_type,
                "id" => $asset_tag,
                "name" => $asset_name,
                "brand" => $brand_name,
                "model" => $model_name,
                "sn" => $asset_serial,
                "os" => $os,
                "cpu" => $asset_cpu,
                "s_type" => $asset_hdd_type,
                "s_size" => $asset_hdd_size,
                "mem" => $asset_mem,
                "wlan" => $asset_wlan_mac,
                "lan" => $asset_lan_mac,
                "ip" => $asset_static_ip,
                "bios" => $asset_bios_password,
                "sped" => $asset_sped_tag,
                "date" => $purchase_date,
                "age" => $asset_age,
                "price" => $price,
                "status" => $status_name,
            );

            $total++;
        }

        // Free result
        mysqli_free_result($result);
    } 
} else {
    $rows[] = array(
        "building" => '',
        "room" => '',
        "location" => '',
        "type" => '',
        "id" => '',
        "name" => '',
        "brand" => '',
        "model" => '',
        "serial" => '',
        "os" => '',
        "cpu" => '',
        "hdd_type" => '',
        "hdd_size" => '',
        "mem" => '',
        "wlan" => '',
        "lan" => '',
        "ip" => '',
        "bios" => '',
        "sped" => '',
        "date" => '',
        "age" => '',
        "price" => '',
        "status" => ''
    );
}

// close connection
mysqli_close($link);

$json_array = array(
    "total" => $total,
    "data" => $rows
);

// return JSON string
echo json_encode($json_array);
?>