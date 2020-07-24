<?php
/**
 * Created by PhpStorm.
 * User: htpad
 * Date: 2018-12-18
 * Time: 오후 12:50
 */
$conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");

$ran_user = rand(34,43);

$sql = 'select article_id from article order by article_id limit 1';
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$first_id = $row['article_id'];
if ($result){
    $sql = 'select article_id from article order by article_id desc limit 1';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $last_id= $row['article_id'];
    $ran_article_id = rand($first_id, $last_id);

}
