<?php

//category column에 들어갈 변수 & 페이지 상단 & 좌축 버튼 리스트에 들어갈 변수 선언.
$vote_count = 0;
$mainmenu = "Community";
$submenu_talk = "Talk Talk";
$submenu_joboverseas = "해외 취업 정보";
$menutitle = '';
$control_commnitybtn = '';
$control_talktalkbtn = '';
$control_joboverseasbtn = '';
$conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");


$article_id = $_GET['index'];
$sql = "SELECT * FROM article LEFT JOIN user_info ON article.user_code = user_info.id WHERE article.article_id = '$article_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

//현재 로그인 된 유저 정보 -> 댓글 작성 용.
if (isset($_SESSION['userid'])){
$currentUserID = $_SESSION['userid'];
$sql_getcurrentUser = "SELECT nickname,id FROM user_info WHERE user_id = '$currentUserID'";
$result_getcurrentUser = mysqli_query($conn, $sql_getcurrentUser);
$row_getcurrentUser = mysqli_fetch_array($result_getcurrentUser);
$currentUserNICKNAME = $row['nickname'];
}

//조회수 쿠키 체크 -> developers.php 파일에 있음 html header 위에 있어야되서

//reply 정보 +유저
$sql_reply = "SELECT * FROM reply LEFT JOIN user_info ON reply.reply_user_code = user_info.id WHERE article_id_replied = '$article_id'";
$result_reply = mysqli_query($conn, $sql_reply);
$num_reply = mysqli_num_rows($result_reply);


    //vote 했는지 안했는지
    if (isset($_SESSION['userid'])){

        $currentUserCode = $row_getcurrentUser['id'];

        $sql_vote = "SELECT vote_updown from voting where article_id_voted = '$article_id' and vote_user_code = '$currentUserCode'";
        $result_vote = mysqli_query($conn,$sql_vote);
        if($result_vote){
        $row_vote = mysqli_fetch_array($result_vote);
        $voted = $row_vote['vote_updown'];
        //$downvoted = $row_vote['vote_down'];
        //echo $upvoted;
        if ($voted==1){
            $upvote_classctl = 'btn-primary';
            $upvote_disabled = '';
            $tooltip_upvote = '추천 취소';
            $downvote_disabled = 'disabled';
            $downvote_classctl = 'btn-default';
            $tooltip_downvote = '';

        }else if ($voted == 2){
            $tooltip_upvote = '';
            $upvote_classctl = 'btn-default';
            $upvote_disabled = 'disabled';
            $downvote_disabled = '';
            $downvote_classctl = 'btn-warning';
            $tooltip_downvote = '반대 취소';

        }else {
            $upvote_classctl = 'btn-default';
            $upvote_disabled = '';
            $downvote_disabled = '';
            $downvote_classctl = 'btn-default';
            $tooltip_upvote = '추천';
            $tooltip_downvote = '반대';

          }

        }

    }else {
        $upvote_classctl = 'btn-default';
        $upvote_disabled = 'disabled';
        $downvote_disabled = 'disabled';
        $downvote_classctl = 'btn-default';
        $tooltip_upvote = '로그인이 필요 합니다';
        $tooltip_downvote = '로그인이 필요 합니다';
    }





$category = $row['category'];
if ($category==$submenu_talk){
    $category_from = "talktalk";
    $control_talktalkbtn = 'active';
}else if($category==$submenu_joboverseas){
    $category_from = "joboverseas";
    $control_joboverseasbtn = 'active';


}







//print_r($result);
//$tag = '';


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../developers/css/bootstrap.css">
    <link rel="stylesheet" href="../../developers/css/index_style.css">
    <script src="../../developers/js/myjavascript.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <style>


    </style>
    <title> Community </title>
</head>


<body>

<!--container-->
<div class="container" >


    <!--좌(메뉴 버튼) 우(본문) 그리드 -->
    <div id="view_grid">

        <!--메뉴 버튼-->
        <div class="view_row">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action " id="list-home-list"
                   href="../../developers/developers.php?menu=community"><?= $mainmenu ?></a>
                <a class="list-group-item list-group-item-action <?=$control_talktalkbtn?>" id="list-profile-list"
                   href="../../developers/developers.php?menu=community&submenu=talktalk"><?= $submenu_talk ?></a>
                <a class="list-group-item list-group-item-action <?=$control_joboverseasbtn?>" id="list-messages-list"
                   href="../../developers/developers.php?menu=community&submenu=joboverseas"><?= $submenu_joboverseas ?></a>
            </div>
            <!--메뉴 버튼 끝-->
        </div>

        <!-- 우측-->
        <div>

