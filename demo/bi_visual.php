<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2016/10/27
 * Project: Cat Visual
 */

ini_set("memory_limit", "1024M");
require dirname(__FILE__).'/../core/init.php';

// 登录请求url
$login_url = "http://jccbi.inner.jucaicat.net/Api/Account/checkLogin";
// 提交的参数
$params = array(
    "user_login" => "admin",
    "user_pass" => "1q2w3e4r"
);
// 发送登录请求
requests::post($login_url, $params);
// 登录成功后本框架会把Cookie保存到www.waduanzi.com域名下，我们可以看看是否是已经收集到Cookie了
$cookies = requests::get_cookies("jccbi.inner.jucaicat.net");
// requests对象自动收集Cookie，访问这个域名下的URL会自动带上
// 接下来我们来访问一个需要登录后才能看到的页面
$url1 = "http://jccbi.inner.jucaicat.net/Api/Operate/Operate_userExp";
$url2 = "http://jccbi.inner.jucaicat.net/Api/Operate/Operate_userEx_slowArea";
$url3 = "http://jccbi.inner.jucaicat.net/Api/ManagerData/sjdp_data";
$re1 = requests::post($url1);
$re2 = requests::post($url2);
$re3 = requests::post($url3);

if ($re1 && $re2 && $re3) {
    echo "Success!";
    die;
} else {
    $time = date('Y-m-d H:i:s');
    log::error("抱歉，爬取失败！----{$time}----\n");
}
?>