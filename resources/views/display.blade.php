<!doctype html>
<html lang="en">
<head>
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
                            <th> ID </th>
                            <th> Name </th>
                            <th> Keyword </th>
                            <th> Color </th>
                            <th> Start date </th>
                            <th> End date</th>
                            <th> Update </th>
                            <th> Delete </th>
                        </tr>
                    </thead>
                    @foreach($tasks as $task)

                    <tbody>
                        <tr>
                            <td>{{$task->id}}</td>
                            <td>{{$task->title}}</td>
                            <td>
                            @foreach($keywords as $keyword)
                                @if($keyword->user_id == Auth::user()->id && $keyword->color == $task->color)
                                    {{ $keyword->name }}
                                @endif    
                            @endforeach
                            </td>
                            @foreach($keywords as $keyword)
                                @if($keyword->user_id == Auth::user()->id && $keyword->color == $task->color)
                                    <td style="background-color: {{ $keyword->color }};">{{$task->color}}</td>
                                @endif    
                            @endforeach
                            <td>{{$task->start_date}}</td>
                            <td>{{$task->end_date}}</td>
                            <th>
                                <a href="{{action('taskControler@edit', $task->id)}}" class="btn btn-success">
                                    <i class="glyphicon glyphicon-edit"></i> Edit
                                </a>
                            </th>
                            <th>
                            <form method="POST" action="{{action('taskControler@destroy', $task->id)}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="Delete">
                                <button type="submit" class="btn btn-danger">
                                    <i class="glyphicon glyphicon-edit"></i> Delete
                                </button>
                            </form>
                            </th>
                        </tr>
                    </tbody>
                    
                    @endforeach
                </table>
                <a href="/tasks" class="btn btn-danger">Back</a>    
            </div>
        </div>
</body>
</html>