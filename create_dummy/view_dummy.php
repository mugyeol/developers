<?php
/**
 * Created by PhpStorm.
 * User: htpad
 * Date: 2018-12-18
 * Time: 오후 1:23
 */
$conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");

for ($i=1; $i<1000; $i++){
    include '../../developers/create_dummy/info_for_dummy.php';
    $article_id =$ran_article_id;
    $sql = "UPDATE article set hit = hit + 1 WHERE article_id = '$article_id'";
    $result = mysqli_query($conn,$sql);

}
