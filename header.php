<?php
include_once "dbconfig.php";

session_start();
if (isset($_SESSION['userid'])) {
    $user_id = $_SESSION['userid'];


//    $conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");
    $sql = "SELECT * FROM user_info WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
//    error_log(mysqli_error($conn));
//    print_r($row) ;
    $nickname = $row['nickname'];
    $id = $row['id'];
}
?>







<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/index_style.css">


    <title></title>
</head>
<body>


<!-- navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top" id="headercontainer">
    <a class="navbar-brand" href="developers.php">Developers</a>
    <!--    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"-->
    <!--            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">-->
    <!--        <span class="navbar-toggler-icon"></span>-->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- nav components -->
        <ul class="navbar-nav">


            <!--            <li class="nav-item dropdown active" >-->
            <!--                <a class="nav-link dropdown-toggle" href="../php/community.php" id="navbarDropdown" role="button" data-toggle="dropdown"-->
            <!--                   aria-haspopup="true" aria-expanded="false">-->
            <!---->
            <!--                    Community  </a>-->
            <!--                <div class="dropdown-menu" >-->
            <!--                    <a class="dropdown-item" href="index.php?menu=talktalk">Talk Talk</a>-->
            <!--                    <a class="dropdown-item" href="index.php?menu=joboverseas">해외 취업 정보</a>-->
            <!--                    <!--<div class="dropdown-divider"></div>-->
            <!--                    <!--<a class="dropdown-item" href="#">Something else here</a>-->
            <!--                </div>-->
            <!--            </li>-->
            <li class="nav-item dropdown active" >
                <a class="nav-link dropdown-toggle" href="developers.php?menu=community">Community</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="developers.php?menu=community&submenu=talktalk">Talk Talk</a>
                    <a class="dropdown-item" href="developers.php?menu=community&submenu=joboverseas">해외 취업 정보</a>
                    <!--<div class="dropdown-divider"></div>-->
                    <!--<a class="dropdown-item" href="#">Something else here</a>-->
                </div>
            </li>
<!--            <li class="nav-item dropdown disabled">-->
<!--                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"-->
<!--                   aria-haspopup="true" aria-expanded="false">-->
<!---->
<!--                    Buy & Sell </a>-->
<!--                <div class="dropdown-menu ">-->
<!--                    <a class="dropdown-item" href="#">Buy</a>-->
<!--                    <a class="dropdown-item" href="#">Sell</a>-->
<!--                </div>-->
<!--            </li>-->
<!--            <li class="nav-item dropdown disabled">-->
<!--                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"-->
<!--                   aria-haspopup="true" aria-expanded="false">-->
<!--                    Jobs </a>-->
<!--                <div class="dropdown-menu">-->
<!--                    <a class="dropdown-item" href="#">구인</a>-->
<!--                    <a class="dropdown-item" href="#">구직</a>-->
<!--                </div>-->
<!--            </li>-->
            <li class="nav-item active">
                <?php
                if(isset($_SESSION['userid'])){
                    ?>
                    <form id="form1" action="http://localhost:8000" method="post">
                        <input type="hidden" name="usernickname" value="<?=$nickname?>"/>
                        <button type="submit" id="chat" class="btn nav-link" style="color: black;background-color: transparent;border: 0;">Dev chat!</button>
                    </form>



                    <?php
                }else{
                    ?>
                    <button  id="unlogin" class="btn nav-link" style="color: black;background-color: transparent;border: 0;">Dev chat!</button>
                    <script>
                        var btn = document.getElementById('unlogin');
                        btn.onclick = function () {
                            alert('로그인 후에 이용해 주시기 바랍니다.')

                        };


                    </script>

                    <?php
                }
                ?>

<!--             </li>-->
<!--            <li class="nav-item active" >-->
<!--                <a class="nav-link " href="developers.php?menu=aboutit">IT_Now</a>-->
<!---->
<!--            </li>-->

<!--            <li class="nav-item disabled" >-->
<!--                <a class="nav-link " href="#">CONFERENCES</a>-->
<!--            </li>-->
        </ul>

        <!-- search bar -->
        <div class="form-inline my-2 my-lg-0 mr-auto" id="my_searchbar">
            <!--<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
            <!--<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
        </div>
        <?php
        //session start말고 나머지는 현재 필요 없는 상태(로그인 해야 들어올 수 있기 때문)
        if (isset($_SESSION['userid'])) {
            ?>

            <!-- 세션에 로그인 유효-->
            <span class="">
                <?php
                if (!empty($row['user_pic'])){

                    ?>
                    <img style="border-radius: 100%" width="50" height="50" src="user_images/<?=$row['user_pic']?>" alt=""/>

                    <?php
                }else {
                    ?>
                    <img style="border-radius: 100%" width="64" height="64" src="images/profile_64.png" alt=""/>


                    <?php
                }
              ?>

            </span>


            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="developers.php?menu=userpage&id=<?=$id?>">
                        <?= $nickname ?>
                    </a>
                </li>
                <li class="nav-item">
                    <span class="nav-link" style="color: gray" >
                        |
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user/logout.php">
                        logout
                    </a>
                </li>
            </ul>


            <?php
        } else {

            ?>

            <!-- 세션에 로그인 안되어 있음-->
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user/signUp.php">SignUp</a>
                </li>

            </ul>


            <?php
        }
        ?>


    </div>
</nav>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>

</body>
</html>
