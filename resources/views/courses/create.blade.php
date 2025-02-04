@extends('layouts.app')

@section('content')
    <h1>Create Course</h1>
    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <label for="duration">Duration:</label>
        <input type="text" id="duration" name="duration" required>
        <label for="modality">Modality:</label>
        <select id="modality" name="modality" required>
            <option value="presencial">Presencial</option>
            <option value="online">Online</option>
        </select>
        <label for="teacher_id">Teacher:</label>
        <select id="teacher_id" name="teacher_id" required>
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
            @endforeach
        </select>
        <button type="submit">Create</button>
    </form>
@endsection
