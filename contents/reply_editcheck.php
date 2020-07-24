<?php
//header('Content-Type : text/html; charset = utf-8');
$conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");
$request_body = file_get_contents('php://input');
$OBJcontent = json_decode(stripcslashes($request_body),true);
$reply_id = $OBJcontent['reply_id'];
$replycontent= $OBJcontent['content'];


$sql = "UPDATE reply SET reply_content = '$replycontent' WHERE reply_id = $reply_id";
$result = mysqli_query($conn,$sql);
if ($result){
    echo $replycontent;

}

?>