<?php
session_start();
include_once "checkAdmin.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理会员</title>
    <style>
        h1 {
            text-align: center;
        }

        .main {
            width: 50%;
            margin: 0 auto
        }

        .main table {
            width: 100%
        }
        a{color: cornflowerblue;text-decoration: none}
        a:hover{color: crimson;text-decoration: underline}
    </style>
</head>
<body>

<h1>会员列表</h1>

<?php
include_once "nav.php";
include_once "conn.php";
include_once "page.php";
$sql = "select count(1) total from userinfo where username <> 'admin'";
$result = mysqli_query($conn, $sql);
//新增内容
$info = mysqli_fetch_array($result);
$count_rows = $info['total'];
$perPage = 2;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
//引用分页函数
pageft($count_rows, $count_rows,$perPage);
$sql = "select * from userinfo where username <> 'admin' order  by id desc limit $firstCount, $displayPG";
$result = mysqli_query($conn, $sql);
?>
<table border="0" width="80%" align="center">
    <tr>
        <td align="center">
            <table align="center" width="100%" border="1" bordercolor="black" cellspacing="0" cellpadding="10"
                   style="border-collapse: collapse" id="admin">
                <tr>
                    <td align="center">序号</td>
                    <td align="center">用户名</td>
                    <td align="center">性别</td>
                    <td align="center">信箱</td>
                    <td align="center">爱好</td>
                    <td align="center">管理员</td>
                    <td align="center">操作</td>
                </tr>
                <?php
                $i = ($page - 1) * $perPage + 1;
                while ($info = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td align="center"><?php echo $i ?></td>
                        <td align="center"><?php echo $info['username']; ?></td>
                        <td align="center"><?php echo ($info['sex'] == 1) ? "男" : "女" ?></td>
                        <td align="center"><?php echo $info['email']; ?></td>
                        <td align="center"><?php echo $info['fav']; ?></td>
                        <td align="center"><?php echo $info['admin'] ? "是" : "否" ?></td>
                        <td align="center">
                            <?php
                            if($info['username'] == 'admin'){
                                echo '<span style="color: gray;text-decoration: line-through;">设置管理员</span>';
                            }
                            else{
                                if($info['admin']){
                                    echo "<a href='setAdmin.php?id=" . $info['id']  . "&action=0'>取消管理员</a>";
                                }
                                else{
                                    echo "<a href='setAdmin.php?id=" . $info['id'] . "&action=1'>设置管理员</a>";
                                }
                            }
                            if($info['username'] == 'admin'){
                                echo ' <span style="color: gray;text-decoration: line-through;">删除</span>';
                            }
                            else{
                                echo " <a href='javascript:if(confirm(\"您确认要删除 ".$info['username']." 吗？\")){location.href=\"del.php?id=".$info['id']."\"}'>删除</a>";
                                /*echo " <a href='del.php?id=" . $info['id'] . "'>删除</a>";*/
                            }
                            echo " <a href='member.php?navID=4&id=".$info['username']."&source=admin&page=$page'>资料修改</a> ";
                            ?>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </table>
        </td>
    </tr>
    <tr>
        <td align="right"><?php
            //页尾显示
            echo $pageNav;
            ?></td>
    </tr>
</table>
<script src="jquery.js"></script>
<script>
    $(function () {
        var tr = $("#admin tr");
        tr.mouseover(function () {
            $(this).css("background-color", "#f2b787");
            $(this).children("td").css("background-color", "#f2b787");
        }).mouseout(function () {
            $(this).css("background-color", "#FFFFFF");
            $(this).children("td").css("background-color", "#FFFFFF");
        });
    });
</script>

</body>
</html>