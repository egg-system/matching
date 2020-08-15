<div id="pwReset" class="third">
  <div class="wrapper">
    <div class="logo">
      <img src="http://ogyawan.com/wp-content/uploads/2020/08/logo_msg.png" alt="borderlessGYM">
      <div>パスワード再設定ページ</div>
    </div>

    <div class="userInfo">
      <form
        action="{{ route('login.password.update') }}"
        method="post"
        class="pw-form-container"
      >
        @csrf
        <div>
          <h2>新しいパスワードを入力してください</h2>
          <label for="password">新しいパスワード</label>
          <div class="passwordParent">
            
            <input type="password" name="password"><span class="field-icon">
              <i toggle="#password-field" class="toggle-password fas fa-eye"></i></span>
            <input type="password" name="password_confirmation">
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="user_type" value="{{ $userType }}">
          </div>
        </div>
        <div>
          <input type="submit" value="パスワードの変更">
        </div>
      </form>
    </div><!-- .userInfo -->
  </div><!-- .wrapper -->
</div><!-- #forgot -->

<div class="footer">
  &copy; 2020 EGG SYSTEM, Inc.
</div><!-- .footer -->
