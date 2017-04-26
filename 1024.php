<?php
/**
 * Created by PhpStorm.
 * User: wuilly
 * Date: 2017/4/18
 * Time: 下午9:21
 */

require_once './lib/simple_html_dom.php';

$UserAgent = 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_2_1 like Mac OS X) AppleWebKit/602.4.6 (KHTML, like Gecko) Mobile/14D27 MicroMessenger/6.5.5 NetType/3G Language/zh_CN';
$time=1;

for ($i=101;$i<150;$i++){
    $url="http://cl.giit.us/thread0806.php?fid=15&search=&page=".$i;

    $ch = curl_init();
    echo "----------------------------开始进行筛选----------------------------\n";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $UserAgent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $ret = curl_exec($ch);
    curl_close($ch);
    $html = new simple_html_dom();
    $html->load($ret);
    $title = $html->find('html body div div table tbody tr td a');
    foreach ($title as $r) {
        $content = $r->innertext; // 获取标签里的所有内容，包括html标签
        //写入文件
        //var_dump($ret);
        $path=dirname(__FILE__);
        $content = "--------------------------------------------this is ".$i." page\n".$content."\n";
        $file = $path."/1024.txt";    // 写入的文件
        file_put_contents($file,$content,FILE_APPEND);
    }

    echo "----------------------------第".$i."页筛选完毕----------------------------\n";
    //$title = $html->find('a[class=tr3 t_one tal]',0);
    sleep($time);
}