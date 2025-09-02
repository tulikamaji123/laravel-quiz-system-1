<div 
    x-data="{ secondsLeft: {{ config('quiz.secondsPerQuestion') }} }" 
    x-init="setInterval(() => {
        if (secondsLeft > 1) { 
            secondsLeft--; 
        } else {
            secondsLeft = {{ config('quiz.secondsPerQuestion') }};
            $wire.nextQuestion();
        }
    }, 1000);"
    class="bg-gradient-to-r from-indigo-50 via-purple-50 to-pink-50 p-6 rounded-2xl shadow-lg border border-gray-200"
>

    <!-- Timer -->
    <div class="mb-4 flex justify-between items-center">
        <span class="text-lg font-semibold text-gray-700">
            Time left for this question:
            <span x-text="secondsLeft" class="font-bold text-red-600 text-xl"></span> sec.
        </span>
        <span class="px-3 py-1 text-sm font-bold bg-yellow-100 text-yellow-700 rounded-full shadow">
            Question {{ $currentQuestionIndex + 1 }} / {{ $this->questionsCount }}
        </span>
    </div>

    <!-- Question Text -->
    <h2 class="mb-4 text-2xl font-bold text-indigo-700 leading-snug">
        {{ $currentQuestion->text }}
    </h2>

    <!-- Code Snippet (if any) -->
    @if ($currentQuestion->code_snippet)
        <pre class="mb-4 border border-indigo-200 bg-gray-900 text-green-300 rounded-lg p-4 overflow-x-auto shadow-md">
{{ $currentQuestion->code_snippet }}
        </pre>
    @endif

    <!-- Options -->
    <div class="space-y-3">
        @foreach ($currentQuestion->options as $option)
            <label 
                for="option.{{ $option->id }}" 
                class="flex items-center p-3 border rounded-lg cursor-pointer transition duration-200 hover:bg-indigo-100 hover:border-indigo-400"
            >
                <input 
                    type="radio" 
                    id="option.{{ $option->id }}"
                    wire:model.defer="answersOfQuestions.{{ $currentQuestionIndex }}"
                    name="answersOfQuestions.{{ $currentQuestionIndex }}" 
                    value="{{ $option->id }}"
                    class="text-indigo-600 focus:ring-indigo-500 mr-3"
                >
                <span class="text-gray-800 font-medium">{{ $option->text }}</span>
            </label>
        @endforeach
    </div>

    <!-- Navigation Buttons -->
    <div class="mt-6 flex justify-end space-x-3">
        @if ($currentQuestionIndex < $this->questionsCount - 1)
            <x-secondary-button
                class="bg-gray-200 text-gray-800 hover:bg-gray-300 shadow"
                x-on:click="secondsLeft = {{ config('quiz.secondsPerQuestion') }}; $wire.nextQuestion();">
                Next Question →
            </x-secondary-button>
        @else
            <x-primary-button 
                class="bg-green-600 hover:bg-green-700 text-white shadow-lg"
                x-on:click="$wire.submit();">
                ✅ Submit Quiz
            </x-primary-button>
        @endif
    </div>
</div>