<!--            우측 최상단부터 글 내용까지-->
            <div class="view_from_rightheader_to_content">

                <!--            우측 최상단(타이틀 +  글쓰기 버튼)-->
            <div class="view_wrapper" id="view_titlecreate">
                <div class="view_userinfo">
                <div class="view_prof">
                    <span class=""><img src="images/profile_64.png" alt=""/></span>
                </div>
                <div class="view_id">
                    <p class="view_id_tag"><a href="../../developers/developers.php?menu=userpage&id=<?=$row['id']?>"><?=$row['nickname']?></a> </p>
                </div>
        <div class="view_date">
                    <p> <?=$row['date']?></p>
        </div>



                </div>



            <div class="view_title_btn">
                <div class="view_my_headtitle">
                    <h1><?=$row['title']?></h1>
                </div>

                <div class="view_mycreatebtn">
                    <div>
                    <img src="../../developers/images/view.png"><dr style="color: #1c7430;"><?=$row['hit']?></dr>
                    </div>
                    <div>
                        <img src="../../developers/images/reply.png"><dr style="color: #1c7430;"><?=$row['replycount']?></dr>
                    </div>
                    <div class="view_edit_delete">

                        <?php
                        if (isset($_SESSION['userid'])){
                        if($row['user_id']==$_SESSION['userid']){
                            ?>

                        <button type="submit" class=" btn btn-info ">
                            <a class="view_edit_delete_btn" href="../../developers/developers.php?menu=edit&article=<?=$row['article_id']?>">
                                                           수정</a></button>

                        <form class="view_edit_delete_form" method="POST" action="../../developers/contents/delete_action.php">
                                                            <input type="hidden" name="article_id" value="<?=$row['article_id']?>">
                                                            <input type="hidden" name="from" value="<?=$category_from?>">
                                                            <button  type="submit" class=" btn btn-danger view_edit_delete_btn">
                                                                삭제</button>
                                                        </form>



                            <?php
                        }
                        }
                        ?>



                    </div>
                </div>
        </div>
                <!--우측 최상단, 타이틀 & 글쓰기 버튼 끝-->
            </div>



                <div class="view_contents_like">
                <div class="view_contents">

                    <h3>
                        <?=$row['content']?>
                    </h3>


                </div>

                <div class="view_like_section sticky-top">
                    <div id="grid_upvote">
                    <button  title= '<?= $tooltip_upvote?>' data-toggle="tooltip" id="upvote" class="btn <?=$upvote_classctl?>" <?=$upvote_disabled?>> 추천</button>


                        <!--                        <img src="../../developers/images/up.png" alt=""/>-->
                    </div>
                    <div id="grid_votecount">
                    <p id="likegroup_count"  ><?=$row['votecount']?></p>
                    </div>
                    <div id="grid_downvote">
                        <button title= '<?= $tooltip_downvote?>' data-toggle="tooltip"    class="btn <?=$downvote_classctl?>"  id="downvote" <?=$downvote_disabled?>> 반대</button>

                    </div>


                </div>

                    <script type="text/javascript">

                        var upvote = document.getElementById("upvote");
                        var downvote = document.getElementById("downvote");
                        // var count = document.getElementById('likegroup_count');
                        upvote.onclick = function () {



                            if (upvote.classList.contains('btn-default')) {
                                upvote.classList.remove('btn-default');
                                upvote.classList.add('btn-primary');
                                // downvote.classList.remove('btn-default');
                                downvote.setAttribute('disabled', '');

                                var vote = new Object();
                                vote.user_code = <?=$row_getcurrentUser['id']?>;
                                vote.article_id = <?=$row['article_id']?>;
                                vote.vote_updown = 1;
                                var JSONvote = JSON.stringify(vote);

                                $(document).ready(function () {
                                    jQuery.ajax({
                                            type: "POST",
                                            url: "../../developers/contents/vote_check.php",
                                            // contentType : 'application/json; charset = UTF-8',
                                            // dataType : 'json',
                                            data: JSONvote,
                                            success: function (data) {
                                                $('#likegroup_count').text(data);
                                                var a = upvote.getAttribute('title');
                                                if (a === "추천") {
                                                    upvote.setAttribute('title', '추천 취소');
                                                }
                                            }, error: function (xhr, status, error) {
                                                alert(error);
                                            }
                                        }
                                    )
                                })
                            } else if (upvote.classList.contains('btn-primary')) {
                                upvote.classList.remove('btn-primary');
                                upvote.classList.add('btn-default');
                                // downvote.classList.remove('btn-default');
                                downvote.removeAttribute('disabled');


                                var vote = new Object();
                                vote.user_code = <?=$row_getcurrentUser['id']?>;
                                vote.article_id = <?=$row['article_id']?>;
                                vote.vote_updown = 0;
                                var JSONvote = JSON.stringify(vote);

                                $(document).ready(function () {
                                    jQuery.ajax({
                                            type: "POST",
                                            url: "../../developers/contents/vote_check.php",
                                            // contentType : 'application/json; charset = UTF-8',
                                            // dataType : 'json',
                                            data: JSONvote,
                                            success: function (data) {
                                                $('#likegroup_count').text(data);
                                                var a = upvote.getAttribute('title');
                                                if (a === "추천 취소") {
                                                    upvote.setAttribute('title', '추천');
                                                }

                                            }, error: function (xhr, status, error) {
                                                alert(error);
                                            }


                                        }
                                    )
                                })
                            }
                        }

                        //반대
                        downvote.onclick = function () {
                            if (downvote.classList.contains('btn-default')){
                                downvote.classList.remove('btn-default');
                                downvote.classList.add('btn-warning');
                                // downvote.classList.remove('btn-default');
                                upvote.setAttribute('disabled','');

                                var vote = new Object();
                                vote.user_code = <?=$row_getcurrentUser['id']?>;
                                vote.article_id = <?=$row['article_id']?>;
                                vote.vote_updown = 2;
                                var JSONvote = JSON.stringify(vote);

                                $(document).ready(function () {
                                    jQuery.ajax({
                                            type : "POST",
                                            url : "../../developers/contents/vote_check.php",
                                            // contentType : 'application/json; charset = UTF-8',
                                            // dataType : 'json',
                                            data : JSONvote,
                                            success:function (data) {
                                                $('#likegroup_count').text(data);
                                                var a = downvote.getAttribute('title');
                                                if (a==="반대"){
                                                    downvote.setAttribute('title','반대 취소');
                                                }

                                            },error : function (xhr,status,error) {
                                                alert(error);
                                            }
                                        }
                                    )
                                })
                            }
                            //반대 취소
                            else if (downvote.classList.contains('btn-warning')){
                                downvote.classList.remove('btn-warning');
                                downvote.classList.add('btn-default');
                                upvote.removeAttribute('disabled');

                                var vote = new Object();
                                vote.user_code = <?=$row_getcurrentUser['id']?>;
                                vote.article_id = <?=$row['article_id']?>;
                                vote.vote_updown = 0;
                                var JSONvote = JSON.stringify(vote);

                                $(document).ready(function () {
                                    jQuery.ajax({
                                            type : "POST",
                                            url : "../../developers/contents/vote_check.php",
                                            data : JSONvote,
                                            success:function (data) {
                                                $('#likegroup_count').text(data);
                                                var a = downvote.getAttribute('title');
                                                if (a==="반대 취소"){
                                                    downvote.setAttribute('title','반대');
                                                }

                                            },error : function (xhr,status,error) {
                                                alert(error);
                                            }
                                        }
                                    )
                                })
                            }
                        }
                    </script>


                </div>
        </div>

