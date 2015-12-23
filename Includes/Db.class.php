<?php
/**
* Class and Function List:
* Function list:
* - connect()
* - query()
* - getAll()
* - getRow()
* - getOne()
* - autoExcute()
* Classes list:
* - Db
*/

abstract class Db
{
    
    /*
      链接服务器
      $h：服务器地址
      $u：用户名
      $p：密码
      return：bool 表示连接数据库成功状态
    */
    public abstract function connect( $h, $u, $p );
    
    /*
      发送查询语句
      $sql：select语句/insert语句/update语句...
      return：mixed bool/resource
    */
    public abstract function query( $sql );
    
    /*
      查询多行数据
      $sql：select语句
      return：array/bool
    */
    public abstract function getAll( $sql );
    
    /*
      查询单行数据
      $sql：select语句
      return：array/bool
    */
    public abstract function getRow( $sql );
    
    /*
      查询单个数据
      $sql：select语句
      return：array/bool
    */
    public abstract function getOne( $sql );
    
    /*
      自动执行insert/update语句
      $table：被操作的表名
      $data：array()
      $act：insert/update
      $where：update语句执行时的条件
      return：bool
    —————————————————————————————————————
      实现autoExcute('userTable',array('username'=>'zhang','email'=>'123@123.com'),insert);
      自动拼接成：insert into userTable (username,email) values ('zhang','123@123.com');
    */
    public abstract function autoExcute( $table, $data, $act = 'insert', $where = '' );
}

