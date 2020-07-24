<?php
/**
 * Created by PhpStorm.
 * User: htpad
 * Date: 2018-12-01
 * Time: 오후 7:19
 */

// error_reporting( ~E_NOTICE ); // avoid notice
$conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");

// if(isset($_POST['btnsave']))
// {

     $imgFile = $_FILES['user_image']['name'];
     $tmp_dir = $_FILES['user_image']['tmp_name'];
     $imgSize = $_FILES['user_image']['size'];



  if(empty($imgFile)){
         $errMSG = "Please Select Image File.";
     }
     else
     {
         $upload_dir = '../../developers/user_images/'; // upload directory

         $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
         echo $imgExt;
         // valid image extensions
         $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

         // rename uploading image
         $userpic = rand(1000,1000000).".".$imgExt;

         // allow valid image file formats
         if(in_array($imgExt, $valid_extensions)){
             // Check file size '5MB'
             if($imgSize < 5000000)    {
                 unlink($upload_dir,$userpic);
                 move_uploaded_file($tmp_dir,$upload_dir.$userpic);
             }
             else{
                 $errMSG = "Sorry, your file is too large.";
             }
         }
         else{
             $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
         }
     }


     // if no error occured, continue ....
     if(!isset($errMSG))
     {
         $sql ="INSERT INTO user_info (user_id,user_pw,name,nickname,email,user_pic) VALUES('test','test','test','test','test','$userpic')";
         $result = mysqli_query($conn,$sql);


         if($result)
         {
             $successMSG = "new record succesfully inserted ...";
//             header('Location: ../../developers/z_test/imgtest.php');
         }
         else
         {
             $errMSG = "error while inserting....";
         }
//     }
 }
?>