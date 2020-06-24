<!doctype html>
<html lang="en">
<head>
    <title>Tasks</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>


    <style>
        /* ... */
    </style>
</head>
<body>
        <div class="container">
            <div class="row">
                @if(Auth::check())
                <a href="/addtaskurl" class="btn btn-success">Add Task</a>
                <a href="/show" class="btn btn-primary">Edit Task</a>
                <a href="/logout" class="btn btn-primary" style="float:right;">Log out</a>       
                @endif
                @if(!Auth::check())
                <a href="/login" class="btn btn-primary" style="float:right; margin-right: 4px;">Log in</a>
                <a href="/register" class="btn btn-primary" style="float:right; margin-right: 4px;">Sign up</a>
                @endif
            </div>
            <br>
            <div class="row">
                @if(count($errors)>0)
                  <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                  </div>
                @endif
                
                @if(\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{\Session::get('success')}}</p>
                    </div>
                @endif
                
                @if(\Session::has('error'))
                    <div class="alert alert-danger">
                        <p>{{\Session::get('error')}}</p>
                    </div>
                @endif
                
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background: #832648; color: white; padding: 10px;">
                            Task Calendar
                        </div>
                        <div class="panel-body">
                            {!! $calendar->calendar() !!}
                            {!! $calendar->script() !!}
                        </div>
                        <div class="panel-heading" style="background: #832648; color: white; padding: 10px;">
                            Keywords
                        </div>
                        <div class="panel-body">
                            <table style="border:1px solid black;">
                            <thead>
                            <tr><th style="border:1px solid black;"> Keyword </th>
                            <th style="border:1px solid black;"> Color </th>
                            </thead>
                            <tbody>  
                            @foreach($keywords as $keyword)
                                @if($keyword->user_id == Auth::user()->id)
                                    <tr><td style="border:1px solid black;">{{ $keyword->name }}</td>
                                    <td style="background-color: {{ $keyword->color }} ; border:1px solid black;">{{ $keyword->color }}</td>
                                    </tr>
                                @endif    
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>