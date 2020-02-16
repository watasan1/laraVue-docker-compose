# はじめに
CroWish勉強会専用の『Laravel + Vue』の環境をサクッと構築できる資料です

# 準備
Dockerがinstallされていること

※windows 32bitではDockerが使用できません

- [windows自分のパソコンが 32 ビット版か 64 ビット版かを確認したい](https://support.microsoft.com/ja-jp/help/958406)
- [docker for windows install](https://ops.jig-saw.com/tech-cate/docker-for-windows-install)
- [docker for mac install](https://qiita.com/kurkuru/items/127fa99ef5b2f0288b81)


# 構築手順
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

## データベースとつなげてみよう！

```:.env
DB_CONNECTION=mysql
DB_HOST=db-host
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=docker
DB_PASSWORD=docker
```



<!--　現状不要fuyou -->
### 注意点
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


# 豆
Dockerfileを書き換えた時
```
// Dockerfileをビルドして、コンテナを作成
$ docker-compose up -d --build
```
