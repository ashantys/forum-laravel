<div>
        <div class="rounded-md bg-gradient-to-r from-zinc-900 to-zinc-950 hover:to-zinc-800 mb-4">
            <div class="p-4 flex gap-4">
                <div>
                    <img src="{{ $reply->user->avatar() }}" alt="{{ $reply->user->name }}" class="rounded-md">
                </div>
                <div class="w-full">
                    <p class="mb-2 text-fuchsia-600 font-semibold text-xs">
                            {{ $reply->user->name }}
                    </p>

                    @if ($is_editing)
                    <form wire:submit.prevent="updateReply" class="mt-4">
                        <input type="text" 
                        placeholder="Answer to this amazing question..."
                        class="bg-zinc-900 border-1 border-fuchsia-900 rounded-md w-full p-3 text-white/60 text-xs"
                        wire:model.defer="body">
                        >
                    </form>
                    @else
                        <p class="text-fuchsia-50 text-xs">{{ $reply->body }}</p>
                    @endif

                    @if ($is_creating)
                        <form wire:submit.prevent="postChild" class="mt-4">
                            <input type="text" 
                            placeholder="Answer to this amazing question..."
                            class="bg-zinc-900 border-1 border-fuchsia-900 rounded-md w-full p-3 text-white/60 text-xs"
                            wire:model.defer="body">
                            >
                        </form>
                    @endif
                    <p class="mt-4 text-fuchsia-600 text-xs flex gap-2 justify-end">
                        @if (is_null($reply->reply_id))
                        <span class="flex items-center gap-1 text-fuchsia-600 hover:text-fuchsia-50">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" /></svg>                              
                            <a href="#" wire:click.prevent="$toggle('is_creating')" class="hover:text-fuchsia-50">Answer</a>
                        </span>
                        @endif

                        @can ('update', $reply)
                        <span class="flex items-center gap-1 text-fuchsia-600 hover:text-fuchsia-50">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>                              
                            <a href="#"   wire:click.prevent="$toggle('is_editing')" class="hover:text-fuchsia-50">Edit</a>
                        </span>
                        @endcan
                    </p>
                </div>
            </div>
        </div>

        @foreach ($reply->replies as $item)
        <div class="ml-8">
            @livewire('show-reply', ['reply' => $item], key('reply-'.$item->id))
        </div>
        @endforeach
</div>
