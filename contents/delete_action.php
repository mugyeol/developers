<?php
$conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");
if (isset($_POST['from'])) {
    $category_from = $_POST['from'];
    if (isset($_POST['article_id'])) {
        $article_id =$_POST['article_id'];
        $sql = "DELETE FROM article WHERE article_id = '$article_id'";
        $result = mysqli_query($conn, $sql);
        if ($result){
            $sql = "DELETE FROM reply WHERE article_id_replied = '$article_id'";
            $result = mysqli_query($conn,$sql);
        }
?>

<script>
    alert("게시물이 삭제 되었습니다");
location.replace("../../developers/developers.php?menu=community&submenu=<?=$category_from?>");
</script>


<?php
    }


}







?>










</script>












