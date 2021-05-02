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
    <body class="register_page">
        <article>
            <header class="login_title_subtitle">
                <h1>Cadastro de Usuário</h1>
            </header>
            <div>
                <form class="register_login_form" method="post" action="{{route('user.register.do')}}">
                    @csrf
                    <input type="text" name="name" placeholder="Nome:" required>
                    <input type="email" name="email" placeholder="E-mail:" required>
                    <input type="password" name="password" placeholder="Senha:" required>
                    <input class="form_submit_button" type="submit" value="Cadastrar">
                </form>
                <div class="register_login_form_link">
                    <a href="{{route('admin.login')}}">Já possui cadastro?</a>
                </div>
            </div>
        </article>
    </body>
</html>