<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function edit(Thread $thread)
    {
        $this->authorize('update', $thread);

        $categories = Category::get();


        return view('thread.edit', compact('categories', 'thread'));
    }

    public function update(Request $request, Thread $thread)//Actualizar esa pregunta en base a lo que se envie del formulario
    {
        $this->authorize('update', $thread);

        //validar
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);

        //actualizar a la pregunta que recibe, con los datos enviados desde el formulario
        $thread->update($request->all());

        //redirigir a la vista de esa pregunta
        return redirect()->route('thread', $thread);
    }

    public function create(Thread $thread)//crear pregunta
    {
        $categories = Category::get();


        return view('thread.create', compact('categories', 'thread'));
    }

    public function store(Request $request, Thread $thread)
    {
        //validar
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);

        //crear a partir del usuario loggeado
        auth()->user()->threads()->create($request->all());

        //redirigir a la vista de esa pregunta
        return redirect()->route('dashboard');
    }
}
