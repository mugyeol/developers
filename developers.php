<?php
if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];

if ($menu =='read') {
    $conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");
    $article_id = $_GET['index'];
    $sql = "SELECT user_id FROM article LEFT JOIN user_info ON article.user_code = user_info.id WHERE article.article_id = $article_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);


    if(!empty($article_id) && empty($_COOKIE['article_' . $article_id.$row['user_id']])) {

        $hit_sql = "update article set hit = hit + 1 where article_id= $article_id";

        $hit_result = mysqli_query($conn,$hit_sql);


        if(empty($hit_result)) {

            ?>

            <script>

                alert('오류가 발생했습니다.');

                history.back();

            </script>

            <?php

        } else {




            setcookie('article_' . $article_id.$row['user_id'], TRUE, time() + (60 * 60 * 24));




        }

    }
}
}

?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">




      <title>developers</title>
  </head>
  <body >

        <?php
        include_once 'header.php';
            if (isset($_GET['menu'])) {
                $menu = $_GET['menu'];

                if ($menu =='community'){
                    include "contents/community.php";
                }else if ($menu =='create'){
                    include "contents/create.php";
                }else if ($menu =='login'){
                    include "user/login.html";
                }else if ($menu =='read'){
                    include "contents/view.php";
                }else if ($menu =='tags'){
                    include "contents/tags.php";
                }else if($menu == 'edit'){
                    include "contents/edit.php";
                }else if ($menu == 'userpage'){
                    include "contents/userpage.php";

                }else if ($menu=='aboutit'){
                    include "contents/aboutit";
                }
            }
            else{
                include 'contents/home.php';
            }
        include 'footer.php';

        ?>



  </body>
</html>
