@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Employees
                        <a class="btn btn-primary btn-sm float-right" href="{{ route('employee.create') }}">New Employee</a>
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
                                <th>Name</th>
                                <th>Father Name</th>
                                <th>Phone</th>
                                <th>Created</th>
                                <th>Last Update</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->father_name }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->created_at->diffForHumans() }}</td>
                                    <td>{{ $employee->updated_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form style="display: inline;" method="POST"
                                              action="{{ route('employee.destroy', $employee->id) }}"
                                              onsubmit="return confirm('Do you really want to delete this employee?')">
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
