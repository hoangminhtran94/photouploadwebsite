<!-- Program by Minh Hoang Tran -->
<?php
$target_dir = "imgs/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["upload"])) {
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }
}
// Check if file already exists
if (file_exists($target_file)) {
  $uploadOk = 0;
  }
  
if ($uploadOk == 0) {
  echo $uploadOk;
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
      $uploadOk = 1;
   } 
   else {
      $uploadOk = 0;
   }
 }
echo $uploadOk;
?>