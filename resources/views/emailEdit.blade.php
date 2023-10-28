<x-layout>
    <x-slot name="title">
        MyPage
    </x-slot>

    <div class="contents">
        <div class="profileEditTitle">プロフィール編集</div>
        <form method="post" action="{{ route('emailEdit', $user) }}">
            @method('PATCH')
            @csrf
            <div>
                新しいメールアドレス<input type="text" name="email">
                <button>編集</button>
            </div>
        </form>
    </div>

</x-layout>
