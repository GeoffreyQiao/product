<?php //log.class.php 记录信息到日志文件
//内容给定，写入文件(fopen,fwrite).如果文件大于1M，重新写一份。
//
class Log{
    //常量代表日志文件的名称
    const LOGFILE = "curr.log";

    //把内容写入到日志文件
    public static function write($cont){
      //计算当前时间戳并合成到日志信息行当中
      $time = date("Y:m:d H:i:s", time());
      $cont = $time .' >>> '. $cont ."\r\n";
      //判断符合条件的文件是否备份
      $log = self::rSize();
      $fh = fopen($log,'ab');
      fwrite($fh,$cont);
      fclose($fh);
      clearstatcache(true,ROOT. 'data/log/'.LOGFILE);
    }

    //备份日志
    public static function bak(){
      $log = ROOT . 'data/log/' . self::LOGFILE ;
      $bak = ROOT . 'data/log/'.date('ymdHis').'.bak';
      return rename($log,$bak);
    }

    //读取并判断日志文件的大小
    public static function rSize(){
      $log = ROOT . 'data/log/' . self::LOGFILE ;
      //判断日志文件是否存在，如果不存在则创建并返回。
      if(!file_exists($log)){
        touch($log);
        return $log;
      }
        //要是存在则判断大小并返回。
        $size = filesize($log);
        if($size <= 1024*1024){
          return $log;
        }

        //大于1m的情况执行以下命令
        if(!self::bak()){
          return $log;
        }else{
          touch($log);
          return $log;
        }

    }
}



 ?>
