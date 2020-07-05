# デザインのルール
## 概要
画面は、Atomic Desingに従って作成する
- [参考][https://design.dena.com/design/atomic-design-%E3%82%92%E5%88%86%E3%81%8B%E3%81%A3%E3%81%9F%E3%81%A4%E3%82%82%E3%82%8A%E3%81%AB%E3%81%AA%E3%82%8B/]

Vueのコンポーネントは[storybook][https://sharp-edison-14627b.netlify.app]で管理する

### bladeとVueの使い分け
bladeとvueの使い分けを適切に管理しなければ、デザイン修正が困難になる
そのため、Atomic Designのレイヤーで使い分ける
また、フォルダもレイヤー単位で分割する

#### blade
bladeは以下のレイヤーで実装する
- pages
    - 基本的に、ルート単位での管理を想定
        - `view`関数で使うファイルを想定
- templates
    - `@extends`で使うファイルを想定
- components
    - 以下の場合に限り、使用する想定
        - Vueコンポーネントを呼び出すためのラッパーとして使用する
        - 例外的に、Vueを使用することが困難な場合に使用する

#### Vue
Vueは以下のレイヤーで実装する
- atoms
    - 子のいないコンポーネントを想定
- molecules
    - `emit-props`だけで状態管理するコンポーネントを想定
- organisms
    - `vuex`などで管理するコンポーネントを想定

## storybook
### 概要
コンポーネントの仕様などを管理を行うためのツール
基本的に、コンポーネントを追加した際は、storyを作成する

### 書き方
下記のstep4を参照
- https://storybook.js.org/docs/guides/guide-vue/

localで確認する際は、`npm --prefix ./src run storybook`を実行する

### 備考
push後にbuildされるが、失敗することもある
    - 以下で確認可能
    - [![Netlify Status](https://api.netlify.com/api/v1/badges/1274dfe9-9079-462e-bf3b-89ea5f4f4ba5/deploy-status)](https://app.netlify.com/sites/sharp-edison-14627b/deploys)
