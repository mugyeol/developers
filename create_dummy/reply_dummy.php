<?php
//
//$conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");
//$date = date('Y-m-d H:i:s');            //Date
//
//
//
//for ($i = 1; $i<200; $i++){
//    include '../../developers/create_dummy/info_for_dummy.php';
//
//
//    $reply_content = '댓글';
//    $user_code = $ran_user;
//    $article_id =$ran_article_id;
//
//
//    $sql = "INSERT INTO reply (article_id_replied, reply_content, reply_user_code,reply_date)
//        VALUES ('$article_id', '$reply_content$i', '$user_code','$date')";
//    $result = mysqli_query($conn, $sql);
//    if ($result) {
//        $sql = "select reply_id from reply where article_id_replied = '$article_id'";
//        $result = mysqli_query($conn, $sql);
//        $reply_numrows = mysqli_num_rows($result);
//        if (isset($reply_numrows)){
//
//            $sql = "update article set replycount = $reply_numrows where article_id = '$article_id'";
//            $result = mysqli_query($conn,$sql);
//            if ($result){
//                header('Location: ../../developers/developers.php?menu=read&index=' . $article_id . '');   //로그인 성공 시 페이지 이동}
//
//
//
//            }
//        }
//
//
//
//    }
//
//}
//
//
//?>