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
                    <div class="row">
                        <div class="col-sm text-left">
                            <h4>{{ $task->name }}'s Task</h4>
                        </div>
                        <div class="col-sm text-center">
                        @can ('statusIncomplete', $task)    
                            <span class="badge rounded-pill bg-danger">Incomplete</span>
                        @else
                            <span class="badge rounded-pill bg-success">Complete</span>
                        @endcan
                        </div>
                        <div class="col-sm text-end">
                            <a href="{{ route('task:update', $task) }}" class="btn btn-success">Mark as Done</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h5>Description</h5>
                        <div class="row-md mt-5">
                            {{ $task->description }}
                        </div>
                        <div class="col-sm text-end">
                            <a class="btn btn-danger rounded-lg" data-bs-toggle="modal" data-bs-target="#deleteTask">Delete</a>
                        </div>

                        <!-- Modal Delete Task-->
                        <div class="modal fade" id="deleteTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Workspace</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are sure want to delete this task?
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('task:delete', $task) }}" class="btn btn-primary">Yes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection