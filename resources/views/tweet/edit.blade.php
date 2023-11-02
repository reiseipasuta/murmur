<x-layout>
    <x-slot name="title">
        edit
    </x-slot>

    <div class="contents">
        <form class="mobileForm" method="post" action="{{ route('update', $tweet) }}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <textarea name="body">{{ $tweet->body }}</textarea>
            @error('body')
                <div>{{ $message }}</div>
            @enderror
            <span class="smallBold">画像変更</span>
            <input type="file" name="image" accept="image/*, video/*">
            <button class="postBtn">投稿</button>
        </form>

        <div class="deleteButton">
            <form action="{{ route('destroy', $tweet) }}" method="post" id="delete">
                @method('DELETE')
                @csrf
                <button>削除</button>
            </form>
        </div>
    </div>

</x-layout>
