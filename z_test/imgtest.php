<?php
$conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");
$sql = "select user_pic from user_info where id = 12";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$imglink = $row['user_pic'];
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/index_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


    <title></title>

</head>
<body>
<form action="imgtest3.php?id=17" id="form" method="POST" enctype="multipart/form-data" >
    <div style="height: 0px; overflow: hidden">
    <input type="file" id="file" name="user_image"  />
    </div>
    <!--<button style="border: 0px solid transparent;  background: transparent" class="btn ">-->

    <?php
    if (!empty($imglink)){
?>
        <img style="padding: 0; border-radius: 100%" width="128" height="128" class="btn" onclick="chooseFile()" src="../../developers/user_images/<?=$imglink?>">
  <?php
    }else {
?>
        <img style="padding: 0; border-radius: 100%" width="128" height="128" class="btn" onclick="chooseFile()" src="../../developers/images/profile_128.png">

        <?php
    }
    ?>
    <!--</button>-->
</form>

<script>
    function chooseFile() {
        $("#file").click();
    }


    document.getElementById("file").onchange = function() {
        document.getElementById("form").submit();
    };

</script>




<script type="text/javascript" src="../js/bootstrap.js"></script>
</body>
</html>
