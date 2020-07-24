<?php

//category column에 들어갈 변수 & 페이지 상단 & 좌축 버튼 리스트에 들어갈 변수 선언.
$mainmenu = "All";
$submenu_talk = "Talk Talk";
$submenu_joboverseas = "해외 취업 정보";
$menutitle = '';
$control_commnitybtn = '';
$control_talktalkbtn = '';
$control_joboverseasbtn = '';
$conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");







//FOR PAGINATION
if (!isset($_GET['submenu'])) {
    $sql_numrows ="SELECT article_id FROM article"; //article id 조회 //submenu 는 where명령어 추가

} else if ($_GET['submenu'] == "talktalk") {
    $sql_numrows ="SELECT article_id FROM article WHERE article.category = '$submenu_talk'"; //article id 조회 //submenu 는 where명령어 추가


} else if ($_GET['submenu'] == "joboverseas") {

    $sql_numrows ="SELECT article_id FROM article WHERE article.category = '$submenu_joboverseas'"; //article id 조회 //submenu 는 where명령어 추가

}


if (isset($_GET['submenu'])){
    $submenuLink = "&submenu=".$_GET['submenu'];


}else {
    $submenuLink = '';
}






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
$orderby='';
if(!isset($_GET['desc'])){
    $orderby = "ORDER BY article_id DESC";
    $passorder = '';
}else if ($_GET['desc']=="view"){
    $orderby = "ORDER BY hit DESC";
    $passorder = "&desc=view";

}else if ($_GET['desc']=="liked"){
    $passorder = "&desc=liked";
    $orderby = "ORDER BY votecount DESC";

}else if ($_GET['desc']=="reply"){
    $passorder = "&desc=reply";
    $orderby = "ORDER BY replycount DESC";

}

//LIST DATA
if (!isset($_GET['submenu'])) {
    $control_commnitybtn = 'active';
    $menutitle = $mainmenu;
    $SELF_URL = "../../developers/developers.php?menu=community";//뒤에 페이지 넘버 붙여주기. 첫페이지는 url에 page값 없음.

    $sql = "SELECT * FROM article LEFT JOIN user_info ON article.user_code = user_info.id $orderby LIMIT $s_point,$list";
} else if ($_GET['submenu'] == "talktalk") {
    $control_talktalkbtn = 'active';
    $SELF_URL = "../../developers/developers.php?menu=community&submenu=talktalk";//뒤에 페이지 넘버 붙여주기. 첫페이지는 url에 page값 없음.

    $menutitle = $submenu_talk;
    $sql = "SELECT * FROM article LEFT JOIN user_info ON article.user_code = user_info.id WHERE article.category = '$submenu_talk' $orderby LIMIT $s_point,$list";

} else if ($_GET['submenu'] == "joboverseas") {
    $control_joboverseasbtn = 'active';
    $SELF_URL = "../../developers/developers.php?menu=community&submenu=joboverseas";//뒤에 페이지 넘버 붙여주기. 첫페이지는 url에 page값 없음.

    $menutitle = $submenu_joboverseas;
    $sql = "SELECT * FROM article LEFT JOIN user_info ON article.user_code = user_info.id WHERE article.category = '$submenu_joboverseas' $orderby LIMIT $s_point,$list";

}
$result = mysqli_query($conn, $sql);
//$num = mysqli_num_rows($result); //페이지 당 데이터 수 -> 최대 10개 -> 데이터 불러오기 위해서 필요.


//print_r($result);
//$tag = '';


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../developers/css/bootstrap.css">
    <link rel="stylesheet" href="../../developers/css/index_style.css">
    <style>


    </style>
    <title> Community </title>
</head>


<body>

