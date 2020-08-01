# 機能のリリース制御について
## 概要
- 以下のconfigで制御する想定
    - [release.php](../src/config/release.php)
    - `is_enabled = true`の場合、リリース状態になる
- 開発時は、環境変数により、機能を有効化させる想定

### middleware
- 以下のmiddlewareでリリース制御を実行している
    - [release.php](../src/app/Http/Middleware/CheckIsEnableRoute.php)
- route定義時に、`released:login`のようにmiddlewareを追加すると、リリース制御を実行する
    - 当該機能がリリースされていない限り、遷移できなくなる
        - 404を返す