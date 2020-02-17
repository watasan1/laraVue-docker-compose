# はじめに
CroWish勉強会専用の『Laravel + Vue』の環境をサクッと構築できるものです。

#準備
Dockerがinstallされていること

※windows 32bitではDockerが使用できません

- [windows自分のパソコンが 32 ビット版か 64 ビット版かを確認したい](https://support.microsoft.com/ja-jp/help/958406)
- [docker for windows install](https://ops.jig-saw.com/tech-cate/docker-for-windows-install)
- [docker for mac install](https://qiita.com/kurkuru/items/127fa99ef5b2f0288b81)


#構築手順
```
$ git clone [url]

$ docker-compose up -d

$ docker ps 

<!-- laravel 作成 -->
$ docker exec -it [phpコンテナID] bash

# laravel new --auth

# exit

<!-- vue-cli 作成 -->
$ docker exec -it app sh

# vue create frontend
? Please pick a preset: default (babel, eslint) 
❯ default
  other

? Pick the package manager to use when installing dependencies: (Use arrow keys)
  Use Yarn 
❯ Use NPM 

$ cd frontend
$ npm run serve
```

## 確認
**laravel**
http://localhost:80

**vue**
http://localhost:8080

##データベースとつなげてみよう！

```:.env
DB_CONNECTION=mysql
DB_HOST=db-host
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=docker
DB_PASSWORD=docker
```



<!--　現状不要fuyou -->
###注意点
**A. MySQLの認証方式の問題**

この状態で`php artisan migrate`をするとエラーが出ます。理由は以下の通りです。

- MySQL8.0.4以降 のログイン認証方式は caching_sha2_password がデフォルト
- PHPのMySQL接続ライブラリが caching_sha2_password　に未対応のため接続不可
- 解決策としては認証方式を mysql_native_password に戻す

```
# mysql -uroot -p
passwrod: root

mysql> select user, host, plugin from mysql.user;
+------------------+-----------+-----------------------+
| user             | host      | plugin                |
+------------------+-----------+-----------------------+
| docker           | %         | caching_sha2_password |
| root             | %         | caching_sha2_password |
| mysql.infoschema | localhost | caching_sha2_password |
| mysql.session    | localhost | caching_sha2_password |
| mysql.sys        | localhost | caching_sha2_password |
| root             | localhost | caching_sha2_password |
+------------------+-----------+-----------------------+

mysql> alter user 'docker'@'%' identified with mysql_native_password by 'docker';
mysql> alter user 'root'@'%' identified with mysql_native_password by 'root';
```

```
# php artisan migrate
```


#豆
Dockerfileを書き換えた時
```
// Dockerfileをビルドして、コンテナを作成
$ docker-compose up -d --build
```




# Laravel
```
$ php artisan make:controller ContactController -r

$ php artisan make:model Models/Contact -m
```


##既存のUserのディレクトリ移動
https://qiita.com/vrvr/items/4755e758f5d4b2e07579



# 流れ
- demo
- docker環境構築
- laravel / vueプロジェクト作成
- DBとの接続（マイグレーション）
- modelsへの移動
- contact 一覧取得API作成
  - restapiテスト
  - バリデーション

- vueのページ作成
- cors設定
  - config参照
- 新規作成 / 編集 / 削除 

- axiosの設定ファイル作成
- definitionsディレクトリ作成

<!-- extra -->
- 認証作成
  - jwt認証
  - メール認証
  - アカウントロック




  #payload 

  ```
{
"contacts": {
"first_name": "kami",
"last_name": "makoto",
"phone_number": "080-0000-0000",
"house_phone_number": "080-0000-0000",
"email": "kami@gmail.com",
"address": "東京都",
"birthday": "1999-06-10",
"memo": "",
"gender": 1
}
}
  ```

  https://woinc.jp/differences-between-delete-and-destroy-on-laravel/




# ビルドが通らない場合(コピペ)
  ```:php/Dockerfile
  FROM php:7.2-fpm
COPY php.ini /usr/local/etc/php/

RUN apt-get update \
  && apt-get install -y zlib1g-dev mariadb-client \
  && docker-php-ext-install zip pdo_mysql

#Composer install
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

ENV COMPOSER_HOME /composer

ENV PATH $PATH:/composer/vendor/bin


WORKDIR /var/www

RUN composer global require "laravel/installer"
  ```