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
                <div>
                    <div class="square"></div>新しいメールアドレス<input class="bottomMar10 leftMar10" type="text" name="email"  value="{{ old('password') }}">
                    @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                </div>
                <div>
                    <div class="square"></div>新しいメールアドレス(確認)<input  class="bottomMar10 leftMar10" type="text" name="email_confirmation"  value="{{ old('email_confirmation') }}">
                    @if (session('check'))
                        <div>
                            {{ session('check') }}
                        </div>
                    @endif
                </div>
                <div>
                    @if (session('worning'))
                        <div>
                            {{ session('worning') }}
                        </div>
                    @endif

                    <div class="square"></div>パスワード<input class="bottomMar10 leftMar10" type="text" name="password" value="{{ old('oldPassword') }}">

                </div>
                <button class="postBtn">編集</button>
            </div>
        </form>
    </div>

</x-layout>
