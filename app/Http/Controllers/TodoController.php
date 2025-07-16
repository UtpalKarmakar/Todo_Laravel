<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    function homepage()
    {
        //* Logic......

        return view('Homepage');
    }

    function allTodos()
    {
        $todos = Todo::orderBy('status', 'asc')->latest()->paginate(4);
        return view('AllTodos', compact('todos'));
    }

    function storeTodo(Request $request)
    {
        //* Validation....
        $request->validate([
            'title' => 'required | min: 5 | max: 20',
            'description' => 'nullable | max : 200',
            'date' =>  'required | afterOrEqual : today',
        ], [
            'title.required' => 'You must enter a title',

        ]);

        try {
            Todo::create($request->all());
            return to_route('allTodos')->with('msg', [
                'type' => 'success',
                'res' => 'Todo created successfully'
            ]);
        } catch (\Throwable $error) {
            dd($error);
        }
    }

    function deleteTodo($id)
    {
        try {
            Todo::find($id)->delete();
            return back()->with('msg', [
                'type' => 'success',
                'res' => 'Todo deleted successfully'
            ]);
        } catch (\Throwable $th) {
            return back()->with('msg', [
                'type' => 'error',
                'res' => 'Error deleting Todo'
            ]);
        }
    }
}
