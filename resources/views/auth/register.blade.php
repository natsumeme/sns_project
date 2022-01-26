@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<h2>新規ユーザー登録</h2>

{{ Form::label('UserName') }}
<br>
{{ Form::text('username',null,['class' => 'input']) }}
<!--エラーが起こった時にエラー文を表示させる-->
@if($errors->has('username'))
{{$errors->first('username')}}
@endif
<br>
{{ Form::label('MailAdress') }}
<br>
{{ Form::text('mail',null,['class' => 'input']) }}
@if($errors->has('mail'))
{{$errors->first('mail')}}
@endif
<br>
{{ Form::label('Password') }}
<br>
{{ Form::password('password',['class' => 'input']) }}
@if($errors->has('password'))
{{$errors->first('password')}}
@endif
<br>
{{ Form::label('Password confirm') }}
<br>
{{ Form::password('password-confirm',null,['class' => 'input']) }}
@if($errors->has('password-confirm'))
{{$errors->first('password-confirm')}}
@endif
<br>
{{ Form::submit('REGISTER') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
