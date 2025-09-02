@extends('layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Choose a Topic for AI Quiz</h2>
    <form action="{{ route('ai.quiz.generate') }}" method="POST">
        @csrf
        <select name="topic" class="form-control mb-3">
            <option value="React">React</option>
            <option value="Java">Java</option>
            <option value="PHP">PHP</option>
            <option value="C">C</option>
            <option value="C++">C++</option>
        </select>
        <button type="submit" class="btn btn-primary">Generate Quiz</button>
    </form>
</div>
@endsection
