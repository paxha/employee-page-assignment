@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Employee
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('employee.update', $employee->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="department_id">Department</label>
                                <select class="form-control @error('department_id') is-invalid @enderror"
                                        id="department_id" name="department_id">
                                    <option value="">Choose</option>
                                    @foreach(\App\Department::all() as $department)
                                        <option
                                            value="{{ $department->id }}" {{ $department->id === $employee->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="shifts">Shifts</label>
                                <select multiple class="form-control @error('shifts') is-invalid @enderror"
                                        id="shifts" name="shifts[]">
                                    @foreach(\App\Shift::all() as $shift)
                                        <option
                                            value="{{ $shift->id }}" {{ $employee->shifts()->wherePivot('shift_id', $shift->id)->first() ? 'selected' : '' }}>{{ $shift->name }}</option>
                                    @endforeach
                                </select>
                                @error('shifts')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                       name="name" value="{{ $employee->name }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="father_name">Father Name</label>
                                <input type="text" class="form-control @error('father_name') is-invalid @enderror"
                                       id="father_name" name="father_name" value="{{ $employee->father_name }}">
                                @error('father_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                       name="phone" value="{{ $employee->phone }}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address"
                                          name="address">{{ $employee->address }}</textarea>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
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
