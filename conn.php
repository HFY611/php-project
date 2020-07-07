<?php
//第一步，连接数据库服务器
$conn = mysqli_connect("localhost","root",'',"member") or die("数据库服务器连接失败！");
//第二步，指定字符集
mysqli_query($conn,"set names utf8");