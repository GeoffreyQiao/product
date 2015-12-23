<?php
  //框架基础函数库，lib_base.php
  //递归转义数组函数
  //defined("GEOKEY")||exit('Geo提示:目前您的访问非法，请走正门！');
  function _AddSlashes($arr){
      foreach ($arr as $key => $value) {
          if(is_string($value)){
              $arr[$key] = addslashes($value);
          }elseif (is_array($value)) {
              $arr[$key] = _addSlashes($value);
          }
      }
      return $arr;
  }

 ?>
