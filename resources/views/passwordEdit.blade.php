<x-layout>
    <x-slot name="title">
        MyPage
    </x-slot>

    <div class="contents">
        <div class="profileEditTitle">パスワード編集</div>
        <form method="post" action="{{ route('passwordEdit', $user) }}">
            @method('PATCH')
            @csrf
            <div>
                <div>
                    @if (session('worning'))
                        <div>
                            {{ session('worning') }}
                        </div>
                    @endif

                    <div class="square"></div>現在のパスワード<input class="bottomMar10 leftMar10" type="text" name="oldPassword" value="{{ old('oldPassword') }}">

                </div>
                <div>
                    <div class="square"></div>新しいパスワード<input class="bottomMar10 leftMar10" type="text" name="password"  value="{{ old('password') }}">
                    @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                </div>
                <div>
                    <div class="square"></div>新しいパスワード(確認)<input  class="bottomMar10 leftMar10" type="text" name="password_confirmation"  value="{{ old('password_confirmation') }}">
                    @if (session('check'))
                        <div>
                            {{ session('check') }}
                        </div>
                    @endif
                </div>
                <button class="postBtn">編集</button>
            </div>
        </form>
    </div>

</x-layout>
