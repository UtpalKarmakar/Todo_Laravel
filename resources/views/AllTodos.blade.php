@extends('layouts.FrontendLayouts')

@section('content')
    <div class="container text-center my-3">
        <h2>All Todos</h2>

        <div class="row my-5">

            @forelse ($todos as $todo)
                <div class="col-md-3 my-3">
                    <div
                        class="card {{ Carbon\Carbon::parse($todo->date) < today() && $todo->status == 0 ? 'bg-danger-subtle' : '' }}">

                        <div class="card-header">
                            {{ $todo->title }}
                            <span class="float-end">
                                {{ Carbon\Carbon::parse($todo->created_at)->diffForHumans() }}
                            </span>
                        </div>

                        <div class="card-body">
                            <p>{{ $todo->description ?? 'No description' }}</p>
                            <button
                                class="btn btn-sm btn-{{ $todo->status == 1 ? 'primary' : 'warning' }}">{{ $todo->status == 1 ? 'Completed' : 'Incomplete' }}</button>
                            <br> <br>
                            <strong>Due date: {{ Carbon\Carbon::parse($todo->date)->format('d M Y') }}</strong>
                        </div>

                        <div class="card-footer">

                            @if ($todo->status == 0)
                                <a href="">Edit</a>
                            @endif

                            <a href="{{ route('delete', $todo->id) }}">Delete</a>

                            @if ($todo->status == 0)
                                <a href="">Mark as Complete</a>
                            @endif

                        </div>

                    </div>
                </div>

            @empty
                <p class="Text-center text-primary"><b>No todos found!</b></p>
            @endforelse

        </div>

        <nav>
          {{ $todos->links() }}
        </nav>

    @endsection
