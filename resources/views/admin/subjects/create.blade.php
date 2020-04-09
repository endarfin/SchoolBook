@extends('admin.template')
@section('content')
    <form action="{{ route('admin.subjects.store') }}" method="post">
        @csrf
        <br>
        <div class="container">
            @if($errors->any())
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                            {!! $errors->first() !!}
                        </div>
                    </div>
                </div>
            @endif
                @if(session('success'))
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                                {{ session()->get('success') }}
                            </div>
                        </div>
                    </div>
                @endif
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">Основные данные</a>
                                    </li>
                                </ul>
                                <br>
                                <div class="tab-content">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="title">Название</label>
                                            <input name="name"
                                            id="name"
                                            type="text"
                                            class="form-control"
                                            required>
                                        </div>
                                        <div class="float-right">
                                            <a class="btn btn-primary" href="{{ route('admin.subjects.index') }}" >Back</a>
                                            <button type="submit" class="btn btn-primary" >Save</button>
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
