
<?php
class Validator{
    /*************************************************
    Validator for PHP  β 服务器端脚本
    code by 我佛山人
    wfsr@cunite.com
    http://www.cunite.com
     *************************************************/
    var $submit;
    var $error_item, $error_message, $error_mode, $error_no;
    function Validator($submit_name = "Submit", $mode = 5){
        $this->submit = $submit_name;
        $this->error_mode = $mode;
        $this->error_no = 1;
    }

    function Validate($arr){
        if(! isset($_POST[$this->submit])) return false;
        $this->error_mode = $_POST["emode"];
        echo "<script defer>document.getElementsByName(\"emode\")[0].selectedIndex =" . ($this->error_mode - 1) . "</script>";
        if(is_array($arr)){
            $len = count($arr);
            for($i = 0; $i < $len; $i++){
                $this->is_valid($arr[$i]);
            }
        }

        if($this->error_no > 1)
            $this->display_error();
    }

    function is_valid($str){
        $str = split(",", $str);
        if(count($str) < 3) return false;
        $name = trim($str[0]);
        $message = trim($str[1]);
        $data_type = trim($str[2]);
        $value = trim($_POST[$name]);

        switch($data_type){
            case "compare" :
                break;
            case "range" :
                break;
            case "repeat" :
                break;
            default :
                $method = "is_".$data_type;
                if(!$this->$method($value))
                    $this->add_error($name, $message);
                break;
        }
    }

    function add_error($name, $message){
        $this->error_item .= "," . $name;
        $this->error_message .= "," . $this->error_no . ":" . $message;
        $this->error_no ++;
    }

    function display_error(){
        $this->error_item = ereg_replace("^,+", "", $this->error_item);
        $this->error_message = ereg_replace("^,+", "", $this->error_message);

        switch($this->error_mode){
            case 4 :
                $info = "以下原因导致提交失败：\t\t\t\t,";
                echo "<script>alert(\"".join("\\n", split(",", $info . $this->error_message))."\")</script>";
                //print >>>end;
                break;
            case 5 :
                echo "输入有错误：<br /><ul><li>" . ereg_replace( "\b\d+:", "",join("</li><li>", split(",", $this->error_message))) . "</li></ul>";
                echo "<br /><a href='javascript:history.back()'>返回</a>";
                exit;
                break;
            default :
                echo "<script defer>dispError(\"" . $this->error_item . "\", \"" . $this->error_message . "\", " . $this->error_mode . ", \",\")</script>";
                break;
        }
    }

    function is_email($str){
        return preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/", $str);
    }

    function is_url($str){
        return preg_match("/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"])*$/", $str);
    }

    function is_qq($str){
        return preg_match("/^[1-9]\d{4,8}$/", $str);
    }

    function is_zip($str){
        return preg_match("/^[1-9]\d{5}$/", $str);
    }

    function is_idcard($str){
        return preg_match("/^\d{15}(\d{2}[A-Za-z0-9])?$/", $str);
    }

    function is_chinese($str){
        return ereg("^[".chr(0xa1)."-".chr(0xff)."]+$",$str);
    }

    function is_english($str){
        return preg_match("/^[A-Za-z]+$/", $str);
    }

    function is_mobile($str){
        return preg_match("/^((\(\d{3}\))|(\d{3}\-))?13\d{9}$/", $str);
    }

    function is_phone($str){
        return preg_match("/^((\(\d{3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}$/", $str);
    }

    function is_safe($str){
        return (preg_match("/^(([A-Z]*|[a-z]*|\d*|[-_\~!@#\$%\^&\*\.\(\)\[\]\{\}<>\?\\\/\'\"]*)|.{0,5})$|\s/", $str) != 0);
    }
}
$v = new Validator();
$v->Validate(array("Name,名字只允许中文,chinese", "Nick, 只允许英文昵称, english", "Homepage, 主页Url格式不正确, url", "Password, 密码不符合安全规则, safe","Email,信箱格式错误,email", "QQ, QQ号码不存在, qq","Card, 身份证号码不正确, idcard","Phone, 电话号码不存在, phone","Mobile, 手机号码不存在, mobile","Zip, 邮政编码不存在, zip"));
?>
