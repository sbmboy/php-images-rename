<?php
/**
 * PHP对图片批量重名名
 *
**/
echo "将该程序放于图片文件夹同一目录下：运行php rename.php\n可设置前缀,后缀和连接符：machine-1.jpg\n目前只支持.jpg后缀的图片格式\n";
while(true){
  fwrite(STDOUT,"输入源文件目录[如:images]：");
  $from=trim(fgets(STDIN));
  $files=glob("{$from}/*.jpg");
  if(count($files)>0){break;}else{echo "文件夹不存在或无图片\n";continue;}
}
fwrite(STDOUT,"输出目录[如:output]：");
$to=trim(fgets(STDIN));
while($to==''){
  echo "输出文件夹不能为空\n";
  fwrite(STDOUT,"输出目录[如:output]：");
  $to=trim(fgets(STDIN));
}
fwrite(STDOUT,"名称前缀：");
$before=trim(fgets(STDIN));
fwrite(STDOUT,"连接符[一般为-或_]：");
$connect=trim(fgets(STDIN));
fwrite(STDOUT,"名称后缀：");
$after=trim(fgets(STDIN));
echo "开始处理...\n";
if(!is_dir($to)) mkdir($to);
$counter=1;
foreach($files as $file){
  $newpath="{$to}/";
  if($before!='') $newpath .= $before.$connect;
  $newpath .= $counter;
  if($after!='') $newpath .= $connect.$after;
  copy($file,$newpath.".jpg");
  echo date("Y-m-d H:i:s").": {$file} -> {$newpath}.jpg\n";
  $counter++;// 计数器
}
echo "一共{$counter}张图片，完成！";
?>
