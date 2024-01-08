<?php 
/**
 * 批量消息入口
 * @author xiaonian
 * @datetime 2024-01-08 15:00
 */

use Swoole\Coroutine;
use function Swoole\Coroutine\run;


$threads=1000;

$datetimeStart=microtime();
run(function () use($threads) {
    //此处需要注意消息接口负载能力
    //数据库负载能力，可以使用redis做缓冲。避免直接访问DB
    for($times=0;$times<$threads;$times++){
        Coroutine::create(function() use($times){
            //发送消息的函数
            Coroutine::sleep(1);
            echo $times." 消息发送完毕。\n";
        });
    }
});
$datetimeEnd=microtime();
var_dump($datetimeStart);
var_dump($datetimeEnd);
echo '所有的消息都发送完毕 done';//可以得到执行