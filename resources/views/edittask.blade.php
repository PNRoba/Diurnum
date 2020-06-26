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

    <script type="text/javascript">
    window.onload = function() {
        document.getElementById('ifYes').style.display = 'none';
        document.getElementById('ifNo').style.display = 'none';
    }
    function yesnoCheck() {
        if (document.getElementById('exists').checked) {
            document.getElementById('ifYes').style.display = 'block';
            document.getElementById('ifNo').style.display = 'none';
        } 
        else if(document.getElementById('new').checked) {
            document.getElementById('ifNo').style.display = 'block';
            document.getElementById('ifYes').style.display = 'none';
        }
    }

    </script>
</head>
<body>
            
    <form action="{{action('taskControler@update', $id)}}" method="POST">
        {{ csrf_field() }}

        <div class="container">
            <div class="jumbotron" style="margin-top: 5%;">
                <h1>{{$tasks->title}}</h1>
                <hr>
                    <input type="hidden" name="_method" value="Update">    
            </div>
            <div class="form-group">
                <p>Select:</p>
                <input type="radio" id="exists" value="exists" onclick="javascript:yesnoCheck();" name="key">
                <label for="exists">{{ __('messages.Select_Existing_Keyword') }}</label><br>
                <input type="radio" id="new" value="new" onclick="javascript:yesnoCheck();" name="key">
                <label for="new">{{ __('messages.Create_New_Keyword') }}</label><br>
            </div>
            <div class="form-group">
                <label for="">{{ __('messages.Enter_Task_Name') }}</label>
                <input type="text" class="form-control" name="title" placeholder="{{ __('messages.Enter_Task_Name') }}" value="{{$tasks->title}}">               
            </div>
            <div id="ifYes">
                <label for="">{{ __('messages.Select_Existing_Keyword') }}</label>
                <select class="form-control" name="name1" id="name1">
                <option value="{{ $keyid->name }}" style="background:{{ $keyid->color }}">{{ $keyid->name }}</option>
                @foreach($keywords as $keyword)
                    @if(Auth::user()->id == $keyword->user_id && $keyid->id != $keyword->id)
                        <option value="{{ $keyword->name }}" style="background:{{ $keyword->color }}">{{ $keyword->name }}</option>
                    @endif
                @endforeach
                </select><br>
            </div>
                            
            <div id="ifNo">
                <label for="">{{ __('messages.Create_New_Keyword') }}</label>
                <input type="text" class="form-control" name="name2" id="name2" placeholder="{{ __('messages.Create_New_Keyword') }}"><br>
                <select class="form-control" name="public">
                <option value=""></option>
                @foreach($publics as $public){
                    <option value="{{ $public->id }}">{{ $public->status }}</option> 
                @endforeach
                </select><br> 
                <input type="color" class="form-control" name="color" placeholder="Enter color"><br>
            </div>
                            
            <div class="form-group">
                <label for="">{{ __('messages.Enter_Start_Date') }}</label>
                <input type="datetime-local" class="form-control" name="start_date" class="date" value="{{$tasks->start_date}}">
            </div>
            <div class="form-group">
                <label for="">{{ __('messages.Enter_End_Date') }}</label>    
                <input type="datetime-local" class="form-control" name="end_date" class="date" value="{{$tasks->end_date}}">
            </div>
            {{ method_field('PUT') }}
                <button type="submit" name="submit" class="btn btn-primary">{{ __('messages.Update') }}</button>
                <a href="/tasks" class="btn btn-danger">{{ __('messages.Back') }}</a>
        </div>
    </form>
</body>
</html>