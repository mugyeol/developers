<?php
$mainmenu = "All";
$submenu_talk = "Talk Talk";
$submenu_joboverseas = "해외 취업 정보";
//if (isset($_SESSION['userid'])){
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $url = "/developers/developers.php?menu=userpage&id=" . $id . "&sub=";
    $conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");
    $sql = "select * from user_info where id = $id";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);
    $imglink = $row['user_pic'];


//FOR PAGINATION
    if (!isset($_GET['sub'])) {
        $sql_numrows = "SELECT article_id FROM article where user_code = $id"; //article id 조회 //submenu 는 where명령어 추가

    } else if ($_GET['sub'] == "up") {
        $sql_numrows = "SELECT article_id FROM article LEFT JOIN voting ON article.article_id = voting.article_id_voted where user_code = $id and voting.vote_updown=1";


    } else if ($_GET['sub'] == "down") {

        $sql_numrows = "SELECT article_id FROM article LEFT JOIN voting ON article.article_id = voting.article_id_voted where user_code = $id and voting.vote_updown=2";

    }else if ($_GET['sub'] == "onlyme") {


    } else{
        $sql_numrows = "SELECT article_id FROM article where user_code = $id"; //article id 조회 //submenu 는 where명령어 추가

    }

if (!isset($_GET['sub']) || $_GET['sub']!="onlyme"){
    $data = mysqli_query($conn, $sql_numrows);
    $total_numrows = mysqli_num_rows($data); // 각 카테고리 총 데이터 수 -->페이지 갯수 파악 위해서 필요.
    if (!isset($_GET['page'])) {
        $page = 1; //블록 계산 위해서 (page no. 1인 url 은 없음.)

    } else if (isset($_GET['page'])) {
        $page = $_GET['page']; //page 2부터

    }

    $list = 10; //한 페이지당 데이터
    $block = 3; // 한 블록 당 버튼 수

    $s_point = ($page - 1) * $list; // start point // page 1 일 경우 0 // 2일 경우 10 //

    $pageNum = ceil($total_numrows / $list); // 총 페이지 //NUM 35일 경우 4
    $blockNum = ceil($pageNum / $block); // 총 블록 //NUM 35일 경우 2
    $nowBlock = ceil($page / $block); //현재 블록 //NUM 35일 경우 & 현재 페이지 4일 경우 1.XX -> 2

    $s_page = ($nowBlock * $block) - 2;  // NUM 35일 경우 2X3 -2 -> 4
    if ($s_page <= 1) {
        $s_page = 1;
    }
    $e_page = $nowBlock * $block; // NUM 35일 경우 2X3 -2 -> 6


    if ($pageNum <= $e_page) {
        $e_page = $pageNum;

    }


//order by
//    $orderby = '';
//    if (!isset($_GET['desc'])) {
//        $orderby = "ORDER BY article_id DESC";
//    } else if ($_GET['desc'] == "view") {
//        $orderby = "ORDER BY hit DESC";
//
//    } else if ($_GET['desc'] == "liked") {
//        $orderby = "ORDER BY votecount DESC";
//
//    } else if ($_GET['desc'] == "reply") {
//        $orderby = "ORDER BY replycount DESC";
//
//    }


    if (!isset($_GET['sub'])) {
        $sql = "SELECT * FROM article LEFT JOIN user_info ON article.user_code = user_info.id where article.user_code = $id  LIMIT $s_point,$list";
        $SELF_URL =$url.'';

    } else if ($_GET['sub'] == "up") {
        $sql = "SELECT * FROM article RIGHT JOIN user_info ON article.user_code = user_info.id  LEFT JOIN voting ON article.article_id = voting.article_id_voted where voting.vote_user_code = $id and voting.vote_updown=1 LIMIT $s_point,$list";
        $SELF_URL =$url.'up';


    } else if ($_GET['sub'] == "down") {
        $sql = "SELECT * FROM article RIGHT JOIN user_info ON article.user_code = user_info.id  LEFT JOIN voting ON article.article_id = voting.article_id_voted where voting.vote_user_code = $id and voting.vote_updown=2 LIMIT $s_point,$list";
        $SELF_URL =$url.'down';


    } else if ($_GET['sub'] == "onlyme") {


    }else {

        $sql = "SELECT * FROM article LEFT JOIN user_info ON article.user_code = user_info.id where article.user_code = $id  LIMIT $s_point,$list";
        $SELF_URL =$url.'';

    }

        $result = mysqli_query($conn, $sql);

}

}


