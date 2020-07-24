<?php
$conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");
$category = $_POST['category'];
$returnURL = '../../developers/developers.php?menu=create';                   //return URL


$title = $_POST['title'];                  //Title
$content = $_POST['content'];              //Content
$date = date('Y-m-d H:i:s');            //Date
$id = $_POST['id'];            //Writer code
$tags_post = $_POST['tags'];
$tags = preg_replace("/\s+/", "", $tags_post);
if($category=="게시판을 선택해 주세요."){

?>
    <script>
    alert("게시판을 선택해 주세요.");
    location.replace("<?php echo $returnURL?>");
    </script>


<?php
    exit();

}else if($title =="" || $content == ""){
    ?>
    <script>
    alert("제목과 내용을 모두 입력해주세요");
    location.replace("<?php echo $returnURL?>");
    </script>
    <?php
    exit();
}







$sql = "insert into article (title, content, date, category, hashtag, user_code)
                        values('$title', '$content', '$date','$category', '$tags', '$id')";
$result = mysqli_query($conn,$sql);


$sql = "SELECT LAST_INSERT_ID()";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

$arr=[];


if (!empty($tags)){
    $tagArray = explode(',',$tags);


    for ($t=0; $t<sizeof($tagArray);$t++){
//        echo($tagArray[$t]);

        $result = mysqli_query($conn,"insert into hashtag (tagged_article_id, tagstring) values ('$row[0]', '$tagArray[$t]')");

    }

}



//복귀 url 세트
$submenu_talk = "Talk Talk";
$submenu_joboverseas = "해외 취업 정보";
if ($category==$submenu_talk){
    $submenulink="talktalk";
}else if($category==$submenu_joboverseas){
    $submenulink="joboverseas";

}
$URL = '../../developers/developers.php?menu=community&submenu=';
$completeURL = $URL.''.$submenulink;
//복귀 url 세트 끝
if($result){
    ?>
    <script>
        alert("<?php echo "글이 등록되었습니다."?>");
        location.replace("<?php echo $completeURL?>");
    </script>
    <?php
}
else{
    print_r($conn);
}

mysqli_close($conn);
?>
