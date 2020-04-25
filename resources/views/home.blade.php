@extends('layouts.app')

@section('content')
    <meta http-equiv="refresh" content="5; url=/">
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    Вы успешно авторизовались и будете перенаправлены на главную страницу!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
