{{-- <a href="{{ route('password.reset', ['token' => $token]) }}">
    パスワード再設定リンク
  </a> --}}

  <p>{{ $user->name }}様</p><br>
<br>
<a href="{{ $url }}">{{ $url }}</a><br>
<br>
上記URLにアクセスし、パスワードの再設定を行ってください。<br>
有効期限は本メールを受信してから24時間となります。<br>