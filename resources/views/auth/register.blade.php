<x-layout>
    <x-slot name="title">
        MyPage
    </x-slot>

    <div class="contents">
        {{-- <div class="flextate"> --}}
            <form class="flextate" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="flextate">
                    <!-- Name -->
                    <div>
                        <div class="flex">
                            <div class="square"></div>
                            <x-input-label for="name" :value="__('名前')" />
                        </div>
                        <x-text-input id="name" class="block mt-1 w-full registerInput" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <div class="flex">
                            <div class="square"></div>
                            <x-input-label for="email" :value="__('メールアドレス')" />
                        </div>
                        <x-text-input id="email" class="block mt-1 w-full registerInput" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <div class="flex">
                            <div class="square"></div>
                            <x-input-label for="password" :value="__('パスワード')" />
                        </div>
                        <x-text-input id="password" class="block mt-1 w-full registerInput"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <div class="flex">
                            <div class="square"></div>
                            <x-input-label class="registerText" for="password_confirmation" :value="__('パスワード（確認）')" />
                        </div>
                        <x-text-input id="password_confirmation" class="block mt-1 w-full registerInput"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <div class="flex">
                            <div class="square"></div>
                            <x-input-label class="registerText" for="password_confirmation" :value="__('プロフィール')" />
                        </div>
                        <textarea name="body" id="text" onkeyup="ShowLength(value);" required maxlength="200">{{ old('body') }}</textarea>
                        <p class="length">
                            <span id="inputlength">0</span><span>/200文字</span>
                        </p>
                        <x-input-error :messages="$errors->get('profile')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <div class="flex">
                            <div class="square"></div>
                            <x-input-label class="registerText" for="password_confirmation" :value="__('アイコン画像 (10MB以内)')" />
                        </div>
                        <input name="image" type="file" value="" accept="image/png, image/jpeg">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a> --}}

                        <x-primary-button class="postBtn">
                            {{ __('登録') }}
                        </x-primary-button>
                    </div>

                </div>

            </form>
        </div>
    </div>
</x-layout>
