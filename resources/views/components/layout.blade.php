<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://kit.fontawesome.com/b126c05739.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="header">
        <div class="logo">
            <a href="{{ route('index') }}">MurMur＊</a>
        </div>
        <div class="search">
            <form class="mobile" action="{{ route('index') }}" method="get">
                @csrf
                <input type="text" name="keyword" value="@if (isset($keyword)) {{ $keyword }} @endif" placeholder="検索">
                <button class="mobileNone searchBtn">検索</button>
                {{-- {{ $errors }} --}}
            </form>
        </div>
        @auth
            <div class="rightLink">
                <div class="iconCircle">
                    <a href="{{ route('myPage') }}">
                        @if (Auth::user()->image === null)
                        <img class="iconImage" src="{{ asset('storage/images/default.png') }}" alt="">
                        @else
                        <img class="iconImage" src="{{ asset('storage/images/'.Auth::user()->image) }}" alt="">
                        @endif
                    </a>
                </div>
            </div>

            <div class="headerMenu">
                <div>
                    <a href="{{ route('myPage') }}">
                        <i class="fa-solid fa-user fa-xl"></i>
                        {{ Auth::user()->name }}
                    </a>
                </div>
                <div>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btnNone">
                            <i class="fa-solid fa-right-from-bracket fa-xl"></i>
                            ログアウト
                        </button>
                    </form>
                </div>
            </div>
            <div class="btnFixed"  onclick="modal_onclick_open();">
                    <span class="btnContent">New<br>Post</span>
            </div>
            <!-- モーダルウィンドウ -->

            <div id="modal-content">
                <div class="contents newPostIpad">
                    <div class="title">
                        <i class="fa-solid fa-pen-nib rightMar5" style="color: #424f67;"></i>新規投稿
                    </div>

                    <form method="POST" action="{{ route('store') }}" id="post" enctype="multipart/form-data">
                        @csrf
                        <textarea name="body" id="text" onkeyup="ShowLength(value);" required maxlength="200">{{ old('body') }}</textarea>
                        <p class="length">
                            <span id="inputlength">0</span><span>/200文字</span>
                        </p>
                        @error('body')
                            <div>{{ $message }}</div>
                        @enderror
                        <input type="file" name="image" accept="image/*, video/*">
                        <div>（300MB以内）</div>
                        @error('image')
                            <div>{{ $message }}</div>
                        @enderror
                        <button class="postBtn">投稿</button>
                    </form>
                </div>
                <div class="close">
                        <a id="modal-close" onclick="modal_onclick_close();">
                        <i class="fa-solid fa-xmark rightMar5"></i>
                        閉じる
                    </a>
                    </div>
            </div>
            <!-- 2番目に表示されるモーダル -->
            <div id="modal-overlay" onclick="modal_onclick_close();"></div>

            <!-- モーダルウィンドウここまで -->
        @endauth
        @guest
            <div class="rightLink">
                <div class="iconCircleGuest">
                    <img class="iconImage" src="{{ asset('storage/images/default.png') }}" alt="">
                </div>
            </div>
            <div class="headerMenuGuest">
                <div class="logout">
                    <a href="{{ route('guestLogin') }}">
                        <i class="fa-regular fa-face-smile fa-xl"></i>
                        簡単ログイン
                    </a>
                    {{-- <form method="POST" action="{{ route('guestLogin') }}">
                        @csrf
                        <i class="fa-regular fa-face-smile fa-xl"></i>
                        <button class="btnNone">簡単ログイン</button>
                    </form> --}}
                </div>
                <div class="logout">
                    <a href="{{ route('login') }}">
                        <i class="fa-solid fa-right-to-bracket fa-xl"></i>
                        ログイン
                    </a>
                </div>
                <div class="logout">
                    <a href="{{ route('register') }}">
                        <i class="fa-regular fa-pen-to-square fa-xl"></i>
                        新規登録
                    </a>
                </div>
            </div>

            </a>
        @endguest
    </div>
    <div class="container">

    {{ $slot }}

    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
