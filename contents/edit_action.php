    <?php
    $conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");
    $category = $_POST['category'];
    $title = $_POST['title'];                  //Title
    $content = $_POST['content'];              //Content


    $article_id = $_GET['article']; //int값
    $URL = '../../developers/developers.php?menu=edit&article=';                   //return URL
    $returnURL = $URL . '' . $article_id;
    if ($category == "게시판을 선택해 주세요.") {

        ?>
        <script>
            alert("게시판을 선택해 주세요.");
history.back();
</script>


        <?php
        exit();
    }else if($title =="" || $content == ""){
        ?>
        <script>
            alert("제목과 내용을 모두 입력해주세요");
            history.back();

        </script>
        <?php
        exit();
    }

    $submenu_talk = "Talk Talk";
    $submenu_joboverseas = "해외 취업 정보";
    if ($category == $submenu_talk) {
        $submenulink = "talktalk";
    } else if ($category == $submenu_joboverseas) {
        $submenulink = "joboverseas";

    }

    $URL = '../../developers/developers.php?menu=community&submenu=';
    $completeURL = $URL . '' . $submenulink;

    $date = date('Y-m-d H:i:s');            //Date
    $id = $_POST['id'];            //Writer code
    $tags_post = $_POST['tags'];
    $tags = preg_replace("/\s+/", "", $tags_post);



    $sql = "UPDATE article set title='$title',content ='$content',date ='$date', category = '$category', hashtag ='$tags', user_code ='$id' WHERE article_id = '$article_id'";

    $result = mysqli_query($conn, $sql);

if($result){
    if (!empty($tags)){
        $tagArray = explode(',',$tags);


        for ($t=0; $t<sizeof($tagArray);$t++){
//        echo($tagArray[$t]);

            $result_tag = mysqli_query($conn,"update hashtag set tagstring = '$tagArray[$t]' where tagged_article_id = '$article_id'");

        }

        if ($result_tag) {
            ?>
            <script>
                alert("수정이 완료 되었습니다.");
                location.replace('<?php echo $completeURL?>');
            </script>
            <?php
        }



    }else{
        ?>
    <script>
        alert("수정이 완료 되었습니다.");
        location.replace('<?php echo $completeURL?>');
        </script>
        <?php

    }



}




    ?>
