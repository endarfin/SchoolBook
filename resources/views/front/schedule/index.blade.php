@extends('template')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="float-rigth">New User</div>
        </div>
        <div class="card-body">
        </div>
        <div class="float-right">
            <a class="btn btn-outline-info btn-sm"
               href="{{ route('admin.users.index') }}">Back</a>
            <button type="submit" class="btn btn-outline-info btn-sm">Save</button>
        </div>
    </div>
@endsection
