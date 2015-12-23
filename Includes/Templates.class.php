<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - assign()
 * - display()
 * Classes list:
 * - Templates
 */

class Templates
{
  private $values = array();
  private $proConfigs = array();
  
  function __construct() 
  {
    echo IS_CACHE?'真的':'.........';
    if( !is_dir( TPL ) || !is_dir( TPL_C ) || !is_dir( CACHE ) )
    {
      exit( "ERR: 模板目录：" . TPL . '或模板编译目录：' . TPL_C . '或缓存目录：' . CACHE . '不存在，请手动添加！' );
    }
    
    $tagLib = json_decode( file_get_contents( ROOT . 'config/conf.json' ), true );
    foreach( $tagLib as $k => $v )
    {
      $this->proConfigs[ $k ] = $v;
    }
  }
  
  //模板变量注入
  public function assign( $key, $value )
  {
    if( isset( $key ) && !empty( $key ) )
    {
      $this->values[ $key ] = $value;
    } 
    else
    {
      exit( 'ERR: 请设置模板变量！' );
    }
  }
  
  //模板文件显示方法
  public function display( $file )
  {
    if( !file_exists( $tplFile = TPL . $file ) )
    {
      exit( 'ERR: 模板文件不存在!' );
    }
    
    //设置编译文件存放路径
    $parFile = TPL_C . md5( $file ) . $file . '.php';
    
    //设置缓存文件存放路径
    $cacheFile = CACHE . md5( $file ) . $file . '.html';
    
    /*    如果系统设置缓存开启并且对应缓存文件存在，则判断编译文件和模板文件是否存在并且判断3个关联文件最后修改时间，任一不为true则清空缓存并重新执行编译同时生成缓存文件。否则直接调用缓存静态html文件并返回。
    */
    if( (IS_CACHE) && (file_exists( $cacheFile )) )     //是否调用缓存文件的逻辑判断和操作
    {
      if( file_exists( $parFile ) && file_exists( $tplFile ) && filemtime( $cacheFile ) >= filemtime( $parFile ) && filemtime( $parFile ) >= filemtime( $tplFile ) )
      {
        include $cacheFile;
        return;
      } 
      else
      {
        ob_end_clean();
      }
    }
    
    //判断$parFile编译文件不存在或者修改时间小于$filePath的修改时间，将重新编译模板，生产新的编译文件
    if( !file_exists( $parFile ) || filemtime( $parFile ) < filemtime( $tplFile ) )
    {
      require_once ROOT . 'includes/Parser.class.php';
      $parser = new Parser( $tplFile );
      $parser->compile( $parFile );
    }
    
    include $parFile;
    
    //获取缓冲区数据并写入新创建的缓存文件
    file_put_contents( $cacheFile, ob_get_contents() );
  }

  //载入模块tpl模板，阻止其生成缓存文件
  public function create($file)
  {
    //设置模板路径
    $tplFile = TPL . $file;
    if (!file_exists($tplFile)) {
      exit('ERR: 模板文件不存在！');
    }

    //编译文件
    $parFile = TPL_C . md5($file) . $file . '.php';
    //编译文件不存在或者修改早于模板文件修改时间，重新编译模板
    if (!file_exists($parFile)||filemtime($parFile)>=filemtime($tplFile)) {
      require_once ROOT . '/includes/Parser.class.php';
      $parser = new Parser( $tplFile );
      $parser->compile( $parFile );
    }
    include $parFile;
  }
}
