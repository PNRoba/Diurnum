<!doctype html>
<html lang="en">
<head>
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
                <h1>Name of Task</h1>
                <hr>
                    <input type="hidden" name="_method" value="Update">    
            </div>
            <div class="form-group">
                <p>Select:</p>
                <input type="radio" id="exists" value="exists" onclick="javascript:yesnoCheck();" name="key">
                <label for="exists">Select Existing Keyword</label><br>
                <input type="radio" id="new" value="new" onclick="javascript:yesnoCheck();" name="key">
                <label for="new">Create New Keyword</label><br>
            </div>
            <div class="form-group">
                <label for="">Enter Task Name</label>
                <input type="text" class="form-control" name="title" placeholder="Name of the task" value="{{$tasks->title}}">               
            </div>
            <div id="ifYes">
                <label for="">Select Existing Keyword</label>
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
                <label for="">Enter New Keyword</label>
                <input type="text" class="form-control" name="name2" id="name2" placeholder="Enter Keyword"><br>
                <select class="form-control" name="public">
                <option value="">None</option>
                @foreach($publics as $public){
                    <option value="{{ $public->id }}">{{ $public->status }}</option> 
                @endforeach
                </select><br> 
                <input type="color" class="form-control" name="color" placeholder="Enter color"><br>
            </div>
                            
            <div class="form-group">
                <label for="">Enter Start Date</label>
                <input type="datetime-local" class="form-control" name="start_date" class="date" placeholder="Enter start date" value="{{$tasks->start_date}}">
            </div>
            <div class="form-group">
                <label for="">Enter End Date</label>    
                <input type="datetime-local" class="form-control" name="end_date" class="date" placeholder="Enter end date" value="{{$tasks->end_date}}">
            </div>
            {{ method_field('PUT') }}
                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                <a href="/tasks" class="btn btn-danger">Back</a>
        </div>
    </form>
</body>
</html>