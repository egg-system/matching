<div id="pwReset">
  <div class="wrapper">
    <div class="logo">
        <img src="http://ogyawan.com/wp-content/uploads/2020/08/logo_msg.png" alt="borderlessGYM">
        <div>パスワード再設定ページ</div>
    </div>

    <div class="userInfo">
        <form
            action="{{ route('login.password.email') }}"
            method="post"
            class="pw-form-container"
        >
        @csrf
        <div>
            <label for="email_address">メールアドレス</label>
            <input id="email_address" name="email" type="email">
            <input type="hidden" name="user_type" value="{{ $userType }}">
        </div>
        <div>
          <input type="submit" value="パスワード再設定メールを送信する">
        </div>
      </form>
    </div><!-- .userInfo -->
  </div><!-- .wrapper -->
</div><!-- #forgot -->

<div class="footer">
  &copy; 2020 EGG SYSTEM, Inc.
</div><!-- .footer -->
