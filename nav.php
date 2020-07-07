<style>
    h2 {
        text-align: center;
        font-size: 16px;
    }

    h2 a {
        margin-right: 15px;
        color: navy;
        text-decoration: none
    }

    h2 a:last-child {
        margin-right: 0px;
    }

    h2 a:hover {
        color: crimson;
        text-decoration: underline
    }

</style>
<?php
$navID = isset($_GET['navID'])?$_GET['navID']:0;
?>
<h2>
    <a href="index.php?navID=0" <?php if($navID==0){echo 'style="color: darkgreen"';}?>>首页</a>
    <a href="singup.php?navID=1" <?php if($navID==1){echo 'style="color: darkgreen"';}?>>会员注册</a>
    <a href="login.php?navID=2" <?php if($navID==2){echo 'style="color: darkgreen"';}?>>会员登录</a>
    <a href="member.php?navID=4&source=member" <?php if($navID==4){echo 'style="color: darkgreen"';}?>>个人资料修改</a>
    <a href="admin.php?navID=3" <?php if($navID==3){echo 'style="color: darkgreen"';}?>>后台管理</a>
</h2>