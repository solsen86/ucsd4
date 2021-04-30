<?php 

require_once './config.php';

if(isset($_POST["submit"])) {
    $filename = $_FILES["filename"]["tmp_name"];

    if($_FILES["filename"]["size"] > 0) {
        
        // open the file
        $file = fopen($filename, "r");
        $csv_rows[] = array();

        // read each row of the csv file into the csv_rows[] array
        While (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $bldg = "";
            if (isset($column[0])) {
                $bldg = mysqli_real_escape_string($link, $column[0]);
            } 
            $room = "";
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
            $model = "";
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
     
            // add row values to array to send to generate insert statements. 
            $csv_rows[] = array(
                "bldg" => $bldg,
                "room" => $room,
                "loc" => $loc,
                "user" => $user,
                "name" => $name,
                "tag" => $tag,
                "type" => $type,
                "make" => $make,
                "model" => $model,
                "sn" => $sn,
                "os" => $os,
                "cpu" => $cpu,
                "s_type" => $s_type,
                "s_size" => $s_size,
                "mem" => $mem,
                "ip" => $ip,
                "w_mac" => $w_mac,
                "l_mac" => $l_mac,
                "d_purchase" => $d_purchase,
                "d_checkout" => $d_checkout,
                "d_checkin" => $d_checkin,
                "status" => $status,
                "price" => $price,
                "sped" => $sped
            );
        }

        $insert_stmts = array();
        $number_inserted = 0;

        // convert each csv row into a multi query insert statementk
        for($i = 1; $i < count($csv_rows); $i++ ) {
            $insert_rooms = "";
            $insert_rooms = "";
            $insert_rooms = "";
            $insert_rooms = "";

        }
        
    }
}

?>