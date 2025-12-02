@extends('layouts.app')
@section('title', '| Feladatok')
@section('content')
    <div class="container">
        <h1>Feladatok</h1>

        <form action="{{ route('tasks.add') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Cím</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Leírás</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Feladat hozzáadása</button>
        </form>

        <h2>Feladatlista</h2>
        <ul class="list-group">
            @foreach ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="{{ $task->is_completed ? 'text-decoration-line-through' : '' }}">{{ $task->title }}</h5>
                        <p class="{{ $task->is_completed ? 'text-decoration-line-through' : '' }}">{{ $task->description }}</p>
                    </div>
                    <div>
                        @if (!$task->is_completed)
                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Kész</button>
                            </form>
                        @else
                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">Visszaállít</button>
                            </form>
                        @endif
                        <form action="{{ route('tasks.delete', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Törlés</button>
                        </form>
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="text" name="title" value="{{ $task->title }}" class="form-control form-control-sm d-inline w-auto" required>
                            <input type="text" name="description" value="{{ $task->description }}" class="form-control form-control-sm d-inline w-auto">
                            <button type="submit" class="btn btn-primary btn-sm">Frissítés</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection