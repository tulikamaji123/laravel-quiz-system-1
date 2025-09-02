@extends('layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">AI Quiz Results - {{ $topic }}</h2>
    <div class="alert alert-info">
        {!! nl2br(e($result)) !!}
    </div>
    <a href="{{ route('ai.quiz.topic') }}" class="btn btn-primary">Try Another Quiz</a>
</div>
@endsection
