<?php 

require_once './config.php';

if(isset($_POST["submit"])) {
    
    $file = str_replace('\\', '/', $_FILES['file']['tmp_name']);

    if($_FILES["file"]["size"] > 0) {
        // insert columns 1 & 2 into the rooms table if not exist
        $insert_rooms = 'LOAD DATA INFILE "'.$file.'" IGNORE
                         INTO TABLE rooms
                         FIELDS TERMINATED BY ","
                         LINES TERMINATED BY "\n"
                         IGNORE 1 LINES
                         (@column1,@column2)
                         SET building_id = (SELECT buildings.building_id FROM buildings WHERE buildings.building_code = @column1), room_number = @column2;';
        
        if($res = mysqli_query($link, $insert_rooms)) {
            echo $res . '- rooms<br>';
        } else { 
            die (mysqli_error($link));
        }
        

        // insert column 8 into brands table if it does not already exist
        $insert_brands = 'LOAD DATA INFILE "'.$file.'" IGNORE
                          INTO TABLE brands
                          FIELDS TERMINATED BY ","
                          LINES TERMINATED BY "\n"
                          IGNORE 1 LINES
                          (@column1, @column2, @column3, @column4, @column5, @column6, @column7, @column8)
                          SET brand_name = @column8;';

        if($res = mysqli_query($link, $insert_brands)) {
            echo $res . ' - brands<br>';
        } else { 
            die (mysqli_error($link));
        }

        // insert column 9 into models table if it does not already exist
        $insert_models = 'LOAD DATA INFILE "'.$file.'" IGNORE
                        INTO TABLE models
                        FIELDS 
                            TERMINATED BY ","
                        LINES TERMINATED BY "\n"
                        IGNORE 1 LINES
                        (@column1, @column2, @column3, @column4, @column5, @column6, @column7, @column8, @column9)
                        SET brand_id = (SELECT brand_id FROM brands WHERE brand_name = @column8), model_name = @column9;';

        if($res = mysqli_query($link, $insert_models)) {
            echo $res . '- models<br>';
        } else { 
            die (mysqli_error($link));
        }

        // insert data into assets table
        $insert_assets = 'LOAD DATA INFILE "'.$file.'" IGNORE
                        INTO TABLE assets
                        FIELDS 
                            TERMINATED BY ","
                        LINES TERMINATED BY "\n"
                        IGNORE 1 LINES
                        (@column1, @column2, @column3, @column4, @column5, @column6, @column7, @column8, @column9, 
                        @column10, @column11, @column12, @column13, @column14, @column15, @column16, @column17,
                        @column18, @column19, @column20, @column21, @column22, @column23, @column24)
                        SET asset_tag = @column6, asset_location = @column3, asset_name = @column5, asset_serial = @column10,
                        model_id = (SELECT model_id FROM models WHERE model_name = @column9), 
                        room_id = (SELECT room_id FROM rooms WHERE room_number = @column2), 
                        status_id = (SELECT status_id FROM dev_status WHERE status_name = @column22),
                        dev_type_id = (SELECT dev_type_id FROM dev_types
                        WHERE dev_type = @column7), os_id = (SELECT os_id FROM systems WHERE os_name = @column11), 
                        asset_cpu = @column12, asset_hdd_type = @column13, asset_hdd_size = @column14, 
                        asset_mem = @column15, asset_static_ip = @column16, asset_wlan_mac = @column17, 
                        asset_lan_mac = @column18, asset_sped_tag = NULLIF(@column24, ""), asset_bios_password = NULL, 
                        asset_date = (STR_TO_DATE(@column19,\'%m/%d/%Y\')), asset_price = @column23;';

        if($res = mysqli_query($link, $insert_assets)) {
            echo $res . ' - assets<br>';
        } else { 
            die (mysqli_error($link));
        }

        
    }   else {
        echo 0;
    }
}
?>