<?
include "dbconnect.php";

$jsonString = file_get_contents('php://input');  ##데이터 가져오기
// PHP로 문자열을 JSON 데이터로 변환
$obj = json_decode($jsonString);

if($obj->searchText != '') {
    $sql = "select * from login where name='".$obj->searchText."'";
} else {
    $sql = "select * from login";
}


$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

$recordCnt = mysqli_num_rows($result);
$recordArray = [];

while($t=mysqli_fetch_object($result)){
    array_push($recordArray, array(
        'uid' => $t->uid,
        "name" => $t->name,
        "id" => $t->id,
        "password" => $t->password, 
        "img" => $t->img,
    ));
}

$jsonResult = [
    "status" => 200,
    "response" => [
        "total" => $recordCnt,
        "result" => $recordArray
    ]
];

echo json_encode($jsonResult);

