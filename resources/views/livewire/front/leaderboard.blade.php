<div>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-700 leading-tight">
            🏆 Leaderboard
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-indigo-50 via-white to-pink-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border border-indigo-200">
                <div class="p-6 text-gray-900">
                    
                    {{-- Quiz Filter --}}
                    <select class="p-3 w-full text-sm leading-5 rounded-lg border border-indigo-300 shadow-sm text-slate-700 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition"
                        wire:model="quiz_id">
                        <option value="0">🌍 All Quizzes</option>
                        @foreach ($quizzes as $quiz)
                            <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                        @endforeach
                    </select>

                    {{-- Leaderboard Table --}}
                    <table class="mt-6 w-full border-collapse rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white">
                                <th class="px-6 py-3 text-left w-9">#</th>
                                <th class="px-6 py-3 text-left w-1/2">
                                    <span class="text-xs font-bold uppercase tracking-wider">Username</span>
                                </th>
                                <th class="px-6 py-3 text-left">
                                    <span class="text-xs font-bold uppercase tracking-wider">Quiz</span>
                                </th>
                                <th class="px-6 py-3 text-left">
                                    <span class="text-xs font-bold uppercase tracking-wider">Correct Answers</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tests as $test)
                                <tr @class([
                                    'bg-indigo-50' => $loop->odd,
                                    'bg-pink-50' => $loop->even,
                                    'border-b border-gray-200 hover:bg-indigo-100 transition',
                                    'bg-yellow-100 font-semibold' => auth()->check() && $test->user->name == auth()->user()->name,
                                ])>
                                    <td class="px-6 py-4 text-sm text-gray-800">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-indigo-700">
                                        {{ $test->user->name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $test->quiz->title }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 font-bold">
                                        <span class="px-2 py-1 rounded bg-green-100 text-green-700">
                                            {{ $test->result }}
                                        </span>
                                        / {{ $test->quiz->questions_count }}
                                        <span class="ml-2 text-xs text-gray-500 italic">
                                            ⏱ {{ sprintf('%.2f', $test->time_spent / 60) }} min
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-6 text-gray-500">
                                        🚫 No results found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
