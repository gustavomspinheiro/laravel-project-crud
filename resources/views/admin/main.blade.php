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
        <article>
            <div class="admin_header">
                <h3>Área administrativa</h3>
                <a href="{{route('admin.logout')}}">Logout</a>
            </div>
            <div>
                <header class="title_subtitle">
                     <h4>Cadastro de novas sugestões de veículos</h4>
                </header>
                <div>
                    <form method="post" class="admin_filters_form" action="{{route('admin.suggestion')}}">
                    @csrf
                        <select name="type">
                            @foreach($types as $type)
                            <option value="{{$type->id}}">{{$type->type}}</option>
                            @endforeach
                        </select>
                        <select name="brand">
                            @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->brand}}</option>
                            @endforeach
                        </select>
                        <input type="text" name="model" placeholder="Modelo" required>
                        <input type="text" name="version" placeholder="Versão" required>
                        <input type="textarea" name="suggestion" placeholder="Sugestão">
                        <input type="submit" class="form_submit_button admin_submit_button" value="Cadastrar">
                    </form>
                </div>
                
            </div>
        </article>

        <article class="admin_suggestions">
            <div>
                <h3>Minhas sugestões</h3>
                @if(count($mySuggestions) >= 1)
                <table>
                    <tr>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Versão</th>
                        <th>Sugestão</th>
                    </tr>
                    @foreach($mySuggestions as $mySuggestion)
                    <tr>
                        <td>{{$mySuggestion->type()->first()->type}}</td>
                        <td>{{$mySuggestion->brand()->first()->brand}}</td>
                        <td>{{$mySuggestion->model}}</td>
                        <td>{{$mySuggestion->version}}</td>
                        <td>{{$mySuggestion->suggestion}}</td>
                    </tr>
                    @endforeach
                </table>
                @else
                <p class="center"><strong>Oops! Não foram encontrados resultados</strong></p>
                @endif
            </div>
        </article>
    </body>
</html>