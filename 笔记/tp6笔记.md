## 一、开发规范

1. tp6遵循的是PSR-2的命名规范和PSR-4的自动加载。
2. 目录和文件的规范如下：
   1. 目录名（小写+下划线）
   2. 类库和函数文件统一以.php为后缀
   3. 类的文件名均以命名空间定义，并且命名空间的路径和类库文件所在路径一致
   4. 类（包含接口和Trait）文件采用驼峰式命名（首字母大写），其他采用小写+下划线命名
   5. 类名（包含接口和Trait）和文件名保持一致，统一采用驼峰式命名（首字母大写）
3. 函数和类、属性命名规范如下：
   1. 类的命名采用驼峰法（首字母大写），如：User、UserType
   2. 函数的命名使用小写字母和下划线（小写字母开头）的方式，如：get_client_ip
   3. 方法的命名使用驼峰法（首字母小写），如：getUserName
   4. 属性的命名使用驼峰法（首字母小写），如：tableName
   5. 特例：以双下划线“ __ ”打头的函数或方法作为魔术方法，如：`__call和`__autoload
4. 常量与配置的规范如下：
   1. 常量以大写字母和下划线命名，如：APP_PATH
   2. 配置参数以小写字母和下划线命名，如：url_convert
   3. 环境变量定义使用大写字母和下划线命名，如：APP_DEBUG
5. 数据表和字段的规范如下：
   1. 数据表和字段采用小写加下划线方式命名
   2. 注意字段名不要以下划线开头，如：think_user表和user_name表
   3. 字段不建议使用驼峰和中文作为数据表及字段命名

## 二、目录结构

1. tp6支持多应用模式部署，app是应用目录

2. 默认情况下，是采用单模式，如下结构：![单应用](单应用.png)

   3.多应用模式，如下结构：

    ![多应用](多应用.png)

   4. 上图，app_name可以有多个，即多应用模式

   5. 在目录结构上，只确保对外仅可访问public目录![public目录](public目录.png)

   6.在app目录中，还提供了一些文件

   ![APP目录其他文件](APP目录其他文件.png)

## 三、开启调试与配置文件

### 1、开启调试

1. 在开发阶段，建议开启框架调试模式
2. 调试模式开启后，会牺牲一些执行效率，但是大大提高了开发拍错的能力
3. 当项目部署到生产环境时，再关闭调试模式即可
4. 安装好的tp6默认并没有开启调试，可以在域名后面乱输入一些字符，然后回车
5. 此时，页面会提示：“页面错误，请稍后再试~”，表示调试未开启
6. 通过命令行安装tp6，会自动在根目录生成一个.example..env文件
7. .env文件是环境配置文件，我们只要删除签名的.example.即可生效
8. 此时刷新页面，右下角会出现Trace调试小图标，说明调试开启了
9. 查看.env文件，打开调试的环境变量为：APP_DEBUG = true，false关闭
10. 开启调试模式显著优势：
    1. 记录系统运行流程执行过程
    2. 展示错误和调试信息，并开启日志记录
    3. 模板修改可以及时生效，不会被缓存干扰
    4. 启动右下角的Trace调试功能，更加强大
    5. 发生异常时，也会显示异常信息
11. 当然还有一种模式，就是关闭调试的时候，也可以显示简要的错误信息
12. 首先，关闭调试模式：APP_DEBUG = false
13. 然后根目录下config的app.php最后一项设置为：

```
'show_error_msg' => true
```

### 2、配置信息

1. 配置文件有两种形式，开启模式我们采用的.env文件是一种，适合本地
2. 另一种配置文件，在根目录下的config里，有很多类型的配置，适合部署
3. 官方手册明确表示：.env环境变量用于本地开发测试，部署后会被忽略
4. 那么，怎么去获取这些配置文件的值呢？
5. 对于.env文件，比如：[DATABASE]下的HOSTNAME = 127.0.0.1 获取方式如下：

```
use think\facade\Env;
return Env::get('database.hostname');
```

6. 对于config文件，比如：database.php下的hostname，获取方式如下：

```
use think\facade\Config;
return Config::get('database.connections.mysql.hostname');
```

7. 也可以判断这两种配置是否存在，使用has方法判断

```
echo Env::has('database.hostname');
echo Config::has('database.connections.mysql.hostname');
```

8. 关于这两种配置文件的优先级，在本地测试时.env优先于config
9. 从config配置中可以看出，它是先读取.env的，然后在默认配置一个自己的
10. 而到了部署环境，.env会被忽略，则自动切换到config配置

## 四、url访问模式

### 1、url解析

1. tp框架非常多的操作都是通过url来实现的
2. 多应用：http://servername/index.php /应用/控制器/操作/参数/值……
3. 单应用：http://servername/index.php /控制器/操作/参数/值……
4. 由于tp6默认是单应用模式，多应用需要作为扩展安装
5. http://servername 是域名地址，如：127.0.0.1:8000
6. index.php是根目录下public下的index.php入口文件
7. 控制器：app目录下有一个controller控制器目录Index.php控制器
8. Index.php控制器的类名也必须是class Index
9. 操作就是控制器类里面的方法，比如：index或者hello
10. 完整形式：http://ldz.tp6.com/test/hello/value/world

```
<?php
namespace app\controller;

class Test
{
    public function hello($value = ''){
        return 'hello '.$value;
    }
}
```

11. public/index.php中的index.php可以省略，只要设置URL重写即可
12. httpd.conf配置文件中加载了mod_rewrite.so模块
13. AllowOverride None将None改为All

**注：某些情况下根目录public文件夹下的.htaccess不起作用，需要做如下修改：**

```
倒数第二行修改：

RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
修改为
RewriteRule ^(.*)$ index.php?/$1 [QSA,PT,L]
```

