### 一个分享作品的网站,浏览地址:
```url
	http://101.200.52.189:9876/home/index
```


### 使用教程

#### 首先，下载代码

#### 重命名配置文件
```
	mv env.example .env
```

#### 编辑配置文件.env

```php
	...
	DB_DATABASE=
	DB_USERNAME=
	DB_PASSWORD=
	...  
	# 注册服务使用了sendcloud的邮箱服务
	SEND_CLOUD_USER=
	SEND_CLOUD_KEY=
```

#### 编辑config/ddl.php文件
```php
	// 邮箱来源
    'email' => 'xxxx',
    // 邮箱模版  -> sendcloud 中自定义的邮箱模版
    'email_template' => 'xxxx',
```

#### 执行迁移数据库命令，以及数据填充命令
```php
	php artisan migrate   // 迁移数据库
	php artisan db:seed   // 数据填充
```


#### 生成key
```php
	php artisan key:generate
```


#### 如果不想使用邮箱服务，可在app/DDL/Services/AuthService.php 中暂停邮件服务 注释掉即可, 位于67行-74行



