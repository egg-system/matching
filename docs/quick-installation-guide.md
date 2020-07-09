# 環境構築の方法ガイド
## 大前提
- dockerをインストールする
    - https://www.docker.com/get-started
    - windowsの場合、OSはhomeになるので、docker toolboxをインストールする
        - https://docs.docker.com/toolbox/toolbox_install_windows/

### dockerコンテナの作成
- srcフォルダ内の`.env.example`をコピーして、`.env`を作成する
- `docker-compose up -d --build`を実行する
    - 2回目以降は、`docker-compose up -d`を実行する
- artisanコマンドを使うなど、コンテナ内に入りたい時は以下を使う
    - `docker exec -it match-app bash`

## Laravel
### laravelの初期設定
- コンテナに入る
    - `docker exec -it match-app bash`
- DBのmigrationとseedを実行する
    - `php artisan migrate --seed`

### 起動
```
// Laravel Mixの実行
$ npm run dev
(開発時に変更を監視する場合は $npm run hot)

// laravelの起動
$ php artisan serve
```

### 新規アカウント作成
- Mailtrapのアカウント作成&`.env`ファイルを修正
    - 参考：https://qiita.com/ubonsa/items/5514fb9c5d5783bcc758
    - `.env`は`MAIL_USERNAME`・`MAIL_PASSWORD`・`MAIL_FROM_ADDRESS`を修正する（`MAIL_FROM_ADDRESS`はなんでも良い）
- トップページ（`/`）でメールアドレスを入力し、アカウント作成するとmailtrapに本登録用のURLが送られるのでそこから本登録を行う

### git hooksの反映
* 環境構築時に以下のコマンドを打つことでcommit時にphpmdでのチェックを走らせるなどの設定を反映（※ hooksの設定を更新した際にも必要）
    ```
    $ cd src
    $ vendor/bin/cghooks update
    ```
