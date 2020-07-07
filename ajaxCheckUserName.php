<?php
$username = $_POST['username'];
include_once "conn.php";
$sql = "select 1 from userinfo where username = '$username'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)){ //说明找到了行记录
    //说明用户名已经被占用
    //用JSON格式将数据返回
    $find['error'] = 1;
    $find['errMsg'] = "此用户名已经被占用";
}
else{  //说明用户名有效
    $find['error'] = 0;
}
$i=1;
while($i<3000000){
    $i++;
}
echo json_encode($find);
//echo "OK";