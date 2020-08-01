# 機能のリリース制御について
## 概要
- 以下のconfigで制御する想定
    - [release.php](../src/config/release.php)
    - `is_enabled = true`の場合、リリース状態になる
- 開発時は、環境変数により、機能を有効化させる想定

## 今後の実装展望
- route名を指定して、middlewareの制御を追加する
- gateを追加して、条件を満たすユーザーにしか表示できないようにする
