<?php
$conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");
//echo  $_POST['reply_id'];
if (isset($_POST['article_id_replied'])){
 $article_id = $_POST['article_id_replied'];
    if (isset($_POST['reply_id'])){
            $reply_id = $_POST['reply_id'];
            $sql = "DELETE FROM reply WHERE reply_id = '$reply_id'";
            $result = mysqli_query($conn, $sql);

        if ($result) {
            $sql = "select reply_id from reply where article_id_replied =  '$article_id'";
            $result = mysqli_query($conn, $sql);
            $reply_numrows = mysqli_num_rows($result);
            if (isset($reply_numrows)) {

                $sql = "update article set replycount = '$reply_numrows' where article_id = '$article_id'";
                $result = mysqli_query($conn, $sql);
                if ($result) {


        ?>

        <script>
            alert("댓글이 삭제 되었습니다");
            location.replace("../../developers/developers.php?menu=read&index=<?=$article_id?>");
        </script>

        <?php
                }

            }

        }

    }


}
?>















