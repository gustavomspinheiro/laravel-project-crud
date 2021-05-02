<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dicas de Veículos</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{url('/styles/styles-min.css')}}">
    </head>
    <body class="login_page">
        <article>
            <header class="login_title_subtitle">
                <h1>Login</h1>
                <h4>Insira seu e-mail e senha para realizar se autenticar</h4>
            </header>
            <div>
                <form class="register_login_form" method="post" action="{{route('admin.login.do')}}">
                    @csrf
                    @if($errors->all())
                        @foreach($errors->all() as $error)
                            <div>
                                <span class="alert_message">{{$error}}</span>
                            </div>
                        @endforeach
                    @endif
                    <input type="email" name="email" placeholder="E-mail:" required>
                    <input type="password" name="password" placeholder="Senha:" required>
                    <input class="form_submit_button" type="submit" value="Login">
                </form>
                <div class="register_login_form_link">
                    <a href="{{route('home')}}">Voltar para Home</a>
                </div>
            </div>
        </article>
    </body>
</html>