<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::orderBy('name')->withCount('todoitems')->get();
        return view('todo.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("todo.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:4|max:20',
        ]);

        $todo = new Todo;
        $todo->name = request("name");
        $todo->save();

        return redirect(route("todo.index"))->with('success', ' Todo Created Succesufuly');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        // $mitarbeiter = $abteilung->mitarbeiters()->count();
        return view('todo.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        return view('todo.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'name' => 'required|min:4|max:20',
        ]);

        $todo->update($request->all());
        return redirect()->route('todo.index')->with('success', 'Todo Updated Succesufuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todoitem = $todo->todoitems()->count();
        if (empty($todoitem)) {
            $todo->delete();
            if (request()->ajax()) {
                return response()->json(['status' => 200, 'id' => $todo->id]);
            }
            return redirect()->route('todo.index')->with('success', 'Todo Deleted Succesufuly');
        }
        if (request()->ajax()) {
            return response()->json(['status' => 480, 'msg' => 'Todo Cannnot Deleted']);
        }
        return redirect()->route('todo.index')->with('error', 'Todo Cannnot Deleted');
    }
}
