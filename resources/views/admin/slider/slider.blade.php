@extends('admin.template')
@section('content')
    <script src = "{{ asset('/js/admin/Slider.js')}}"></script>
        <br>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-danger" role="alert" id="false" style="display: none;"></div>
                    <div class="alert alert-success" role="alert" id="true" style="display: none;"></div>
                    <input type="hidden" id="url" value={{url('/')}}>
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @include('alert')
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home" aria-selected="true">Выбарнные</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                               aria-controls="profile" aria-selected="false">Галерея</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="download-tab" data-toggle="tab" href="#download" role="tab"
                               aria-controls="profile" aria-selected="false">Добавить</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <br>
                            <div class="published">
                                @foreach($isPublished as $img)
                                    <div class="card bg-dark text-white">
                                        <div style="visibility: hidden">{{$img->id}}</div>
                                        <img src="{{asset($img->url)}}" class="card-img">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <br>
                            <div class="is_published"></div>
                        </div>
                        <div class="tab-pane fade" id="download" role="tabpanel" aria-labelledby="home-tab">
                            <br>
                            <form method='post' action='{{route('admin.slider.store')}}' enctype='multipart/form-data'>
                                {{ csrf_field() }}
                                <input type="file" name="image[]" id="imeg" multiple>
                                <div class="form-check">
                                    <input class="form-check-input" name="sd" type="checkbox"  id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Default checkbox
                                    </label>
                                </div>
                                <input type='submit'  value='Upload'>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