<!--container-->
<div class="container" id="container">


    <!--좌(메뉴 버튼) 우(본문) 그리드 -->
    <div id="grid">

        <!--메뉴 버튼-->
        <div class="row">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action <?= $control_commnitybtn ?>" id="list-home-list"
                   href="../../developers/developers.php?menu=community"><?= $mainmenu ?></a>
                <a class="list-group-item list-group-item-action <?= $control_talktalkbtn ?>" id="list-profile-list"
                   href="../../developers/developers.php?menu=community&submenu=talktalk"><?= $submenu_talk ?></a>
                <a class="list-group-item list-group-item-action <?= $control_joboverseasbtn ?>" id="list-messages-list"
                   href="../../developers/developers.php?menu=community&submenu=joboverseas"><?= $submenu_joboverseas ?></a>
            </div>
            <!--메뉴 버튼 끝-->
        </div>

        <!-- 우측-->
        <div class="div_for_tag">

            <div class="right_side">

            <!--우측 최상단, 타이틀-->
            <div class="wrapper_title_writebtn">

                <div class="my_headtitle">
                    <h1><a id="contents_title" href="../../developers/developers.php?menu=community<?=$submenuLink?>"><?= $menutitle ?></a></h1>
                </div>

                <div class="mycreatebtn">
                    <button type="button" class=" btn btn-warning">
                        <a href="../../developers/developers.php?menu=create"
                           style="text-decoration: none; color: black"> 새 글 쓰기</a></button>
                </div>

                <div class="mysortbtns btn-group " role="group" aria-label="First group">
                    <button type="button" class="btn btn-default "><a class="sortbtnslink" style="text-decoration: none; color: black;" href="../../developers/developers.php?menu=community<?=$submenuLink?>">최신순</a> </button>
                    <button type="button" class="btn btn-info "><a class="sortbtnslink" style="text-decoration: none; color: white;"  href="../../developers/developers.php?menu=community<?=$submenuLink?>&desc=view">조회순</a> </button>
                    <button type="button" class="btn btn-primary">
                        <a class="sortbtnslink" style="text-decoration: none; color: white;" href="../../developers/developers.php?menu=community<?=$submenuLink?>&desc=liked">추천순</a>
                    </button>
                    <button type="button" class="btn btn-danger"><a class="sortbtnslink" style="text-decoration: none; color: white;" href="../../developers/developers.php?menu=community<?=$submenuLink?>&desc=reply">댓글순</a> </button>
                </div>


                <div class="my_searchbar" role="group">

<!--                    <form class="form-inline float-right ">-->
<!--                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">-->
<!--                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
<!--                    </form>-->
                </div>


            </div>


            <!--테이블 시작-->
            <?php


//            for ($i = 1; $i <= $num; $i++) {
//            $row = mysqli_fetch_array($real_data);
//            ?>
<!---->
<!---->
<!---->
<!--            --><?php
//            if ($row == false) {
//                exit;
//            }
//            }
//            for ($i = 1; $i <= $num; $i++) {
            while ($row = mysqli_fetch_array($result)) {
//                $row = mysqli_fetch_array($result);
                $tag='';
                $tag_link = '';
                //isset으로 하면 빈 버튼 만들어짐. 바꾸지 말것.

                //해쉬 태그 쪼개기
                if (!$row['hashtag'] == "") {
                    $tagString = $row['hashtag'];
                    $tagArray = explode(',',$tagString);
                    for ($t=0; $t<sizeof($tagArray); $t++){
                        $tag_link = $tag_link."<a href=\"../../developers/developers.php?menu=tags&which={$tagArray[$t]}\">";
                        $tag = $tag . $tag_link."<button class=\"btn btn-info btn-xs\" id=\"taglabel\" >{$tagArray[$t]}</button>";
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
                    <div class="box1-1"><?=$row['hit']?></div>
                    <div class="box2-1"><?=$row['votecount']?></div>
                    <div class="box3-1"><?=$row['replycount']?></div>

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
                    <div class="name"><a href="../../developers/developers.php?menu=userpage&id=<?=$row['id']?>"><?= $row['nickname'] ?></a> </div>
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
                        <a class="page-link" href="<?= $SELF_URL.$passorder ?>&page=<?= $s_page - 1 ?>" tabindex="-1">Previous</a>
                    </li>



                    <?php
                    //첫번째 블록일 경우
                    if ($s_page==1){
?>
                        <!--                    첫번째 페이지는 PAGE링크 없이-->
                        <li class="page-item"><a class="page-link" href="<?= $SELF_URL.$passorder ?>">1</a></li>

                    <?php
                        if ($e_page>=2) {
                            for ($p = $s_page + 1; $p <= $e_page; $p++) {
                                ?>
                                <!--        페이지 링크 생성-->
                                <li class="page-item"><a class="page-link" href="<?= $SELF_URL.$passorder ?>&page=<?= $p ?>"><?= $p ?></a></li>
                                <?php
                            }
                        }
                    }
                    //두번째 블록부터

                    else{

                        for ($p = $s_page ; $p <= $e_page; $p++) {
                            ?>
                            <!--        페이지 링크 생성-->
                            <li class="page-item"><a class="page-link" href="<?= $SELF_URL.$passorder ?>&page=<?= $p ?>"><?= $p ?></a></li>
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
                    if ($pageNum==$e_page){
                        ?>
                    <li class="page-item disabled">



                        <?php
                    }else{
?>
                            <li class="page-item">
<?php
                        }
                    ?>


                        <a class="page-link" href="<?= $SELF_URL.$passorder ?>&page=<?= $e_page + 1 ?>">Next</a>
                    </li>
                </ul>

<!--                페이징 끝-->
            </nav>


            <!-- 우측 끝-->
        </div>


        <!--grid end-->
    </div>


    <!--container end-->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="../../developers/js/bootstrap.js"></script>
</body>
</html>
