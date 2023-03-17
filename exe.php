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


if(mysqli_num_rows($result) > 0) {
    echo "이미 등록된 사용자입니다";
    exit;
}


if($uid != "") {
    $sql = "update login set name='".$name."', id='".$id."', password='".$password."' where uid=".$uid;
} else {
    $sql = "insert into login (name,id,password) values ('$name', '$id', '$password')";
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
