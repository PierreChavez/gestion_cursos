@extends('layouts.app')

@section('content')
    <h1>Courses</h1>
    <a href="{{ route('courses.create') }}">Create Course</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Modality</th>
                <th>Teacher</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->description }}</td>
                    <td>{{ $course->duration }}</td>
                    <td>{{ $course->modality }}</td>
                    <td>{{ $course->teacher->name }}</td>
                    <td>
                        <a href="{{ route('courses.edit', $course) }}">Edit</a>
                        <form action="{{ route('courses.destroy', $course) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
