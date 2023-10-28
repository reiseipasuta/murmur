<x-layout>
    <x-slot name="title">
        create
    </x-slot>

    <div class="contents">
        <div class="title">
            新規投稿
        </div>

        <form method="POST" action="{{ route('store') }}">
            @csrf
            <textarea name="body" onkeyup="ShowLength(value);">{{ old('body') }}</textarea>
            <p>
                <span id="inputlength">0</span><span>/200文字</span>
            </p>
            @error('body')
                <div>{{ $message }}</div>
            @enderror
            <button>投稿</button>
        </form>
    </div>
<script>
    //     function ShowLength( str ) {
    //     document.getElementById("inputlength").innerHTML = str.length + "文字";
    //  }
</script>
</x-layout>
