<?php
$URL = "../../developers/index.php";
$conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");
$article_id = $_GET['article'];
$sql = "SELECT * FROM article LEFT JOIN user_info ON article.user_code = user_info.id WHERE article.article_id = '$article_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if (!$row['user_id']) {
    ?>

    <script>
    console.log(1);
    alert("잘못된 접근입니다.");
    location.replace("<?php echo $URL?>");
    </script>

    <?php

} else if (!isset($_SESSION['userid'])) {
    ?>
    <script>
        console.log(2);

        alert("잘못된 접근입니다.");
        location.replace("<?php echo $URL?>");
    </script>
    <?php
} else if (!isset($_GET['article'])) {
    ?>
    <script>
        console.log(3);

        alert("잘못된 접근입니다.");
        location.replace("<?php echo $URL?>");
    </script>
    <?php


}else if ($_SESSION['userid'] == $row['user_id']) {

    $nickname = $row['nickname'];
    $title = $row['title'];
    $content = $row['content'];
    $hashtag = $row['hashtag'];
    $id = $row['id'];


} else {
    ?>
    <script>
        console.log(4);

        alert("잘못된 접근입니다.");
        location.replace("<?php echo $URL?>//");
        //    </script>

    <?php
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/index_style.css">


    <style>
        #creating_form {
            margin-top: 20px;
        }
    </style>

    <title> Community </title>


</head>


<body>

<!--container-->
<div class="container" id="container">


    <!--grid-->
    <div id="grid">

        <!--btn list-->
        <div class="row">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-home-list"
                   href="../../developers/developers.php?menu=community">All</a>
                <a class="list-group-item list-group-item-action active" id="list-profile-list"
                   href="../../developers/developers.php?menu=talktalk">Talk Talk</a>
                <a class="list-group-item list-group-item-action active" id="list-messages-list"
                   href="../../developers/developers.php?menu=joboversees">해외취업 정보</a>
            </div>
            <!--list end-->
        </div>


        <!--grid 오른쪽-->
        <div>

            <!--contents title-->
            <div class="create_edit_title">
                <h1 >수정 하기</h1>
            </div>

            <form id="creating_form" method="POST" action="../../developers/contents/edit_action.php?article=<?=$article_id?>"
                  style="margin-right: 20px; margin-left: 20px;">
                <div class="form-group">
                    <input type="hidden" class="form-control" name="id" value=<?= $id ?>>
                    <p><?= $nickname ?></p>
                </div>

                <div class="form-group">
                    <select class="form-control" name="category">
                        <option>게시판을 선택해 주세요.</option>
                        <option>Talk Talk</option>
                        <option>해외 취업 정보</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="title" value="<?=$title?>" >
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="tags" value="<?=$hashtag?>">
                </div>
                <div class="form-group">

                    <textarea class="form-control" rows="12" name="content"><?=$content?></textarea>
                </div>


                <div class="form-group col-xs-4">

                    <button class="btn btn-default float-left"><a href="#"> 취소</a></button>
                    <button type="submit" class="btn btn-info float-right">수정</button>
                </div>

            </form>

        </div>

        <!--grid end-->
    </div>


    <!--container end-->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
</body>
</html>
