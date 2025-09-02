<x-app-layout>
    {{-- Page Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            🎯 {{ $quiz->title }}
        </h2>
    </x-slot>

    {{-- Optional Title Slot --}}
    <x-slot name="title">
        {{ $quiz->title }}
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg sm:rounded-xl border border-gray-200">
                <div class="p-8">
                    {{-- Guest Restriction Message --}}
                    @if (!$quiz->public && !auth()->check())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md">
                            <p>
                                This quiz is available only for registered users.  
                                Please 
                                <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:underline">Log in</a> 
                                or 
                                <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:underline">Register</a>.
                            </p>
                        </div>
                    @else
                        {{-- Quiz Livewire Component --}}
                        <div class="space-y-6">
                            @livewire('front.quizzes.show', ['quiz' => $quiz])
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
