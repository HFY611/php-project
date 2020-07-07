<?php
//首先读取前端用户提交的数据
$username = trim($_POST['username']);
$pw = trim($_POST['password']);
$sex = $_POST['sex'];
$email = $_POST['email'];
$fav = implode(",",$_POST['fav']);  //explode

//进行必要的验证
if($username == "" or $pw == ""){
    echo "<script>alert('用户名和（或）密码必须要填写');history.back();</script>";
    exit;
    //die();
}
//将信息写入数据库
include ("conn.php");//引入数据库连接
//第四步，完成数据库的相应操作
//先判断用户提交的用户名是否已经被占用。
//在数据库中查询用户提交的用户名
$sql = "select * from userinfo where username = '$username'";
/*echo $sql;
exit;*/
$allUser = mysqli_query($conn,$sql);
//判断返回的结果集中的记录数
if(mysqli_num_rows($allUser)){  //非0非空即为真
    echo "<script>alert('您输入的用户名已经用占用了！');history.back();</script>";
}
else{
    $sqlString = "insert into userinfo (username,pw,sex,email,fav) 
        values ('$username','" . md5($pw) . "','$sex','" . $email . "','" . $fav . "')";
    $result = mysqli_query($conn,$sqlString);
    echo mysqli_error($conn);
    if($result){
        echo "<script>alert('数据插入成功');</script>";
    }
    else{
        echo "<script>alert('写数据库失败');</script>";
    }
}

