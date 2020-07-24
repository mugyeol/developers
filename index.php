<?php
session_start();
if(!isset($_SESSION['userid'])) //세션이 존재하지 않을 때
{
    header ('Location: ../developers/user/login.html');

}else{
  header ('Location: developers.php');


}



?>
