<?php
header("Location: index.php"); 
function getConnection() {
    // $user = "root";
    // $password = "";
    // $dbName = "ridobiko";
    $user = "id15883152_radha";
  $password = "Intelradha@19";
  $dbName = "id15883152_ridobiko";
    $connection = mysqli_connect('localhost',$user,$password,$dbName);
    if(!$connection) {
        die('could not connect to database');
    }
    return $connection;
}
function saveUser() {
    $customer_name = $_REQUEST['customer_name'];
    $customer_mobile = $_REQUEST["customer_mobile"];
    $customer_address = $_REQUEST['customer_address'];
    $customer_ano = $_REQUEST['customer_ano'];
    $customer_adar_front_ext = getExtension('customer_adar_front');
    uploadImg('customer_adar_front',$customer_ano.'adr_front');
    $customer_profile_img_ext = getExtension('customer_profile_img');
    uploadImg('customer_profile_img',$customer_ano.'profile');
    $customer_adar_back_ext = getExtension('customer_adar_back');
    uploadImg('customer_adar_back',$customer_ano.'adr_back');
    $license_no = $_REQUEST['license_no'];
    $customer_license_img_ext = getExtension('customer_license_img');
    uploadImg('customer_license_img',$license_no.'license');
    $exp_date = $_REQUEST['exp_date'];
    $connection = getConnection();
    $query = "INSERT INTO user (user_name, user_mobile, addr, adhar_no, adhar_front, adhar_back, 
    profile_img, license_no, license_img, license_exp_date) 
    VALUES('$customer_name','$customer_mobile','$customer_address','$customer_ano',
    '$customer_adar_front_ext','$customer_adar_back_ext','$customer_profile_img_ext',
    '$license_no','$customer_license_img_ext','$exp_date')";
    if($resultSet = mysqli_query($connection, $query)) {
        mysqli_close($connection);
        return $resultSet;
    }
    else {
        die('could not connect to database');
    }

}
function getExtension($form_name) {
    $temp = explode(".", $_FILES[$form_name]["name"]);
    return end($temp);
}

function uploadImg($form_name,$fname){
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Check if file was uploaded without errors
        if(isset($_FILES[$form_name]) && $_FILES[$form_name]["error"] == 0){
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $_FILES[$form_name]["name"];
            $filetype = $_FILES[$form_name]["type"];
            $filesize = $_FILES[$form_name]["size"];
        
            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
        
            // Verify file size - 5MB maximum
            $maxsize = 5 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
        
            // Verify MYME type of the file
            if(in_array($filetype, $allowed)){
                // Check whether file exists before uploading it
                if(file_exists("upload/" . $filename)){
                    echo $filename . " is already exists.";
                } else{
                    $temp = explode(".", $_FILES[$form_name]["name"]);
                    $newfilename = $fname . '.' . end($temp);
                    move_uploaded_file($_FILES[$form_name]["tmp_name"], "upload/" . $newfilename);
                } 
            } else{
                echo "Error: There was a problem uploading your file. Please try again."; 
            }
        } else{
            echo "Error: " . $_FILES[$form_name]["error"];
        }

    }
}
saveUser();

?> 