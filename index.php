<?php
//1. 直接采用file函数来操作
ini_set('memory_limit','-1'); 
$file = 'nginx.log'; 
$data = file($file);
$line = $data[count($data)-1]; 
var_dump($line);
echo "<br/>";

//2.直接调用linux的tail命令来显示最后几行,windows下返回NULL
$file = 'nginx.log';
//对命令行参数进行安全转义 
$file = escapeshellarg($file);
$line = `tail -n 1 $file`; 
var_dump($line);
echo "<br/>";

//3.直接使用php的fseek来进行文件操作
$filepath = 'nginx.log';
var_dump(FileLastLines($filepath, 3));
echo "<br/>";

/**
 * 工具函数,读取文件最后$n行
 * @param   string      $filepath 文件的路径
 * @param   int         $n 文件的行数
 * @return  string
 */
function FileLastLines($filename, $n = 1)
{
    if(!$fp = fopen($filename, 'r'))
    {
        return false;
    }
    $pos = -2;
    $eof = '';
    $str = '';
    while ($n > 0)
    {
        while ($eof != "\n")
        {
            if (!fseek($fp, $pos, SEEK_END))
            {
                $eof = fgetc($fp);
                $pos--;
            } else {
                break;
            }
        }
        $str.= fgets($fp);
        $eof = '';
        $n--;
    }
    return $str;
}
