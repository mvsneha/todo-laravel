<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TodoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = Auth::id();

        $todos = Todo::where('completed', 0)
                    ->where('user_id', $id)
                    ->orderBy('created_at', 'desc')->get();

        return view('todo', [
            'todos' => $todos
        ]);
    }

    /**
     * Display a listing of completed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function completed(Request $request)
    {
        $id = Auth::id();

        $todos =  Todo::where('completed', 1)
                        ->where('user_id', $id)
                        ->orderBy('id', 'desc')->get();

        return view('todo', [
            'todos' => $todos,
            'completed' => true
        ]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required|string|max:255'
        ]);

        if($request->id)
        {
            $todo = Todo::findOrFail($request->id);
            $todo->body = $request->description;
            $todo->user_id = Auth::id();
            $todo->save();
        }
        else
        {

            Todo::create([
                'body' => $request->description,
                'user_id' => Auth::id(),
            ]);
        }

        return redirect('/todo');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Auth::id();

        $todo = Todo::find($id);
        $todos = Todo::where('completed', 0)
                    ->where('user_id', $user_id)
                    ->orderBy('created_at', 'asc')->get();

        return view('todo', [
            'todos' => $todos,
            'todo' => $todo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|string|max:255'
        ]);

        $todo = Todo::findOrFail($request->id);
        $todo->body = $request->body;
        $task->save();

        return redirect('/todo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);

        $todo->delete();

        return redirect('/todo');
    }

    /**
     * Marked the resources as completed
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function markAsCompleted(Request $request)
    {
        $todo = Todo::find($request->id);
        $todo->completed = 1;
        $todo->save();
        return redirect('/todo');
    }
}
