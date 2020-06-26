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
                <table class="table table-striped table-bordered table-hover">
                    <thead class="thead">
                        <tr class="warning">
                            <th> {{ __('messages.ID') }} </th>
                            <th> {{ __('messages.Name') }} </th>
                            <th> {{ __('messages.Keyword') }} </th>
                            <th> {{ __('messages.Color') }} </th>
                            <th> {{ __('messages.Start_date') }} </th>
                            <th> {{ __('messages.End_date') }}</th>
                            <th> {{ __('messages.Update') }} </th>
                            <th> {{ __('messages.Delete') }} </th>
                        </tr>
                    </thead>
                    @foreach($tasks as $task)

                    <tbody>
                        <tr>
                            <td>{{$task->id}}</td>
                            <td>{{$task->title}}</td>
                            <td>
                            @foreach($keywords as $keyword)
                                @if($user->roles_id == 1 && $keyword->color == $task->color)
                                    {{ $keyword->name }}
                                @elseif($keyword->user_id == Auth::user()->id && $keyword->color == $task->color)
                                    {{ $keyword->name }}
                                @endif    
                            @endforeach
                            </td>
                            @foreach($keywords as $keyword)
                                @if($user->roles_id == 1 && $keyword->color == $task->color)
                                    <td style="background-color: {{ $keyword->color }};">{{$task->color}}</td>
                                @elseif($keyword->user_id == Auth::user()->id && $keyword->color == $task->color)
                                    <td style="background-color: {{ $keyword->color }};">{{$task->color}}</td>
                                @endif    
                            @endforeach
                            <td>{{$task->start_date}}</td>
                            <td>{{$task->end_date}}</td>
                            <th>
                                <a href="{{action('taskControler@edit', $task->id)}}" class="btn btn-success">
                                    <i class="glyphicon glyphicon-edit"></i> {{ __('messages.Edit') }}
                                </a>
                            </th>
                            <th>
                            <form method="POST" action="{{action('taskControler@destroy', $task->id)}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="Delete">
                                <button type="submit" class="btn btn-danger">
                                    <i class="glyphicon glyphicon-edit"></i> {{ __('messages.Delete') }}
                                </button>
                            </form>
                            </th>
                        </tr>
                    </tbody>
                    
                    @endforeach
                </table>
                <a href="/tasks" class="btn btn-danger">{{ __('messages.Back') }}</a>    
            </div>
        </div>
</body>
</html>