@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Departments
                        <a class="btn btn-primary btn-sm float-right" href="{{ route('department.create') }}">New Department</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Department</th>
                                <th>Short Name</th>
                                <th>Created</th>
                                <th>Last Update</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($departments as $department)
                                <tr>
                                    <td>{{ $department->name }}</td>
                                    <td>{{ $department->short_name }}</td>
                                    <td>{{ $department->created_at->diffForHumans() }}</td>
                                    <td>{{ $department->updated_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('department.edit', $department->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form style="display: inline;" method="POST"
                                              action="{{ route('department.destroy', $department->id) }}"
                                              onsubmit="return confirm('Do you really want to delete this department?')">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                                        </form>
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

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
@endsection
