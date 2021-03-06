<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                <a href="/addtaskurl" class="btn btn-success">{{ __('messages.Add_Task') }}</a>
                <a href="/show" class="btn btn-primary">{{ __('messages.Edit_Task') }}</a>
                <a href="/search" class="btn btn-primary">{{ __('messages.Search_for_keywords') }}</a>
                <a href="/logout" class="btn btn-primary" style="float:right;">{{ __('messages.Log_out') }}</a>       
                @endif
                
                @if(!Auth::check())
                <a href="/search" class="btn btn-primary">{{ __('messages.Search_for_keywords') }}</a>
                <a href="/login" class="btn btn-primary" style="float:right; margin-right: 4px;">{{ __('messages.Log_in') }}</a>
                <a href="/register" class="btn btn-primary" style="float:right; margin-right: 4px;">{{ __('messages.Sign_up') }}</a>
                @endif


                <a href="/lang/lv" class="btn" style="float:right; margin-right: 4px;">LV</a>
                <a href="/lang/en" class="btn" style="float:right; margin-right: 4px;">EN</a>

            </div>
            <br>
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
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background: #832648; color: white; padding: 10px;">
                            {{ __('messages.Task_Calendar') }}
                        </div>
                        <div class="panel-body">
                            {!! $calendar->calendar() !!}
                            {!! $calendar->script() !!}
                        </div>
                        @if(Auth::check())  
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
                                    <tr><td style="border:1px solid black;"><a href="/tasks?keyword={{ $keyword->name }}">{{ $keyword->name }}</a></td>
                                    <td style="background-color: {{ $keyword->color }} ; border:1px solid black;">{{ $keyword->color }}</td>
                                    </tr>
                                @endif    
                            @endforeach
                            <tr><td style="border:1px solid black;"><a href="/tasks">{{ __('messages.ALL') }}</a></td>
                            <td style="border:1px solid black;"></td>
                            </tr>
                            </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
</body>
</html>