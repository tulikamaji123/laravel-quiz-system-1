<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-8">

            {{-- Test Summary --}}
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-6 text-gray-900">
                    <h6 class="text-xl font-bold mb-4">📊 Test Summary</h6>

                    <table class="w-full border border-gray-200 text-sm">
                        <tbody>
                            @if (auth()->user()?->is_admin)
                                <tr>
                                    <th class="bg-gray-100 border px-4 py-2 text-left font-semibold">User</th>
                                    <td class="border px-4 py-2">
                                        {{ $test->user->name ?? '' }} ({{ $test->user->email ?? '' }})
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <th class="bg-gray-100 border px-4 py-2 text-left font-semibold">Date</th>
                                <td class="border px-4 py-2">
                                    {{ $test->created_at->format('D d/m/Y, h:i A') ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-gray-100 border px-4 py-2 text-left font-semibold">Result</th>
                                <td class="border px-4 py-2">
                                    <span class="font-bold text-green-600">{{ $test->result }}</span> / {{ $questions_count }}
                                    @if ($test->time_spent)
                                        <span class="text-gray-600 ml-2 text-sm">
                                            (time: {{ sprintf('%.2f', $test->time_spent / 60) }} minutes)
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Leaderboard --}}
            @isset($leaderboard)
                <div class="bg-white shadow-sm rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h6 class="text-xl font-bold mb-4">🏆 Leaderboard</h6>

                        <table class="w-full border border-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left">Rank</th>
                                    <th class="px-4 py-2 text-left">Username</th>
                                    <th class="px-4 py-2 text-left">Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaderboard as $test)
                                    <tr @class([
                                        'bg-gray-100 font-semibold' => auth()->user()->name == $test->user->name,
                                    ])>
                                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2">{{ $test->user->name }}</td>
                                        <td class="px-4 py-2">
                                            {{ $test->result }} / {{ $questions_count }}
                                            <span class="text-gray-600 text-sm">
                                                ({{ sprintf('%.2f', $test->time_spent / 60) }} min)
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endisset

            {{-- Detailed Results --}}
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-6 text-gray-900">
                    <h6 class="text-xl font-bold mb-6">📖 Question Details</h6>

                    @foreach ($results as $result)
                        <div class="mb-6">
                            <div class="mb-3">
                                <span class="font-semibold text-gray-700">
                                    Question #{{ $loop->iteration }}:
                                </span>
                                <span class="ml-2">{!! nl2br($result->question->text) !!}</span>
                            </div>

                            {{-- Options --}}
                            <ul class="list-disc ml-6 space-y-1">
                                @foreach ($result->question->options as $option)
                                    <li @class([
                                        'font-bold text-green-600' => $option->correct == 1,
                                        'underline' => $result->option_id == $option->id,
                                    ])>
                                        {{ $option->text }}
                                        @if ($option->correct == 1)
                                            <span class="italic text-gray-500">(correct)</span>
                                        @endif
                                        @if ($result->option_id == $option->id)
                                            <span class="italic text-blue-600">(your answer)</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>

                            @if (is_null($result->option_id))
                                <p class="text-red-600 italic mt-2">Question unanswered.</p>
                            @endif

                            {{-- Explanation --}}
                            @if ($result->question->answer_explanation || $result->question->more_info_link)
                                <div class="mt-3 p-3 bg-gray-50 rounded border">
                                    @if ($result->question->answer_explanation)
                                        <p class="text-gray-700">
                                            <span class="font-semibold">Explanation:</span>
                                            {{ $result->question->answer_explanation }}
                                        </p>
                                    @endif

                                    @if ($result->question->more_info_link)
                                        <p class="mt-2">
                                            <a href="{{ $result->question->more_info_link }}"
                                               class="text-blue-600 hover:underline"
                                               target="_blank">
                                                🔗 Read more
                                            </a>
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        @if (!$loop->last)
                            <hr class="my-6 border-gray-300">
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