<!--        댓글 header-->
                <div class="view_reply_header_group">
                        <h3 class="view_reply_header">댓글</h3>
                    <h3 class="view_reply_header"><?=$row['replycount']?></h3>
                    <!--        댓글 header-->

                </div>

<!--                생성된 댓글-->
                <?php
                if (!$row['replycount']==0){

               while ($row_reply = mysqli_fetch_array($result_reply)){
                ?>
                <div  class="view_reply_userinfo_content">
                    <div class="view_reply_prof">
                        <span class=""><img src="images/profile_64.png" alt=""/></span>
                    </div>
                    <div class="view_reply_id">
                        <p class="view_id_tag"><a href="../../developers/developers.php?menu=userpage&id=<?=$row_reply['reply_user_code']?>"><?=$row_reply['nickname']?></a> </p>
                    </div>
                    <div class="view_reply_date">
                        <p> <?=$row_reply['reply_date']?></p>
                    </div>
                    <div class="view_reply_editdelete text-right">
                        <?php
                        if (isset($_SESSION['userid'])){
                            if($row_reply['user_id']==$_SESSION['userid']){
                                ?>

                                <input type="button" class=" btn btn-info " onclick="editing(this, this.id)" id="<?=$row_reply['reply_id']?>" value="수정">


                                <form class="view_edit_delete_form" method="POST" action="../../developers/contents/reply_delete_action.php">
                                    <input type="hidden" id ="reply_id"  name="reply_id" value="<?=$row_reply['reply_id']?>">
                                    <input type="hidden" name="article_id_replied" value="<?=$row_reply['article_id_replied']?>">
                                    <input  type="submit" id="delete_reply_<?=$row_reply['reply_id']?>" class=" btn btn-danger view_edit_delete_btn" value="삭제">
                                </form>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="view_reply_contents" style="position: relative; width: 100%; ">

<!--                        <input type="text" style="border:0;" id="replycontent_--><?//=$row_reply['reply_id']?><!--" value="--><?//=$row_reply['reply_content']?><!--"  readonly>-->
                        <div id="replycontent_<?=$row_reply['reply_id']?>" ><?=$row_reply['reply_content']?></div>
                    </div>


<div>
<!--                    <div class="view_reply_like_section sticky-top">-->
<!--                        <a href="#" id="reply_upvote" style="text-decoration: none;">-->
<!--                            ▲-->
<!--                            <!--                            <img src="../../developers/images/up_48.png" alt=""> -->
<!--                        </a>-->
<!--                        <p id="reply_likegroup_count" >--><?//=$vote_count?><!--</p>-->
<!--                        <a href="#" id="reply_downvote" style="text-decoration: none;">-->
<!--                            ▼-->
<!---->
<!---->
<!--                            <!--                            <img src="../../developers/images/down_48.png" alt=""/>-->
<!--                        </a>-->
<!--                    </div>-->

                    <!--                생성된 댓글 끝-->
</div>
                </div>
                   <?php
                       }
                }
                ?>
            <script>

                <?php
                if($num_reply>0){

                ?>

                function editing(self, btnid) {

                    var deletebtn = document.getElementById("delete_reply_".concat(btnid));

                    if(self.value === "수정"){
                        self.value = '완료';

                        deletebtn.setAttribute('type','hidden');
                        var contentID = "#replycontent_".concat(btnid);
                        var contentID_tag = "replycontent_".concat(btnid);
                        var contentvalue = $(contentID).text();
                        $(contentID).replaceWith($('<textarea id='+contentID_tag+' type = "text" rows="4" class = "form-control">'+contentvalue+'</textarea>'));
                }
                else if(self.value === "완료"){


                        var contentID = "#replycontent_".concat(btnid);
                        var contentID_tag = "replycontent_".concat(btnid);

                        console.log(contentID);

                        var contentvalue =$(contentID).val();
                        console.log(contentvalue);
                        var OBJcontent = new Object();
                        OBJcontent.reply_id= btnid;
                        OBJcontent.content = contentvalue;
                        var jsonreplycontent = JSON.stringify(OBJcontent);

                        $(document).ready(function () {

                            jQuery.ajax({
                                type : "POST",
                                url : "../../developers/contents/reply_editcheck.php",
                                data : jsonreplycontent,
                                success:function (data) {
                                    $(contentID).replaceWith($('<div id='+contentID_tag+'>'+data+'</div>'));
                                    // $('#contentID').text(data);

                                    self.value = '수정';
                                    deletebtn.setAttribute('type','submit');



                                },error : function (xhr,status,error) {
                                    alert(error);
                                }




                            })
                        })
                    }
                    }

                <?php


                }
                ?>



            </script>



            <!--댓글 생성-->
            <?php
            if (isset($_SESSION['userid'])){
            ?>
                <form  method="post" action="../../developers/contents/create_reply_action.php" class="view_create_reply_wrapper">
                    <div class="view_reply_prof">
                        <span class=""><img src="images/profile_64.png" alt=""/></span>
                    </div>
                    <div class="view_reply_create_id">
                        <input type="hidden" class="form-control" name="id" value=<?=$row_getcurrentUser['id']?>>

                        <p ><a href="../../developers/developers.php?menu=userpage&id=<?=$row_getcurrentUser['id']?>"><?=$row_getcurrentUser['nickname']?></a> </p>
                    </div>
                    <!--                    <div class="view_reply_date">-->
                    <!--                        <p> </p>-->
                    <!--                    </div>-->


                    <div class="view_reply_creating">


                        <div class="form-group">
                            <textarea class="form-control" name="content" rows="7"> </textarea>
                        </div>


                    </div>

                    <div class="view_reply_createbtn text-center form-group">
                        <input class="form-control" type="hidden" name="article_id" value=<?=$article_id?>>
                        <button type="submit" class=" btn btn-warning">

                            등록</button>
                    </div>

                    <!--댓글 생성 끝-->
                </form>


                <?php
            }else {
                ?>
            <div class="needlogin" style="margin-bottom: 100px">

                <a href="../../developers/index.php">로그인</a> 후에 댓글을 작성 하실 수 있습니다.
            </div>
            <?php
            }
            ?>


<!--                댓글 파트-->




            <!-- 우측 끝-->
        </div>


        <!--좌(메뉴 버튼) 우(본문) 그리드 끝-->
    </div>


    <!--container end-->
</div>


<script type="text/javascript" src="../../developers/js/bootstrap.js"></script>
</body>
</html>
