<?php
session_start();

$id = $_POST['id'];
$pw = $_POST['pw'];

$conn=mysqli_connect("localhost","root","ehfrhfo12","mugyeolDB");

$sql = "SELECT * FROM user_info WHERE user_id='$id'";
$result=mysqli_query($conn,$sql);


if($result->num_rows==1){
    $row=$result->fetch_array(MYSQLI_ASSOC); //하나의 열을 배열로 가져오기
    // print_r($row);
    if($row['user_pw']==$pw){  //MYSQLI_ASSOC 필드명으로 첨자 가능
        $_SESSION['userid']=$id;           //로그인 성공 시 세션 변수 만들기
        if(isset($_SESSION['userid']))    //세션 변수가 참일 때
        {
            header('Location: ../index.php');   //로그인 성공 시 페이지 이동
        }
        else{
            ?>
            <script>

                alert("알 수 없는 오류가 발생 하였습니다. 다시 시도해 주세요.");
                history.back();
            </script>
        <?php        }
    }
    else{
        ?>
        <script>

            alert("아이디 혹은 비밀번호가 틀렸습니다");
            history.back();
        </script>
        <?php
    }
}

else{
?>
<script>

    alert("아이디 혹은 비밀번호가 틀렸습니다");
    history.back();
</script>
<?php
}
?>