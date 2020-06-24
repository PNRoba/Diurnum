<!doctype html>
<html lang="en">
<head>
    <title>Tasks</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <meta http-equiv="X-UA-Compatible" content="le-edge">
    <title>Add Task</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
        <div class="container">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background: #832648; color: white; padding: 10px;">
                            Add Task To Calendar
                        </div>
                        <div class="panel-body">
                            <h1>Task: Add Data</h1>
                            <form method="POST" action="{{action('taskControler@store')}}">
                            {{ csrf_field() }}
                            <p>Please select:</p>
                            <input type="radio" id="exists" value="exists" onclick="javascript:yesnoCheck();" name="key">
                            <label for="exists">Select Existing Keyword</label><br>
                            <input type="radio" id="new" value="new" onclick="javascript:yesnoCheck();" name="key">
                            <label for="new">Create New Keyword</label><br>
                            <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                            <label for="">Enter Task Name</label>
                            <input type="text" class="form-control" name="title" placeholder="Name of the task"><br><br>
                            
                            <div id="ifYes">
                                <label for="">Select Existing Keyword</label>
                                <select class="form-control" name="name1" id="name1">
                                @foreach($keywords as $keyword)
                                    @if(Auth::user()->id == $keyword->user_id)
                                       <option value="{{ $keyword->name }}" >{{ $keyword->name }}</option>
                                       <div id="{{ $keyword->name }}" style="display:none">
                                            <table style="background:{{ $keyword->color }}; width: 10px; height: 10px;"><tr><td></td></tr></table>
                                       </div>
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
                            
                            <label for="">Enter Start Date</label>
                            <input type="datetime-local" class="form-control" name="start_date" class="date" placeholder="Enter start date><br><br>
                            <label for="">Enter End Date</label>
                            <input type="datetime-local" class="form-control" name="end_date" class="date" placeholder="Enter end date"><br><br>
                            <input type="submit" name="submit" class="btn btn-primary" value="Add">
                            <a href="/tasks" class="btn btn-danger">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>