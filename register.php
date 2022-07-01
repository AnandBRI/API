<?php
include_once("./config/config.php");
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: PUT, GET, POST");
// header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$data = array();
$user_details = array();

$non_validated = array(input($_REQUEST['regName']),input($_REQUEST['regPhone']),input($_REQUEST['regPass']));
$validated = array();


if(empty($non_validated[0])){
    // $data['user']="No user name found";
    // $data['status']=false;
    // echo json_encode($data);
    // exit();
    echo "No user name found.";
    exit();
}else{
    array_push($validated,$non_validated[0]);
}

if(empty($non_validated[1])){
    // $data['user']="No phone number found";
    // $data['status']=false;
    // echo json_encode($data);
    // exit();
    echo "No phone number found.";
    exit();
}else{
    array_push($validated,$non_validated[1]);
}

if(empty($non_validated[2])){
    // $data['user']="No pass found";
    // $data['status']=false;
    // echo json_encode($data);
    // exit();
    echo "No pass found.";
    exit();
}else{
    array_push($validated,$non_validated[2]);
}

if(!empty($validated[0]) && !empty($validated[1]) && !empty($validated[2])){
    $sql = "INSERT INTO `game_user`(`name`, `phone`, `password`) VALUES (:name,:phone,:password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name',$validated[0]);
    $stmt->bindParam(':phone',$validated[1]);
    $stmt->bindParam(':password',$validated[2]);
    $result=$stmt->execute();

    if($result){
        // $last_id=$conn->lastInsertId();
        // $sql1="SELECT * FROM `game_user` WHERE id=:id";
        // $stmt1= $conn->prepare($sql1);
        // $stmt1->bindParam(':id',$last_id);
        // $stmt1->execute();
        // $row2=$stmt1->fetch();
        // $user_details['id']=$row2['id'];
        // $user_details['name']=$row2['name'];
        // $user_details['phone']=$row2['phone'];
        // $user_details['password']=$row2['password'];
        // $user_details['coin']=$row2['coin'];
        // $user_details['status']=$row2['status'];
        
        // $data['user']=$user_details;
        // $data['status']=true;
        // echo json_encode($data);
        // exit();
        echo "register successful.";
        exit();
    }else{
        // $data['user']="Something went wrong";
        // $data['status']=false;
        // echo json_encode($data);
        // exit();
        echo "registration failed.";
        exit();
    }
}else{
    // $data['user']="Something went wrong";
    // $data['status']=false;
    // echo json_encode($data);
    // exit();
    echo "something went wrong.";
    exit();
}
?>