@extends('layouts.app')

@section('content')

@if (session()->has('alert'))
    <div class="alert {{ session()->get('alert-type') }}">
        {{ session()->get('alert') }}
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $workspace->name }}'s Workspace</h4>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h5>Description</h5>
                    <div class="row-md mt-5">
                        {{ $workspace->description }}
                    </div>
                    <div class="col-sm text-end">
                        <a class="btn btn-danger rounded-lg" data-bs-toggle="modal" data-bs-target="#deleteWorkspace">Delete</a>
                    </div>
                </div>

                <!-- Modal Delete Workspace-->
                <div class="modal fade" id="deleteWorkspace" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Workspace</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="{{ route('task:store', $workspace) }}">
                                @csrf
                                <div class="modal-body">
                                    Are sure want to delete this workspace? All your tasks will be delete too..
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('workspace:delete', $workspace) }}" class="btn btn-primary">Yes</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('My Task') }}</h4>
                    <div class="col text-center">
                        <a class="btn btn-secondary rounded-lg" data-bs-toggle="modal" data-bs-target="#createTask">Create Task</a>
                    </div>
                </div>

                <!-- Modal Create Task -->
                <div class="modal fade" id="createTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="{{ route('task:store', $workspace) }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Task Name</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="My Task" required>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Task Description</label>
                                        <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Due Date</label>
                                        <input type="date" class="form-control" id="due_date" name="due_date" required>
                                        @if ($errors->has('due_date'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('due_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="time">Due Time</label>
                                        <input type="time" class="form-control" id="due_time" name="due_time" required>
                                        @if ($errors->has('due_time'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('due_time') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-secondary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-12">
                <div class="table-responsive"> 
                    <table class="table table-borderless table-striped table-dark">
                        <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Deadline</th>
                            <th scope="col">Status</th>
                            <th scope="col">More</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $task->name }}</td>
                                    </td>
                                    @can('statusIncomplete', $task)    
                                        <td>{{ $task->deadline_date }} ({{ $task->deadline_due }})</td>
                                        <td>
                                            <span class="badge rounded-pill bg-danger">Incomplete</span>
                                        </td>
                                    @else
                                        <td>
                                            Done
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-smile" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
                                            </svg>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill bg-success">Complete {{ $task->complete_due }}</span> 
                                        </td>
                                    @endcan
                                    <td>
                                        <a href="{{ route('task:show' , $task) }}" class="btn btn-primary">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
