<?php

namespace App\Livewire;

use App\Models\Reply;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShowReply extends Component
{
    use AuthorizesRequests;

    public Reply $reply;
    public $body = '';
    public $is_creating = false;
    public $is_editing = false;

    protected $listeners = ['refresh' => '$refresh'];

        //Para que se visualice el texto a editar
        public function updatedIsCreating()
        {
            $this->is_editing = false; 
            $this->body = '';
        }

        //Para que se visualice el texto a editar
        public function updatedIsEditing()
        {
            $this->authorize('update', $this->reply);

            $this->is_creating = false; //si estamos editando, entonces, creating no se activa

            $this->body = $this->reply->body;
        }

        //Editar respuesta para actualizar
        public function updateReply()
        {
            $this->authorize('update', $this->reply); //sobre las politicas // update es el nombre del método en las políticas
            
            //validar
            $this->validate(['body' => 'required']);

            //actualizar
            $this->reply->update(['body' => $this->body]);

            //refrescar
            $this->is_editing = false;
        }

        //Crea una respuesta para la pregunta
        public function postChild()
        {
            if( ! is_null($this->reply->reply_id)) return; //evitar multiples niveles de respuesta

            //validar
            $this->validate(['body' => 'required']);

            //crear respuesta
            auth()->user()->replies()->create([
                'reply_id' => $this->reply->id,
                'thread_id' => $this->reply->thread->id,
                'body' => $this->body
            ]);

            //refrescar
            $this->is_creating = false;
            $this->body = '';
            $this->dispatch('refresh')->self();
        }

    public function render()
    {
        return view('livewire.show-reply');
    }
}
