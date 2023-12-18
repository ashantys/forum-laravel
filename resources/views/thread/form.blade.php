<div>
    <select 
        name="category_id" 
        class="bg-zinc-900 border-1 border-fuchsia-900 rounded-md w-full p-3 text-white/60 text-xs capitalize mb-4"
    >
        <option value="">Select category</option>

        @foreach ($categories as $category)
                <option 
                    value="{{ $category->id }}"
                    
                    @if (old ('category_id',$thread->category_id) == $category->id)
                    selected
                    @endif
                    >{{ $category->name }}</option>
        @endforeach
    </select>

    <input 
        type="text" 
        name="title" 
        placeholder="Title"
        class="bg-zinc-900 border-1 border-fuchsia-900 rounded-md w-full p-3 text-white/60 text-xs mb-4"
        value="{{ old('title', $thread->title) }}"
    >

    <textarea 
        name="body" 
        rows="10"
        placeholder="Problem description"
        class="bg-zinc-900 border-1 border-fuchsia-900 rounded-md w-full p-3 text-white/60 text-xs mb-4"
    >{{ old('body', $thread->body) }}</textarea>
</div>
