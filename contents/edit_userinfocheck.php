<?php
/**
 * Created by PhpStorm.
 * User: htpad
 * Date: 2018-12-02
 * Time: 오전 7:24
 */
$conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");

$id = $_GET['id'];
$sql = "select user_pw from user_info where id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$nickname = $_POST['nickname'];
$email=$_POST['email'];
//$cpw=$_POST['cpw'];
//$npw=$_POST['npw'];
//$cnpw=$_POST['cnpw'];


$url = " ../../developers/developers.php?menu=userpage&id=".$id;


//if( $cpw==NULL || $npw==NULL ||$cnpw==NULL  || $nickname==NULL||$email==NULL  ) //
if($nickname==NULL||$email==NULL  ) //
{
    ?>
    <script>
        alert("빈 칸을 모두 채워 주세요");
        history.back();
    </script>
    <?php
    exit();


//else if ($cpw != $row['user_pw'] || $npw!=$cnpw){
//    ?>
<!--    <script>-->
<!--        alert("비밀번호가 틀렸습니다.");-->
<!--        history.back();-->
<!--    </script>-->
<!--    -->
<?php
//    exit();
//}
}



else{

    $conn=mysqli_connect("localhost","root","ehfrhfo12","mugyeolDB");
//    $sql=" UPDATE user_info set user_pw ='$npw', nickname='$nickname', email='$email' where id = '$id'";
    $sql=" UPDATE user_info set nickname='$nickname', email='$email' where id = '$id'";

    $signup=mysqli_query($conn,$sql);
    if($signup){
        // echo "sign up success";
        ?>
        <script>
            alert("정보 수정이 완료 되었습니다.");
            location.replace('<?php echo $url?>');
        </script>
        <?php
        exit();

    }else {
        ?>
        <script>
            alert("알 수 없는 에러가 발생 하였습니다. 다시 시도 해주세요.");
            location.replace('<?php echo $url?>');
        </script>
        <?php
        error_log(mysqli_error($conn));
        exit();
    }




}

?>
