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
                    <h4>{{ __('My Workspace') }}</h4>
                    <div class="col text-center">
                        <a class="btn btn-secondary rounded-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">Create Workspace</a>
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
                                    <input type="text" name="name" class="form-control" id="name" placeholder="My Workspace" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Workspace Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-secondary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <table class="table table-borderless table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">More</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($workspaces as $workspace)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $workspace->name }}</td>
                            <td>
                                <a href="{{ route('workspace:show' , $workspace) }}" class="btn btn-primary">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

    

@endsection