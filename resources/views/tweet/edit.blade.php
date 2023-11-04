<x-layout>
    <x-slot name="title">
        edit
    </x-slot>

    <div class="contents">
        <div>
            <div class="square"></div>
            編集
        </div>
        <form class="mobileForm" method="post" action="{{ route('update', $tweet) }}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <textarea name="body" class="bottomMar10">{{ $tweet->body }}</textarea>
            @error('body')
                <div>{{ $message }}</div>
            @enderror
            <div>
                <div class="square "></div>
                <p class="smallBold">画像変更</p>
            </div>
            <input type="file" name="image" accept="image/*, video/*">
            <button class="postBtn block">投稿</button>
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
