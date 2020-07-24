<?php
///**
// * Created by PhpStorm.
// * User: htpad
// * Date: 2018-12-02
// * Time: 오전 7:45
// */
//
//$conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");
//
//
//$tags1 = "http,get,post";
//$tags2 ="Mysql,php,apache,http";
//$tags3 = "tcp,ip";
//$tags4 = "phpstorm,atom,webstorm,jetbrain";
//$tags5 = "android,jetbrain";
//$tags6 = "오픈소스";
//$tags7 = "애플,ios";
//$tags8 = "Intel,AMD";
//$tags8 = "그래픽 카드,Intel,AMD";
//$tags9 = "geforce,intel";
//$tags10 = "javascript,webstorm,phpstorm";
//
//$date = date('Y-m-d H:i:s');            //Date
//
//$tag_arr = array($tags1,$tags2,$tags3,$tags4,$tags5,$tags6,$tags7,$tags8,'',$tags9,$tags10);
//$arr_category = array('Talk Talk','해외 취업 정보');
//
//
//for ($i=1; $i<80; $i++){
//    include '../../developers/create_dummy/info_for_dummy.php';
//
////$ran_user = rand(34,43);
//$ran_tag = rand(0,8);
//$ran_categ = rand(0,1);
//$tags_selected = $tag_arr[$ran_tag];
//$category = $arr_category[$ran_categ];
//
//if ($category === 'Talk Talk'){
//    $title = 'talktalk';
//}else{
//
//    $title = '해외 취업 정보';
//
//
//}
//
//
//$result = mysqli_query($conn,"insert into article (title, content, date, category, hashtag, user_code)
//                        values('$title$i', '$title$i', '$date','$category', '$tags_selected', '$ran_user')");
//
//if ($result){
//
//
//$sql = "SELECT LAST_INSERT_ID()";
//$result = mysqli_query($conn,$sql);
//$row = mysqli_fetch_array($result);
//
//
//if (!empty($tags_selected)){
//    $tagArray = explode(',',$tags_selected);
//
//
//    for ($t=0; $t<sizeof($tagArray);$t++){
//        $result = mysqli_query($conn,"insert into hashtag (tagged_article_id, tagstring) values ('$row[0]', '$tagArray[$t]')");
//
//    }
//
//}
//}
//
//
//}