<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\TodoItem;
use Illuminate\Http\Request;

class TodoItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("todoitem.create");
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

        $todoitem = new TodoItem;
        $todoitem->name = request("name");
        $todoitem->todo_id = $request->input("todo_id");
        $todoitem->save();

        return redirect(route("todo.index"))->with('success', 'Todo Item Created Succesufuly');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TodoItem  $todoItem
     * @return \Illuminate\Http\Response
     */
    public function show(TodoItem $todoItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TodoItem  $todoItem
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todoItem = TodoItem::findOrFail($id);
        return view('todoitem.edit', compact('todoItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TodoItem  $todoItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:4|max:20',
        ]);
        $todoItem = TodoItem::findOrFail($id);
        $todoItem->name = request("name");
        $todoItem->save();
        return redirect()->route('todo.index')->with('success', 'Todo Item Updated Succesufuly');
    }






    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TodoItem  $todoItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todoItem = TodoItem::findOrFail($id);
        $todoItem->delete();
        if (request()->ajax()) {
            return response()->json(['status' => 200, 'id' => $todoItem->id]);
        }
        return redirect()->route('todo.index')->with('success', 'Todo Item Deleted Succesufuly');
        if (request()->ajax()) {
            return response()->json(['status' => 480, 'msg' => 'Todo Item Cannnot Deleted']);
        }
        return redirect()->route('todo.index')->with('error', 'Todo Item Cannnot Deleted');
    }
}
