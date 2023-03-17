<?
header('Content-Type: text/html; charset=UTF-8');

include "dbconnect.php";

extract($_POST);
extract($_GET);
if($name == "") {
    echo "이름을 입력하세요";
    exit;
}

if($id == "") {
    echo "아이디를 입력하세요";
    exit;
}

// $now = date("Y-m-d");

$sql = "select uid from login where id='".$id."'";
$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));




// 첨부파일 올리기
// Count total files
$countFiles = count($_FILES['img']['name']);
$fileName = '';
    
if($uid > 0) { // 수정
    $sql = "select * from login where uid=".$uid;
    $result = mysqli_query($conn, $sql);
    $old = mysqli_fetch_object($result);
    $fileName = $old->img;
}

if(mb_strlen($_FILES['img']['name'][0]) > 0) { // 첨부파일이 있을 때

    // Loop all files
    for($i = 0; $i < $countFiles; $i++) {

        // File name
        $fileName = $_FILES['img']['name'][$i];
        
        // Location
        $targetFile = './uploads/'.$fileName;
        
        // file extension
        $fileExtension = pathinfo($targetFile, PATHINFO_EXTENSION);
        $fileExtension = strtolower($fileExtension);
        
        // Valid image extension
        $validExtension = array("png","jpeg","jpg", "gif");
        
        if(in_array($fileExtension, $validExtension)) {
            // Upload file
            move_uploaded_file($_FILES['img']['tmp_name'][$i], $targetFile);
        }
    }
}

if($uid != "") {
    $sql = "update login set name='".$name."', id='".$id."', password='".$password."', img='".$fileName."' where uid=".$uid;
} else {
    if(mysqli_num_rows($result) > 0) {
        echo "이미 등록된 사용자입니다";
        exit;
    }
    $sql = "insert into login (name,id,password, img) values ('$name', '$id', '$password', '$fileName')";
}

mysqli_query($conn, $sql) or die (mysqli_error($conn));

// 수정쿼리
// update member set name='$name', id='$id' where uid='$uid;


// function backGo($msg) {
//     echo "<script>";
//     echo "alert('".$msg."');";
//     echo "history.go(-1);";
//     echo "</script>";
// }
