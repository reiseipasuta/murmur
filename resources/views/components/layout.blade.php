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
                <button class="mobileNone">検索</button>
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
                        <button>投稿</button>
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
        {{-- <div class="menu">
            @auth
                <div class="iconCircle">
                    <a href="{{ route('myPage') }}">
                        @if (Auth::user()->image === null)
                        <img class="iconImage" src="{{ asset('storage/images/default.png') }}" alt="">
                        @else
                        <img class="iconImage" src="{{ Storage::url(Auth::user()->image) }}" alt="">
                        @endif
                    </a>
                </div>
                <a href="{{ route('myPage') }}">{{ Auth::user()->name }}</a>
                <div>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <input type="submit" value="ログアウト">
                    </form>
                </div>
                <div class="btnFixed">
                    <a href="{{ route('create') }}"><span class="btnContent">New<br>Post</span></a>
                </div>
            @endauth
            @guest
                    <div class="iconCircle">
                        <img class="iconImage" src="{{ asset('storage/images/default.png') }}" alt="">
                    </div>
                    <span class="logout"><a href="{{ route('login') }}">ログイン</a></span>
                    <span class="logout"><a href="{{ route('register') }}">新規登録</a></span>

                </a>
            @endguest
        </div> --}}


    {{ $slot }}

    </div>

    <script>

document.querySelector('textarea').addEventListener('input', () => {
    if(document.querySelector('textarea').value.length > 169){

        document.getElementById('inputlength').style.color = "brown";
    }else{
        document.getElementById('inputlength').style.color = "black";
    }
    // document.getElementById('text').value.length
})


    //     const error = @json($errors);

    //     // if(!@json($errors).length){
    //     if(error == '[]' || '{}'){
    //     // if(!@json($errors) == '{}'){
    //         console.log(@json($errors));
    //         document.getElementById("modal-content").style.display = "block";
    // document.getElementById("modal-overlay").style.display = "block";
    //     }else{
    //         console.log('alse');
    //         console.log(@json($errors));
    //     }
//         document.getElementById('post').addEventListener('submit', e => {
//     e.preventDefault();

//     if (!($message = [])) {
//         document.getElementById('error').innerHTML = $message;
//         return;
//     }

//     e.target.submit();
// });
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
