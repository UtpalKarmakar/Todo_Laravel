<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    function homepage()
    {
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
            return to_route('allTodos')->with('msg', [
                'type' => 'error',
                'res' => 'Error creating Todo'
            ]);
        }
    }

    function editTodo($id)
    {
        try {
            $todo = Todo::findOrFail($id);
            return view('Edit', compact('todo'));
        } catch (\Throwable $th) {
            return to_route('allTodos')->with('msg', [
                'type' => 'error',
                'res' => 'Error editing Todo'
            ]);
        }
    }

    function deleteTodo($id)
    {
        try {
            Todo::find($id)->delete();
            return to_route('allTodos')->with('msg', [
                'type' => 'success',
                'res' => 'Todo deleted successfully'
            ]);
        } catch (\Throwable $th) {
            return to_route('allTodos')->with('msg', [
                'type' => 'error',
                'res' => 'Error deleting Todo'
            ]);
        }
    }

    function updateTodo(Request $request, $id)
    {
        $request->validate([
            'title' => 'required | min: 5 | max: 20',
            'description' => 'nullable | max : 200',
            'date' =>  'required | afterOrEqual : today',
        ], [
            'title.required' => 'You must enter a title',

        ]);

        try {
            Todo::findOrFail($id)->update($request->all());
            return to_route('allTodos')->with('msg', [
                'type' => 'success',
                'res' => 'Todo updated successfully'
            ]);
        } catch (\Throwable $error) {
            return to_route('allTodos')->with('msg', [
                'type' => 'error',
                'res' => 'Error updating Todo'
            ]);
        }
    }
}
