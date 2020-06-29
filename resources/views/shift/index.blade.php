@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Shifts
                        <a class="btn btn-primary btn-sm float-right" href="{{ route('shift.create') }}">New
                            shift</a>
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
                                <th>Shift Name</th>
                                <th>Shift Time</th>
                                <th>Created</th>
                                <th>Last Update</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($shifts as $shift)
                                <tr>
                                    <td>{{ $shift->name }}</td>
                                    <td>{{ $shift->start . ' - ' . $shift->end }}</td>
                                    <td>{{ $shift->created_at->diffForHumans() }}</td>
                                    <td>{{ $shift->updated_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('shift.edit', $shift->id) }}"
                                           class="btn btn-sm btn-primary">Edit</a>
                                        <form style="display: inline;" method="POST"
                                              action="{{ route('shift.destroy', $shift->id) }}"
                                              onsubmit="return confirm('Do you really want to delete this shift?')">
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
