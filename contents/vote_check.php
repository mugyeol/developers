<?php
//header('Content-Type : text/html; charset = utf-8');
$conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");
$request_body = file_get_contents('php://input');
$vote = json_decode(stripcslashes($request_body),true);
$vote_user_code = $vote['user_code'];
//echo $vote_user_code ;
$article_id_voted = $vote['article_id'];
$vote_updown = $vote['vote_updown'];
//$vote_total = $vote['vote_total'];


$sql = "SELECT vote_updown FROM voting WHERE article_id_voted ='$article_id_voted' and vote_user_code = '$vote_user_code'";
$result = mysqli_query($conn,$sql);
$row_isvoted = mysqli_fetch_array($result);


if(!empty($row_isvoted)){
    $sql  = "UPDATE voting set vote_updown = '$vote_updown' WHERE article_id_voted ='$article_id_voted' and vote_user_code = '$vote_user_code'";
    $result = mysqli_query($conn,$sql);

    if ($result){
        $sql = "SELECT vote_id FROM voting WHERE article_id_voted= '$article_id_voted' and vote_updown = 1";
        $result = mysqli_query($conn,$sql);
        $num_up = mysqli_num_rows($result);
        $sql = "SELECT vote_id FROM voting WHERE article_id_voted= '$article_id_voted' and vote_updown = 2";
        $result = mysqli_query($conn,$sql);
        $num_down = mysqli_num_rows($result);
        $vote_total = $num_up-$num_down;

        $sql = "UPDATE article set votecount = '$vote_total' WHERE article_id = '$article_id_voted'";
        $result = mysqli_query($conn, $sql);
        echo $vote_total;


    }

}else{
$sql  = "INSERT INTO voting (article_id_voted, vote_user_code, vote_updown) values ('$article_id_voted', '$vote_user_code', '$vote_updown')";
$result = mysqli_query($conn,$sql);


if ($result){
    $sql = "SELECT vote_id FROM voting WHERE article_id_voted= '$article_id_voted' and vote_updown = 1";
    $result = mysqli_query($conn,$sql);
    $num_up = mysqli_num_rows($result);
    $sql = "SELECT vote_id FROM voting WHERE article_id_voted= '$article_id_voted' and vote_updown = 2";
    $result = mysqli_query($conn,$sql);
    $num_down = mysqli_num_rows($result);
    $vote_total = $num_up-$num_down;

    $sql = "UPDATE article set votecount = '$vote_total' WHERE article_id = '$article_id_voted'";
    $result = mysqli_query($conn, $sql);
    echo $vote_total;


}


}

?>