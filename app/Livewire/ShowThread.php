<?php

namespace App\Livewire;

use App\Models\Thread;
use Livewire\Component;
use LiveWire\WithPagination;

class ShowThread extends Component
{
    //Variables para mostrar pregunta individual
    public Thread $thread;
    public $body = '';

    //Crea una respuesta para la pregunta
    public function postReply()
    {
        //validar
        $this->validate(['body' => 'required']);
        //crear respuesta
        auth()->user()->replies()->create([
            'thread_id' => $this->thread->id,
            'body' => $this->body
        ]);
        //refrescar
        $this->body = '';
    }

    public function render()
    {
        return view('livewire.show-thread', [
            'replies' => $this->thread
            ->replies()
            ->whereNull('reply_id')
            ->with('user','resplies.user','replies.replies')
            ->get()
        ]);
    }
}
