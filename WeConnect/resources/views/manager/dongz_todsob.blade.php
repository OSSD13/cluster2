@extends('layouts.layout_manager')
<body>
    @section('content')
<div
    x-data="{ tags: [], newTag: '' }"
    class="w-full max-w-md mx-auto mt-4"
>
    <!-- กล่องแท็ก -->
    <div class="flex flex-wrap gap-2 bg-white border p-2 rounded">
        <template x-for="(tag, index) in tags" :key="index">
            <div class="flex items-center px-2 py-1 bg-orange-200 rounded-full text-sm">
                <span x-text="tag"></span>
                <button @click="tags.splice(index, 1)" class="ml-1 text-red-500 hover:text-red-700">&times;</button>
            </div>
        </template>

        <!-- กล่องพิมพ์แท็ก -->
        <input
            x-model="newTag"
            @keydown.enter.prevent="
                if(newTag.trim() !== '') {
                    tags.push(newTag.trim());
                    newTag = '';
                }
            "
            type="text"
            placeholder="พิมพ์แท็ก แล้วกด Enter"
            class="flex-1 border-none focus:ring-0 text-sm"
        />
    </div>

    <!-- hidden input สำหรับส่งค่าไป controller -->
    <input type="hidden" name="tags" :value="tags.join(',')" />
</div>

<!-- อย่าลืมใส่ Alpine.js -->
<script src="//unpkg.com/alpinejs" defer></script>
@endsection
</body>
