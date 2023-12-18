<div class="mx-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex gap-10 py-12">
        <!-- Sidebar Categorias -->
    <div class="w-64">
        <a href="{{ route('threads.create')}}" class="block w-full py-4 mb-10 bg-gradient-to-r from-fuchsia-400 to-fuchsia-700 hover:to-fuchsia-600 text-fuchsia-50 font-bold text-xs text-center rounded-md">
            Ask
        </a>
        <ul>
            @foreach($categories as $category)
            <li class="mb-2">
                <a href="#" wire:click.prevent="filterByCategory( {{ $category->id}})" class="p-2 rounded-md flex bg-fuchsia-950 bg-opacity-50  items-center gap-2 text-fuchsia-50 hover:text-fuchsia-50 font-semibold text-xs capitalize">
                    <span class="w-2 h-2 rounded-full" style="background-color:{{ $category->color}};"></span>
                    {{ $category->name}}
                </a>
            </li>
            @endforeach
            <li>
                <a href="#" wire:click.prevent="filterByCategory( {{$category->id }})" class="p-2 rounded-md flex bg-fuchsia-800 items-center gap-2 text-fuchsia-50 hover:text-fuchsia-50 font-semibold text-xs capitalize">
                    <span class="w-2 h-2 rounded-full" style="background-color:#000"></span>
                    All Results
                </a>
            </li>

        </ul>
    </div>
    <div class="w-full">
        <!-- Formulario -->
        
        <form class="mb-4">
            <input type="text" 
            placeholder="I'm looking for..."
            class="bg-zinc-900 border-1 border-fuchsia-900 rounded-md w-1/3 p-3 text-white/60 text-xs"
            wire:model.live="search">
            >
        </form>
        <!-- Preguntas -->
        @foreach($threads as $thread)
        <div class="rounded-md bg-gradient-to-r from-zinc-900 to-zinc-950 hover:to-zinc-800 mb-4">
            <div class="p-4 flex gap-4">
                <div>
                    <img src="{{ $thread->user->avatar() }}" alt="{{ $thread->user->name }}" class="rounded-md">
                </div>
                <div class="w-full">
                    <h2 class="mb-4 flex items-start justify-between">
                        <a href="{{ route('thread' , $thread)}}" class="text-xl font-semibold text-fuchsia-50">
                            {{ $thread ->title}}
                        </a>
                        <span class="rounded-full text text-xs py-2 px-4 capitalize" 
                        style="color:{{ $thread->category->color}}; border: 1px solid{{ $thread->category->color}};">
                            {{ $thread->category->name}}
                        </span>
                    </h2>
                    <p class="flex items-center justify-between w-full text-xs">
                        <span class="text-fuchsia-600 font-semibold">
                            {{ $thread->user->name }}

                            <span class="text-fuchsia-50"> {{ $thread->created_at->diffForHumans() }}</span>
                        </span>
                        <span class="flex items-center gap-1 text-zinc-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                              </svg>

                            {{ $thread->replies_count }}
                            Response{{ $thread->replies_count !== 1 ? 's' : '' }}

                            @can('update', $thread)
                            |
                            <a href="{{ route('threads.edit', $thread)}}" class="hover:text-fuchsia-50">
                                Edit
                            </a>
                            @endcan
                            </span>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
