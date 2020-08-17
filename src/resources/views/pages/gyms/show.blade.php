@extends('templates.app')

@push('styles')
    <link href="{{ mix('css/pages/gyms/show.css') }}" rel="stylesheet">
@endpush

@section('content')
<div id="jobVacancies">
  <div class="mv">
    <img src="{{ $gym->job->imageUrl }}" alt="ジム画像">
  </div>

  <div class="wrapper">
    <h1>{{ $gym->job->title }}</h1>
    <div class="company">{{ $gym->login->name }}</div>

    <div class="jobDetails">
      <h2>求人の内容</h2>
      <ul>
        <li>
          <dl>
            <dt>稼働日数</dt>
            <dd>週{{ $gym->matchingCondition->weekly_worktime }}日</dd>
          </dl>
        </li>
        <li>
          <dl>
            <dt>業務内容</dt>
            <dd>{{ $gym->job }}</dd>
          </dl>
        </li>
        <li>
          <dl>
            <dt>特徴</dt>
            <dd>・平日夜稼働可<br>・休日稼働可<br>・福利厚生あり</dd>
          </dl>
        </li>
      </ul>
    </div><!-- .jobDetails -->

    <div class="gymDetail">
      <div class="gym">
        <h2>ジムについて</h2>
        <div class="kv">
          <img src="https://anotherworks-bucket.s3.amazonaws.com/uploads/images/674659654/1914852c-5273-4349-a606-2cca3747b851.jpeg" alt="ジム画像">
        </div>
        <div class="content">
          <p>fis東京は地域密着型のパーソナルジムとして、御茶ノ水店・秋葉原駅前店・女性専用fis.lady's店・北千住店・豊洲店と展開しております。</p>
          <p>現在、より多くのお客様に真のフィットネス・ボディメイクを届けるため、共にお仕事をしていただけるパーソナルトレーナーを募集しております。</p>
          <p>fis東京は地域密着型のパーソナルジムとして、御茶ノ水店・秋葉原駅前店・女性専用fis.lady's店・北千住店・豊洲店と展開しております。</p>
          <p>現在、より多くのお客様に真のフィットネス・ボディメイクを届けるため、共にお仕事をしていただけるパーソナルトレーナーを募集しております。</p>
        </div>
      </div><!-- .gym -->

      <div class="seek">
        <h2>求める人物像</h2>
        <div class="content">
          <p>・成長意欲にあふれた方<br>・パーソナルトレーナーとして人の健康に携わりたい方<br>
            ・成長意欲にあふれた方<br>・パーソナルトレーナーとして人の健康に携わりたい方<br>
            ・成長意欲にあふれた方<br>・パーソナルトレーナーとして人の健康に携わりたい方
          </p>
        </div>
      </div><!-- .seek -->

      <div class="work">
        <h2>担当業務</h2>
        <div class="content">
          <p>・パーソナルトレーニング<br>
            ・食事・栄養指導
          </p>
        </div>
      </div><!-- .work -->

      <div class="about">
        <h2>ジム概要</h2>
        <ul>
          <li>
            <dt>ジム名</dt>
            <dd>株式会社GOKIGEN</dd>
          </li>
          <li>
            <dt>場所</dt>
            <dd>東京都 千代田区 有楽町 2-1-2 エクセル有楽町 2F</dd>
          </li>
        </ul>
      </div><!-- .about -->
    </div><!-- .gymDetail -->

  </div><!-- .wrapper -->
</div><!-- #jobVacancies -->
@endsection