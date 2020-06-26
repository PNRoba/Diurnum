<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tasks</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <meta http-equiv="X-UA-Compatible" content="le-edge">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
        <div class="container">
            <div class="row">
            <form method="POST" action="{{action('taskControler@search')}}">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="q" value="{{ $search }}"
                        placeholder="{{ __('messages.Search_for_keywords') }}"> <span class="input-group-btn">
                        <input type="submit" name="submit" class="btn btn-primary" value="{{ __('messages.Search') }}">
                    </span>
                </div>
            </form>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="thead">
                        <tr class="warning">
                            <th> {{ __('messages.Keyword') }} </th>
                            <th> {{ __('messages.Color') }} </th>
                            <th> {{ __('messages.Created_by') }} </th>
                            <th> {{ __('messages.View') }} </th>
                        </tr>
                    </thead>
                    @foreach($keywords as $keyword)

                    <tbody>
                        <tr>
                            <td>{{$keyword->name}}</td>
                            <td style="background-color: {{ $keyword->color }};">{{$keyword->color}}</td>
                                    <td>{{ $keyword->username }}</td>
                            <td>
                                <a href="/tasks?keyword={{ $keyword->name }}" class="btn btn-success">
                                    {{ __('messages.View') }}
                                </a>
                            </td>
                        </tr>
                    </tbody>
                    
                    @endforeach
                </table>
                <a href="/tasks" class="btn btn-danger">{{ __('messages.Back') }}</a>    
            </div>
        </div>
</body>
</html>