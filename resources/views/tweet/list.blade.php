<x-layout>
    <x-slot name="title">
        edit
    </x-slot>

{{-- @php dd($user); @endphp --}}
    <div class="contents">
        <h3>{{ $user->name }}</h3>

        @foreach ($tweets as $tweet)
            <li>
                {{ $tweet->body }}
                {{ $tweet->created_at }}
            </li>

        @endforeach
        <div class="test">aaaaa</div>
        <a href="{{ route('index') }}">戻る</a>
    </div>

</x-layout>