else {
    ?>

    <script>
        alert("잘못된 접근입니다.");
        location.replace("../../developers/developers.php");
    </script>

    <?php
}


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../developers/css/bootstrap.css">
    <link rel="stylesheet" href="../../developers/css/index_style.css">
    <style>


    </style>
    <script src="../../developers/imagerotate/js/load-image.all.min.js"></script>
    <title> Community </title>
</head>


<body>

<div class="user_container">
    <div class="user_panel">
        <div class="userpage_profile">
            <form action="../../developers/contents/update_profileimg.php?editid=<?= $id ?>" id="form" method="POST"
                  enctype="multipart/form-data">


                <?php
                    if (isset($_SESSION['userid'])){
                        if ($row['user_id']==$_SESSION['userid']){    //현재 로그인 한 사용자 = 본인

                            ?>
                            <div style="height: 0px; overflow: hidden">
                                <input type="file" id="file" name="user_image"/>
                            </div>

                            <?php
                            //프로필 있는 상태
                            if (!empty($imglink)) {
                                ?>
                                <img id="hasimage" style="margin-left: 100px;padding: 0; border-radius: 100%" width="128"
                                     height="128" class="btn" onclick="chooseFile()"
                                     src="../../developers/user_images/<?= $imglink ?>">
                                <?php

                                //프로필 없는 상태
                            } else {
                                ?>
                                <img id="hashimage2" style="margin-left: 100px;padding: 0; border-radius: 100%" width="128" height="128" class="btn"
                                     onclick="chooseFile()" src="../../developers/images/profile_128.png">

                                <?php
                            }

                        }

                        //현재 로그인 한 사용자 != 본인
                        else{
                            ?>
                                 <div style="height: 0px; overflow: hidden">
                                <input type="file" id="file" name="user_image"/>
                            </div>
<?php
                            if (!empty($imglink)) {
                                ?>


                                <img id="hasimage" style="margin-left: 100px;padding: 0; border-radius: 100%" width="128"
                                     height="128"
                                     src="../../developers/user_images/<?= $imglink ?>">
                                <?php
                            } else {
                                ?>
                                <img  style="margin-left: 100px;padding: 0; border-radius: 100%" width="128" height="128"
                                      src="../../developers/images/profile_128.png">

                                <?php
                            }




                        }
                    }
                    //로그인 한 사용자 없음.
                    else{
                        ?>
                        <div style="height: 0px; overflow: hidden">
                            <input type="file" id="file" name="user_image"/>
                        </div>
                        <?php
                        if (!empty($imglink)) {
                            ?>


                            <img id="hasimage" style="margin-left: 100px;padding: 0; border-radius: 100%" width="128"
                                 height="128"
                                 src="../../developers/user_images/<?= $imglink ?>">
                            <?php
                        } else {
                            ?>
                            <img  style="margin-left: 100px;padding: 0; border-radius: 100%" width="128" height="128"
                                  src="../../developers/images/profile_128.png">

                            <?php
                        }

//                    }
                }
                ?>

                <script>

                    function chooseFile() {
                        $("#file").click();
                    }

                    //이미지 선택시 -> form submmit 자동 실행.
                    document.getElementById("file").onchange = function () {
                        document.getElementById("form").submit();
                    };

                </script>

                <!--</button>-->
            </form>


        </div>
        <div class="user_nickname">
            <h3 style="display: inline;"><?= $row['nickname'] ?></h3>
            <p style="margin-bottom: 0"><?= $row['email'] ?></p>
        </div>
        <div class="userpage_btngroup">
            <button class="btn btn-success">
                <a href="<?= $url ?>" style="text-decoration: none; color: white;">
                    작성 한 게시물</a></button>
            <button class="btn btn-success">
                <a href="<?= $url ?>up" style="text-decoration: none; color: white;">

                    추천 한 게시물</a></button>
            <button class="btn btn-success">
                <a href="<?= $url ?>down" style="text-decoration: none; color: white;">

                    반대 한 게시물</a></button>

