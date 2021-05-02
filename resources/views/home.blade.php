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
    <body>
        <header>
            <div class="home_links">
                <a href="{{route('home')}}">Home</a>
                <a href="{{route('admin.main')}}">Área Administrativa</a>
                <a href="{{route('user.register')}}">Cadastre-se</a>
            </div>
            <div class="title_subtitle">
                <h1>Bem vindo(a) ao Dicas de Veículos</h1>
                <h2>Aqui você encontrará as melhores dicas para diversos modelos</h2>
            </div>
        </header>

        <article class="home_filters">
            <header class="filters_title">
                <h3>Filtros</h3>
            </header>
                <div>
                    <form class="home_filters_form" method="post" action="{{route('home.filter')}}">
                        @csrf
                        <label for="type">Tipo</label>
                        <select name="type">
                            <option value="0"></option>
                            @foreach($types as $type)
                            <option value="{{$type->id}}">{{$type->type}}</option>
                            @endforeach
                        </select>

                        <label for="brand">Marca</label>
                        <select name="brand">
                            <option value="0"></option>
                            @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->brand}}</option>
                            @endforeach
                        </select>

                        <label for="modelFilter">Modelo</label>
                        <input type="text" name="modelFilter" placeholder="Modelo do veículo...">

                        <label for="versionFilter">Versão</label>
                        <input type="text" name="versionFilter" placeholder="Versão do veículo...">
                        <input class="form_submit_button" type="submit" value="Filtrar">
                    </form>
                </div>
        </article>

        <article class="home_suggestions">
            <header class="title_subtitle">
                <h3 class="home_suggestions_title">Sugestões</h3>
            </header>
                @if(count($suggestions) >= 1)
                <table>
                    <tr>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Versão</th>
                        <th>Sugestão</th>
                    </tr>
                    @foreach($suggestions as $suggestion)
                    <tr>
                        <td>{{$suggestion->type()->first()->type}}</td>
                        <td>{{$suggestion->brand()->first()->brand}}</td>
                        <td>{{$suggestion->model}}</td>
                        <td>{{$suggestion->version}}</td>
                        <td>{{$suggestion->suggestion}}</td>
                    </tr>
                    @endforeach
                </table>
                @else
                <p class="center"><strong>Oops! Não foram encontrados resultados</strong></p>
                @endif
        </article>
    </body>
</html>
