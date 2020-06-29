@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Shift
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('shift.update', $shift->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Shift Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                       name="name" value="{{ $shift->name }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="start">Shift Start Time</label>
                                <input type="datetime-local" class="form-control @error('start') is-invalid @enderror"
                                       id="start" name="start" value="{{ $shift->start->format('Y-m-d\Th:m:s') }}">
                                @error('start')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="end">Shift End Time</label>
                                <input type="datetime-local" class="form-control @error('end') is-invalid @enderror"
                                       id="end" name="end" value="{{ $shift->end->format('Y-m-d\Th:m:s') }}">
                                @error('end')
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
