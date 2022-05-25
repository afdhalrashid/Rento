<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\TodoTitle;
use Illuminate\Support\Facades\Auth;
use Carbon\carbon;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (request()->ajax()) {
        //     return $this->todoApi();
        // }

        $todoLists = TodoTitle::selectRaw('todos.user_id, todo_titles.id, todo_titles.title, todos.tasks, todo_titles.created_at')
            ->join('todos', 'todoTitle_id', '=', 'todo_titles.id')
            ->where('todos.user_id', auth()->user()->id)
            // ->where('todos.user_id', 1)
            // ->where('todo_titles.readTitle', 0)
            // ->groupByRaw('todo_titles.title')
            ->orderBy('created_at', 'DESC')
            ->get();

        $todoPending = Todo::query()
            // ->where('todos.user_id', auth()->id)
            ->with('task')
            ->where('user_id', auth()->user()->id)
            ->where('tasks', '<>', NULL)
            ->where('completed', '=', 0)
            // ->groupByRaw('todo_titles.title')
            ->orderBy('created_at', 'DESC')
            ->get();
        // dd($todoPending);
        return view('todo.index', compact('todoLists', 'todoPending'));
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
        $rules = [
            'title' => 'required'
        ];

        $messages = [
            'title.required' => 'Nama tugasan perlu diisi'
        ];

        $validator = $this->validation($rules, $messages);

        $title = TodoTitle::create($validator);

        Todo::create(
            [
                'user_id' =>  auth()->user()->id,
                'todoTitle_id' =>  $title->id
            ]
        );
        // $validator = $request->validate([
        //     'todoTitle_id' => 'required',
        // ], $messages);

        return [
            'msg' => 'Tugasan berjaya disimpan',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $todo['todoTitle_id'] = $todo->task->title;
        $todos = TodoTitle::with('tasks')
            ->where('id', $id)
            ->first();
        // dd($todos->tasks);
        $todos->dateline =  ($todos->dateline !== NULL) ? carbon::parse($todos->dateline)->format('d/m/Y') : "";

        if ($todos->readTitle === 0) {
            $todos->update(
                [
                    'readTitle' => 1
                ]
            );
        }

        $todoView = view('modal.todo.addTask', compact('todos'))->render();

        return response()->json(
            [
                'todo' => $todoView,
                'todo_data' => $todos
            ]
        );
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
        $dateline = Carbon::createFromFormat('d/m/Y', $request->dateline)->toISOString();
        // dd($dateline->toISOString());
        $rules = [
            'title' => 'required',
        ];

        $messages = [
            'title.required' => 'A Title is required'
        ];

        $validator = $this->validation($rules, $messages);

        TodoTitle::find($id)
            ->update(
                [
                    'title' => $request->title,
                    'dateline' => $dateline,
                    'day_notify' => $request->day_notify
                ]
            );

        foreach ($request->task as $key => $arr) {
            /*foreach ($arr as $key => $value) {
                echo "$value / ";
            }*/
            $input = $request->task[$key];
            // $input['user_id'] = $user->id;
            $input['user_id'] = auth()->user()->id;
            // $input['user_id'] = 1;
            $input['completed'] =  (!array_key_exists('completed', $input)) ? 0 : 1;
            $input['todoTitle_id'] = $id;
            unset($input['todo_id']);

            Todo::updateorcreate(
                [
                    'id' => $request->task[$key]['todo_id']
                ],
                $input
            );
        }

        return [
            'msg' => 'Kemaskini berjaya',
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->link !== '#') {
            Todo::where('todoTitle_id', $id)->delete();
            TodoTitle::destroy($id);
        } else {
            Todo::destroy($id);
        }

        return [
            'msg' => 'Tugasan berjaya dibuang',
            'titleId' => request()->titleId,
            'link' => request()->link,
        ];
    }

    public function todoApi()
    {
        /*$todoLists = TodoTitle::with('tasks')
        ->whereUserId(1)
        ->paginate(10);*/
        $current_date = carbon::now('ASIA/KUALA_LUMPUR');
        $get_reminder = false;

        $reminders = TodoTitle::selectRaw('DATE_FORMAT(dateline, "%Y-%m-%d") AS new_dateline, day_notify, completed')
            ->join('todos', 'todoTitle_id', '=', 'todo_titles.id')
            ->where('todos.user_id', auth()->user()->id)
            ->groupByRaw('new_dateline, day_notify, completed')
            ->get();
            // ->pluck('day_notify', 'new_dateline');

        /*foreach($reminders as $date => $reminder){
            $dateline = carbon::parse($date);
            $notify = $dateline->diffInDays($current_date);

            if ($notify <= $reminder) {
                $get_reminder = true;
            }
        }*/

        foreach($reminders as $reminder){
            $dateline = carbon::parse($reminder->new_dateline);
            $notify = $dateline->diffInDays($current_date);

            if ($notify <= $reminder->day_notify && $reminder->completed == 0) {
                $get_reminder = true;
            }
        }
        // dd($get_reminder);
        $todoLists = TodoTitle::selectRaw('todos.user_id, todo_titles.id, todo_titles.title, todo_titles.dateline, todo_titles.day_notify, todos.tasks, todos.completed')
            ->join('todos', 'todoTitle_id', '=', 'todo_titles.id')
            // ->where('todos.user_id', 1)
            ->where('todos.user_id', auth()->user()->id)
            // ->groupByRaw('todos.user_id, todo_titles.id,todo_titles.title,todos.tasks, todos.completed')
            ->groupByRaw('todo_titles.title')
            ->orderBy('todo_titles.created_at', 'DESC')
            // ->get();
            ->paginate(10);
        // dd($reminders);

        $completed = Todo::selectRaw('todoTitle_id, completed, COUNT(completed) AS total')
            // ->where('user_id', 1)
            ->where('user_id', auth()->user()->id)
            ->where('tasks', '<>', NULL)
            ->groupByRaw('todoTitle_id, completed')
            ->get();

        $status = [];

        foreach ($completed as $key => $value) {
            if ($value->completed == 0) {
                $status[$value->todoTitle_id]['pending'] =  $value->total;
            }

            if ($value->completed == 1) {
                $status[$value->todoTitle_id]['completed'] =  $value->total;
            }
        }

        // dd($status);

        $todoView = view('todo.list', compact('todoLists', 'status', 'current_date'))->render();

        return response()->json(
            [
                'todoView' => $todoView,
                'status' => $status,
                'get_reminder' => $get_reminder,
            ]
        );
    }

    public function validation($rules, $msg)
    {
        return request()->validate($rules, $msg);
    }
}