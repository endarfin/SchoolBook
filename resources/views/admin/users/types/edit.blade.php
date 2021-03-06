@extends('admin.template')
@section('content')
    <form action="{{ route('admin.types.update', $type->id) }}" method="post">
        @method('PATCH')
        @csrf
        <br>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('alert')
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">Основные данные</a>
                                    </li>
                                </ul>
                                <br>
                                <div class="float-right">ID: {{ $type->id }}</div>
                                <div class="tab-content">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="title">Название</label>
                                            <input name="name" value="{{ $type->name }}"
                                            id="name"
                                            type="text"
                                            class="form-control"
                                            minlength="2"
                                            required>
                                        </div>
                                        <div class="float-right">
                                            <a class="btn btn-primary" href="{{ route('admin.types.index') }}">Back</a>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
