<x-layout>
    <x-slot name="title">
        edit
    </x-slot>

    <div class="contents">
        <form method="post" action="{{ route('updateComment', ['tweet' => $tweet, 'comment' => $comment]) }}">
            @method('PATCH')
            @csrf
            <textarea name="body">{{ $comment->body }}</textarea>
            @error('body')
                <div>{{ $message }}</div>
            @enderror
            <button>投稿</button>
        </form>
        <form action="{{ route('destroyComment', ['tweet' => $tweet, 'comment' => $comment]) }}" method="post" id="delete">
            @method('DELETE')
            @csrf
            <button>削除</button>
        </form>

        <script>
            'use strict';

            {
                document.getElementById('delete').addEventListener('submit', e => {
                    e.preventDefault();

                    if (!confirm('削除しますか？')) {
                        return;
                    }

                    e.target.submit();
                });
            }
        </script>
    </div>

</x-layout>
