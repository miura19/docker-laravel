<div>
    {{ $email }}さん、30分以内に下記URLから本登録を行ってください。
</div>
<div>
    <a href="{{ route('movie.finish', ['token' => $token]) }}">本登録はこちら</a>
</div>