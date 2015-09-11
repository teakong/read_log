# read_log
使用PHP读取日志有以下几种方法：

1. 直接采用file函数来操作，遇到大文件日志直接卡死，不推荐。

2.直接调用linux的tail命令来显示最后几行,windows下返回NULL,效率很高但是执行shell命令不安全且兼容性不好。

3.直接使用php的fseek来进行文件操作，效率较高，推荐。

第三种方法读取日志来自于https://github.com/shuiguang/workerman-crontab/blob/master/Applications/Crontab/Lib/functions.php

使用js定时请求php，读取日志的最后几行然后返回给前端以实现监控，不过该functions.php中FileLastLines存在bug，比如读取最后一行失败，而且使用数组记录要读取的行比较浪费内存。

index.php中的FileLastLines已经修复。
