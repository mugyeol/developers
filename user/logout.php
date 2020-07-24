<?php
session_start();
if (isset($_SESSION['userid'])){
    unset($_SESSION['userid']);

    header('Location: ../developers.php'); // 로그아웃 성공 시 로그인 페이지로 이동

}



//$res=session_destroy(); //모든 세션 변수 지우기
//if($res){
//    header('Location: ../index.php'); // 로그아웃 성공 시 로그인 페이지로 이동
//}
?>
