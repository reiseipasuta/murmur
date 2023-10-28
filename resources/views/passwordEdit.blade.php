<x-layout>
    <x-slot name="title">
        MyPage
    </x-slot>

    <div class="contents">
        <div class="profileEditTitle">プロフィール編集</div>
        <form method="post" action="{{ route('passwordEdit', $user) }}">
            @method('PATCH')
            @csrf
            <div>
                新しいパスワード<input type="text" name="password">
                <button>編集</button>
            </div>
        </form>
    </div>

</x-layout>
