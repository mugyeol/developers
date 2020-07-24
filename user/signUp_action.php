<?php

$user_id=$_POST['user_id'];
$pw=$_POST['pw'];
$pwc=$_POST['pwc'];
$name=$_POST['name'];
$nickname = $_POST['nickname'];
$email=$_POST['email'];
if($user_id==NULL || $pw==NULL || $name==NULL || $nickname==NULL||$email==NULL  ) //
{
    ?>
    <script>
        alert("빈 칸을 모두 채워주세요");
        history.back();


    </script>


    <?php
    exit();

}
if($pw!=$pwc) //비밀번호와 비밀번호 확인 문자열이 맞지 않을 경우
{
    ?>
    <script>
        alert("비밀번호가 맞지 않습니다");
        history.back();


    </script>


    <?php
    exit();
}


$conn=mysqli_connect("localhost","root","ehfrhfo12","mugyeolDB");


$sql="SELECT *from user_info WHERE user_id='$user_id'";
$result=mysqli_query($conn,$sql);
if($result->num_rows==1)
{
    ?>
    <script>
        alert("중복된 아이디 입니다");
        history.back();


    </script>


    <?php
    exit();

}


$signup=mysqli_query($conn,"
INSERT INTO user_info (user_id, user_pw, name,nickname, email)
VALUES ('$user_id','$pw','$name','$nickname','$email')
");

if($signup){
    // echo "sign up success";

    header ('Location: ../../developers/index.php');
    // header("Location : main.php");
}else {
  error_log(mysqli_error($conn));
}

?>
