@extends('layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">AI Quiz on {{ $topic }}</h2>
    <form action="{{ route('ai.quiz.check') }}" method="POST">
        @csrf
        <input type="hidden" name="topic" value="{{ $topic }}">
        
        @foreach($questions as $index => $q)
            <div class="card mb-3 p-3 shadow-sm">
                <h5>Q{{ $index + 1 }}: {{ $q['question'] }}</h5>
                @foreach($q['options'] as $opt)
                    <div class="form-check">
                        <input type="radio" name="answers[{{ $index }}]" value="{{ $opt }}" class="form-check-input">
                        <label class="form-check-label">{{ $opt }}</label>
                    </div>
                @endforeach
            </div>
        @endforeach

        <button type="submit" class="btn btn-success">Submit Answers</button>
    </form>
</div>
@endsection
