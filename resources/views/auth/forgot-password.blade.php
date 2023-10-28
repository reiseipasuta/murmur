<x-layout>
    <x-slot name="title">
        Login
    </x-slot>

    <div class="contents">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('登録したメールアドレスを入力してください。パスワード変更用のメールを送信します。') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('メールアドレス')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('メールを送信する') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-layout>
