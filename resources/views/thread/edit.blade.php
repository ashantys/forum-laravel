<x-app-layout>
    <div class="mx-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="rounded-md bg-gradient-to-r from-zinc-900 to-zinc-950 mb-4">
            <div class="p-4">
                    <h2 class="mb-1 text-xl font-semibold text-fuchsia-50">
                        Edit answer
                    </h2>

                    <form action="{{ route('threads.update', $thread)}}" method="POST">
                        @csrf
                        @method('PUT')

                        @include('thread.form')

                        <button 
                            type="submit" 
                            class="w-full py-4 bg-gradient-to-r from-fuchsia-400 to-fuchsia-700 hover:to-fuchsia-600 text-fuchsia-50 font-bold text-xs rounded-md">
                            Edit anwer
                        </button>
                    </form>
            </div>
        </div>
    </div>
</x-app-layout>