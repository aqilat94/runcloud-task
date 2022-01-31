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
                    <h4>{{ __('Dashboard') }}</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row text-center">
                        <div class="col-sm-4">
                            <div class="card text-white bg-dark">
                                <div class="card-body">
                                    <h5 class="card-title">Total Workspace</h5>
                                    <p class="card-text">{{ $workspaces->count() }}</p>
                                    <a href="{{ route('workspace:index') }}" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card text-white bg-warning">
                                <div class="card-body">
                                    <h5 class="card-title">Incomplete Task</h5>
                                    <p class="card-text">{{ $incomplete_task->count() }}</p>
                                    <a href="{{ route('task:index') }}" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card text-white bg-success">
                                <div class="card-body">
                                    <h5 class="card-title">Complete Task</h5>
                                    <p class="card-text">{{ $complete_task->count() }}</p>
                                    <a href="{{ route('task:index') }}" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create Workspace</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="{{ route('workspace:store') }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Workspace Name</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="My Workspace">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Workspace Description</label>
                                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
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
        </div>
    </div>
</div>
@endsection
