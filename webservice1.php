<?php

$search_area = $_POST["area"];
$search_catg = $_POST["category"];

if(isset($_POST["area"]) && isset($_POST["category"])){
    //echo $search_area;
    //echo $search_catg;
    if( $search_area !="" || $search_catg !=""){
// Connect to database
$host = "localhost";
$dbuser = "id20140230_sucharya";
$dbpassword = "gfe79atmrUijJ7$";
$dbname = "id20140230_findadoctor";

$conn = new mysqli($host, $dbuser, $dbpassword, $dbname);

$sql = "SELECT ID, DoctorName, DoctorExperience, DoctorImage, DoctorArea, DoctorCategory from doctor where DoctorArea like '%".$search_area."%' and DoctorCategory like '%".$search_catg."%'";

$result = $conn->query($sql);

if($result->num_rows > 0){
    $data = '<b class="simple-steps-for">Doctors found in your area</b>';
    $doctor_data = "";

    while($row = $result->fetch_assoc()){
        $doctorid = $row["ID"];
        $doctorname = $row["DoctorName"];
        $doctorexp = $row["DoctorExperience"];
        $doctorcat = $row["DoctorCategory"];
        $doctorimage = $row["DoctorImage"];
        $doctorarea = $row["DoctorArea"];

        $doctor_data =  $doctor_data.'<div class="rectangle-parent">
        <div class="group-child"></div>
        <b class="specialist-doctor">'.$doctorname.'</b>
        <div class="for-far-away1">
        '.$doctorarea.'
        </div>
        <img class="icons8-medical-doctor-80-1" alt="" src="'.$doctorimage.'" />
      </div>';

        
    }
  
} else{
    $data = '<b class="simple-steps-for">No doctor found near you!</b>';
    
}
    } else {
        $data = '<b class="simple-steps-for">Enter location & specialization!</b>';
    }
// Sening response back to the request
//echo json_encode($data);
}else{
    $data = '<b class="simple-steps-for">Bad Query</b>';
}
$data = $data.$doctor_data;
echo $data;



?>