<?php
/**
 * Created by PhpStorm.
 * User: htpad
 * Date: 2018-12-01
 * Time: 오후 10:17
 */
$conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");

//get user id & old image url
if (isset($_GET['editid'])){
    $id = $_GET['editid'];
//     $id = $_GET['edit_id']; -> file upload form action 에 id 추가.
    $sql = "SELECT user_pic FROM user_info WHERE id ='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $oldimg = $row['user_pic'];
}


     $imgFile = $_FILES['user_image']['name'];
     $tmp_dir = $_FILES['user_image']['tmp_name'];
     $imgSize = $_FILES['user_image']['size'];

//    echo $imgFile;
//    echo '<br/>';
//    echo $tmp_dir;
//    echo '<br/>';
//    echo $imgSize;
//    echo '<br/>';
//


     if(!empty($imgFile))
     {
         $upload_dir = '../../developers/user_images/'; // upload directory
         $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
         $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
         $userpic = rand(1000,1000000).".".$imgExt;
         if(in_array($imgExt, $valid_extensions))
         {
             if($imgSize < 5000000)
             {
                 //기존 사진 삭제
                 unlink($upload_dir.$oldimg);
                 move_uploaded_file($tmp_dir,$upload_dir.$userpic);
             }
             else
             {
                 $errMSG = "Sorry, your file is too large it should be less then 5MB";
                 echo $errMSG;

             }
         }
         else
         {
             $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
             echo $errMSG;
         }
     }
     else
     {
         // if no image selected the old image remain as it is.
         $userpic = $row['userPic']; // old image from database
     }


     // if no error occured, continue ....
     if(!isset($errMSG))
     {


         $updatesql = "update user_info set user_pic = '$userpic' where id ='$id'";
         $result = mysqli_query($conn,$updatesql);

         if($result){
             ?>

             <?php
             header('Location: ../../developers/developers.php?menu=userpage&id='.$id);

         }
         else{
             $errMSG = "Sorry Data Could Not Updated !";
         }

     }
?>