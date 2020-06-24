<?php

namespace App\Http\Controllers;
use App\task;
use App\Keyword;
use App\Calendar;
use App\Publics;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class taskControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()){
        $user = Auth::user();
        $keywords = Keyword::all();
        $publics = Publics::all();
        $task = [];

        $filter = '';
        $selectparams = array($user->id);
        if ($_GET['keyword']) {
            $filter = " AND k.name=?";
            $selectparams[] = $_GET['keyword']; 
        } 
        $tasks = DB::select("SELECT t.* FROM tasks t 
            INNER JOIN calendars c ON t.id=c.tasks_id 
            INNER JOIN keywords k ON c.keywords_id=k.id 
            WHERE c.user_id=?" . $filter, $selectparams);

        foreach($tasks as $row){
        $enddate = $row->end_date." 24:00:00";
            $task[] = \Calendar::Event(
            $row->title,
            false,
            new \DateTime($row->start_date),
            new \DateTime($row->end_date),
            $row->id,
            [
               'color' => $row->color,
            ]
            );
        }
        $calendar = \Calendar::addEvents($task);
        return view('taskpage', ['keywords'=>$keywords, 'publics'=>$publics], compact('tasks','calendar'));
        }
        else{
        $user = Auth::user();
        $keywords = Keyword::all();
        $publics = Publics::all();
        $task = [];

        $tasks = task::all();

        foreach($tasks as $row){
        $enddate = $row->end_date." 24:00:00";
            $task[] = \Calendar::Event(
            $row->title,
            false,
            new \DateTime($row->start_date),
            new \DateTime($row->end_date),
            $row->id,
            [
               'color' => $row->color,
            ]
            );
        }
        $calendar = \Calendar::addEvents($task);
        return view('taskpage', ['keywords'=>$keywords, 'publics'=>$publics], compact('tasks','calendar'));
        }
    }
    public function display(){
        $keywords = Keyword::all();
        $publics = Publics::all();
        return view('addtask', ['keywords'=>$keywords, 'publics'=>$publics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check())
        {
            $this->validate($request,[
                'title' => 'required',
                'color' => 'required',
                'start_date' => 'required',
                'end_date' => 'required'
            ]);

            if($request->input('key')=='new'){
                $tasks = new task;
                $tasks->title = $request->input('title');
                $tasks->color = $request->input('color');
                $tasks->start_date = $request->input('start_date');
                $tasks->end_date = $request->input('end_date');
                $tasks->save();
                $keywords = new Keyword;
                $keywords->name = $request->input('name2');
                $keywords->color = $request->input('color');
                $keywords->public = $request->input('public');
                $keywords->user_id = $request->input('user_id');
                $keywords->save();
                
                $task = task::all()->sortByDesc('id')->first();
                $keyword = Keyword::all()->sortByDesc('id')->first();
                
                $calendars = new Calendar;
                $calendars->user_id = $request->input('user_id');
                $calendars->keywords_id = $keyword->id;
                $calendars->tasks_id = $task->id;
                $calendars->save();
            }
            elseif($request->input('key')=='exists'){
                $tasks = new task;
                $tasks->title = $request->input('title');
                
                $keywords = Keyword::all();
                foreach($keywords as $keyword){
                    if($request->get('name1') == $keyword->name){
                        $tasks->color = $keyword->color;
                        $keyword_id = $keyword->id;
                    }
                }
                
                $tasks->start_date = $request->input('start_date');
                $tasks->end_date = $request->input('end_date');
                $tasks->save();
                
                $task = task::all()->sortByDesc('id')->first();
                
                $calendars = new Calendar;
                $calendars->user_id = $request->input('user_id');
                $calendars->keywords_id = $keyword_id;
                $calendars->tasks_id = $task->id;
                $calendars->save();
            }
            return redirect('tasks')->with('success','Task Added');       
        }
        else
        {
            return redirect('/login')->with('error','Must be logged in'); /// redirect to login page
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (Auth::check()){
            $user = Auth::user();
            $keywords = Keyword::all();
            $tasks = \DB::select('SELECT t.* FROM tasks t INNER JOIN calendars c ON t.id=c.tasks_id WHERE user_id=?', array($user->id));
            return view('display',['keywords'=>$keywords, 'tasks'=>$tasks]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check())
        {   
            $tasks = task::find($id);
            $keywords = Keyword::all();
            $publics = Publics::all();
            $calendars = Calendar::all();
            foreach($calendars as $calendar){
                if($calendar->tasks_id == $id){
                    $keyid = Keyword::find($calendar->keywords_id);
                }
            }
            return view('edittask', ['keywords'=>$keywords, 'publics'=>$publics, 'keyid'=>$keyid], compact('tasks', 'id'));         
        }
        else
        {
            return redirect('/login')->with('error','Must be logged in'); /// redirect to login page
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'color' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        $user = Auth::user();
        if($request->input('key')=='new'){
                $tasks = task::find($id);
                $tasks->title = $request->input('title');
                
                $tasks->color = $request->input('color');
                
                $tasks->start_date = $request->input('start_date');
                $tasks->end_date = $request->input('end_date');
                
                $tasks->save();
                $keywords = new Keyword;
                $keywords->name = $request->input('name2');
                $keywords->color = $request->input('color');
                $keywords->public = $request->input('public');
                $keywords->user_id = $request->input('user_id');
                $keywords->save();
                
                $task = task::all()->sortByDesc('id')->first();
                $keyword = Keyword::all()->sortByDesc('id')->first();
                
                $calendars = Calendar::where('tasks_id', $id)->first();
                $calendars->user_id = $user->id;
                $calendars->keywords_id = $keyword->id;
                $calendars->save();
            }
            elseif($request->input('key')=='exists'){
                $tasks = task::find($id);
                $tasks->title = $request->input('title');
                
                $keywords = Keyword::all();
                foreach($keywords as $keyword){
                    if($request->get('name1') == $keyword->name){
                        $tasks->color = $keyword->color;
                        $keyword_id = $keyword->id;
                    }
                }
                
                $tasks->start_date = $request->input('start_date');
                $tasks->end_date = $request->input('end_date');
                $tasks->save();               
                
                $task = task::all()->sortByDesc('id')->first();
                
                $calendars = Calendar::where('tasks_id', $id)->first();
                $calendars->user_id = $user->id;
                $calendars->keywords_id = $keyword_id;
                $calendars->save();
            }
        
        return redirect('tasks')->with('success','Task Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check())
        {
            $tasks = task::find($id);
            $tasks->delete();
            $calendars = Calendar::where('tasks_id', $id)->first();
            $keyid = $calendars->keywords_id;
            $calendars->delete();
            $keywordslist=Calendar::where('keywords_id', $keyid)->get();
            if($keywordslist->count()==0){
                $keyword = Keyword::find($keyid);
                $keyword->delete();
            }
            return redirect('/show')->with('success','Task Deleted');         
        }
        else
        {
            return redirect('/login')->with('error','Must be logged in'); /// redirect to login page
        }    
    }
}