<?php
            if (isset($_SESSION['userid'])){
                //로그인 사용자 = 본인 -> 정보수정 버튼 visible
if ($row['user_id'] == $_SESSION['userid']){
?>


    <button class="btn btn-success">
        <a href="<?= $url ?>onlyme" style="text-decoration: none; color: white;">
            정보 수정</a></button>


    <?php
                        }
                        }
                        ?>

        </div>

    </div>
<?php
if (!isset($_GET['sub']) || $_GET['sub']!="onlyme"){
?>
    <!--    ///게시물-->
    <div class="div_for_tag">

        <div class="right_side">
            <?php

            while ($row = mysqli_fetch_array($result)) {
//                $row = mysqli_fetch_array($result);
                $tag = '';
                $tag_link = '';
                //isset으로 하면 빈 버튼 만들어짐. 바꾸지 말것.

                //해쉬 태그 쪼개기
                if (!$row['hashtag'] == "") {
                    $tagString = $row['hashtag'];
                    $tagArray = explode(',', $tagString);
                    for ($t = 0; $t < sizeof($tagArray); $t++) {
                        $tag_link = $tag_link . "<a href=\"../../developers/developers.php?menu=tags&which={$tagArray[$t]}\">";
                        $tag = $tag . $tag_link . "<button class=\"btn btn-info btn-xs\" id=\"taglabel\" >{$tagArray[$t]}</button>";
                    }
                }


                //category 칼럼에 들어가는 category 명이랑 get으로 넘기는 값이 달라서 맞춰줘야함. (비효율적..)
                if ($row['category'] == $submenu_talk) {
                    $category = "talktalk";
                } else if ($row['category'] == $submenu_joboverseas) {
                    $category = "joboverseas";
                }


                ?>
                <!--테이블 레이아웃-->
                <div class="wrapper">
                    <div class="box1-1"><?= $row['hit'] ?></div>
                    <div class="box2-1"><?= $row['votecount'] ?></div>
                    <div class="box3-1"><?= $row['replycount'] ?></div>

                    <div class="box1">views</div>
                    <div class="box2">votes</div>
                    <div class="box3">answers</div>
                    <div class="title ">
                        <a href="../../developers/developers.php?menu=read&index=<?= $row['article_id'] ?>"><?= $row['title'] ?></a>
                    </div>
                    <div class="tag">
                        <button class="btn btn-warning btn-xs" id="taglabel">
                            <a href="../../developers/developers.php?menu=community&submenu=<?= $category ?>">
                                <?= $row['category'] ?></a></button>
                        <?= $tag ?>
                        </a>

                    </div>
                    <div class="name"><a
                                href="../../developers/developers.php?menu=userpage&id=<?= $row['id'] ?>"><?= $row['nickname'] ?></a>
                    </div>
                    <div class="date"><?= $row['date'] ?></div>

                    <!--테이블 레이아웃 끝-->
                </div>


                <?php

                if ($row == false) {
                    exit;
                }

            }
            //                테이블 끝
            ?>
        </div>

        <!--페이징-->
        <nav class="my_paging">
            <ul class="pagination pagination-lg justify-content-center ">

                <!--            //현재 1블록에 있으면 previous 버튼 disable-->
                <?php
                if ($s_page <= 1){
                ?>
            <li class="page-item disabled">
            <?php
            }else{
            ?>
                <li class="page-item">
                    <?php
                    }
                    ?>
                    <!--                        S_PAGE 1보다 작을 경우 DISABLE-->
                    <a class="page-link" href="<?= $SELF_URL ?>&page=<?= $s_page - 1 ?>" tabindex="-1">Previous</a>
                </li>


                <?php
                //첫번째 블록일 경우
                if ($s_page == 1) {
                    ?>
                    <!--                    첫번째 페이지는 PAGE링크 없이-->
                    <li class="page-item"><a class="page-link" href="<?= $SELF_URL ?>">1</a></li>

                    <?php
                    if ($e_page >= 2) {
                        for ($p = $s_page + 1; $p <= $e_page; $p++) {
                            ?>
                            <!--        페이지 링크 생성-->
                            <li class="page-item"><a class="page-link"
                                                     href="<?= $SELF_URL ?>&page=<?= $p ?>"><?= $p ?></a></li>
                            <?php
                        }
                    }
                } //두번째 블록부터

                else {

                    for ($p = $s_page; $p <= $e_page; $p++) {
                        ?>
                        <!--        페이지 링크 생성-->
                        <li class="page-item"><a class="page-link" href="<?= $SELF_URL ?>&page=<?= $p ?>"><?= $p ?></a>
                        </li>
                        <?php
                    }


                }

                ?>


                <!--                    --><?php
                //                    echo "<p>spage$s_page</p>";
                //                    echo "<p>epage$e_page</p>";
                //
                //                    첫번째 블록일 경우
                //
                //                    ?>
                <!--                        블락 생성-->

                <?php
                if ($pageNum == $e_page){
                ?>
                <li class="page-item disabled">


                    <?php
                    }else{
                    ?>
                <li class="page-item">
                    <?php
                    }
                    ?>


                    <a class="page-link" href="<?= $SELF_URL ?>&page=<?= $e_page + 1 ?>">Next</a>
                </li>
            </ul>

            <!--                페이징 끝-->
        </nav>


        <!-- 우측 끝-->
    </div>
    <?php
    }else if ($_GET['sub']=="onlyme") {
    ?>

    <?php
    if (isset($_SESSION['userid'])) {
        if ($row['user_id'] == $_SESSION['userid']) {
            ?>

            <!--        유저 정보 수정-->
            <div class="edit_userinfo">
                <form id="creating_form" class="userinfo_editform" method="POST"
                      action="../../developers/contents/edit_userinfocheck.php?id= <?= $row['id'] ?>
    " style="margin-right: 20px; margin-left: 20px;">

                    <div class="form-group">
                        <h5>아이디</h5>
                        <input type="text" class="form-control" name="email" value="<?= $row['user_id'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <h5>이메일</h5>
                        <input type="text" class="form-control" name="email" value="<?= $row['email'] ?>">
                    </div>
                    <div class="form-group">
                        <h5>닉네임</h5>
                        <input type="text" class="form-control" name="nickname" value="<?= $row['nickname'] ?>">
                    </div>



<!--                    <h5>비밀번호</h5>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <input type="password" class="form-control" name="cpw" placeholder="현재 비밀번호">-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <input type="password" class="form-control" name="npw" placeholder="새 비밀번호">-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <input type="password" class="form-control" name="cnpw" placeholder="새 비밀번호 확인">-->
<!--                    </div>-->


                    <div class="form-group col-xs-4 create_btngroup">

                        <!--                <button class="btn btn-default float-left"  ><a href="#"> 취소</a></button>-->
                        <button type="submit" class="btn btn-info float-right">수정</button>
                    </div>

                </form>
            </div>

            <?php
        }else{
            ?>

            <script>
                alert("잘못된 접근입니다.")
                history.back();
            </script>
    <?php
        }
    }
}
    ?>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="../../developers/js/bootstrap.js"></script>
</body>
</html>
