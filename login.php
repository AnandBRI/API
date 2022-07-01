<?php

include_once("./config/config.php");
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: PUT, GET, POST");
// header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


$data = array();
$user_details = array();

$non_validated = array(input($_REQUEST['loginUser']),input($_REQUEST['loginPass']));
$validated = array();


if(empty($non_validated[0])){
    // $data['user']="No mobile number found";
    // $data['status']=false;
    // echo json_encode($data);
    // exit();
    echo "No mobile number found.";
    exit();
}else{
    array_push($validated,$non_validated[0]);
}

if(empty($non_validated[1])){
    // $data['user']="No password found";
    // $data['status']=false;
    // echo json_encode($data);
    // exit();
    echo "No password found.";
    exit();
}else{
    array_push($validated,$non_validated[1]);
}

if(!empty($validated[0]) && !empty($validated[1])){
    $sql = "SELECT `id`,`name`,`phone`,`password`,`coin`,`score` FROM `cutie`.`game_user` WHERE `phone`=:phone AND `password`=:password  ORDER BY `id` DESC LIMIT 1";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':phone',$validated[0]);
    $stmt->bindParam(':password',$validated[1]);
    $stmt->execute();
    $rowCount = $stmt->rowCount();

    if($rowCount>=1){
        $row = $stmt->fetch();
        $user_details['id']=$row['id'];
        $user_details['name']=$row['name'];
        $user_details['phone']=$row['phone'];
        $user_details['password']=$row['password'];
        $user_details['coin']=$row['coin'];
        $user_details['score']=$row['score'];
        $user_details['status']=true;
        
        $data['user']=$user_details;
        $data['status']=true;
        echo json_encode($data);
        exit();
        /* echo "Login success.";
        exit() */;
    }else{
        // $data['user']="Something went wrong";
        // $data['status']=false;
        // echo json_encode($data);
        // exit();
        echo "Login failed.";
        exit();
    }
}else{
    // $data['user']="Something went wrong";
    // $data['status']=false;
    // echo json_encode($data);
    // exit();
    echo "Something went wrong.";
    exit();
}
?>