
<?php
$conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");





$URL = "../../developers/index.php";
if(!isset($_SESSION['userid'])) {
    ?>

    <script>
        alert("로그인이 필요합니다");
        location.replace("<?php echo $URL?>");
    </script>
    <?php
}else{
    $user_id = $_SESSION['userid'];


    $sql = "SELECT * FROM user_info WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    //user index값. 작명 잘못함 user_index로 하는게 좋았을듯.
    $id = $row['id'];
    $nickname = $row['nickname'];
}

?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/index_style.css">


    <style>
        #creating_form{
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
                   href="../../developers/developers.php?menu=community&submenu=talktalk">Talk Talk</a>
                <a class="list-group-item list-group-item-action active" id="list-messages-list"
                   href="../../developers/developers.php?&menu=community&submenu=talktalk">해외취업 정보</a>
            </div>
            <!--list end-->
        </div>


        <!--grid 오른쪽-->
        <div>

            <!--contents title-->
            <div class="create_edit_title">
            <h1>새 글 쓰기</h1>
            </div>

        <form id="creating_form" method = "POST" action = "../../developers/contents/create_action.php" style="margin-right: 20px; margin-left: 20px;">
            <div class="form-group">
                <input type="hidden" class="form-control" name="id" value=<?=$id?>><p><?=$nickname?></p>
            </div>

            <div class="form-group">
            <select class="form-control" name="category">
                <option>게시판을 선택해 주세요.</option>
                <option>Talk Talk</option>
                <option>해외 취업 정보</option>
            </select>
            </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="title" placeholder="제목">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="tags" placeholder="Tags,">
                </div>
            <div class="form-group">

            <textarea class="form-control" rows="12" name="content"></textarea>
            </div>


            <div class="form-group col-xs-4 create_btngroup" >

                <button class="btn btn-default float-left" id="cancel"><a href="#"> 취소</a></button>
                <button type="submit" class="btn btn-info float-right" >제출</button>
            </div>
<script>
    var cancel = document.getElementById('cancel');
    cancel.onclick = function () {
        history.back();
    }

</script>
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
