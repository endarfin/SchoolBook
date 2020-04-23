@extends('admin.template')
@section('content')
    <form action="{{ route('admin.news.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value=1>
        <br>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('alert')
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home" aria-selected="true">Основные</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                               aria-controls="profile" aria-selected="false">Дополнительные</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <br>
                            <div class="form-group">
                                <label for="title">Название новости</label>
                                <input class="form-control" type="text" name="title">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Краткое описание</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" name="excerpt"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Основной текст</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="content"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="form-group">
                                <label for="title">Слаг</label>
                                <input class="form-control" type="text" value="" placeholder="Не обезательно" name="slug">
                            </div>
                            <div class="form-group">
                                <label for="title">Категория</label>
                                <select class="form-control" name="categories_id">
                                    @foreach($allCategories as $categories)
                                        <option value={{$categories->id}}> {{$categories->name}} </option>
                                    @endforeach
                                </select>
                            </div>

                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Основное изображение</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="img">
                                </div>

                            <br>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_published" id="exampleRadios1" value="1">
                                <label class="form-check-label" for="exampleRadios1">
                                    Опубликовано
                                </label>
                            </div>
                            <br>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_published" id="exampleRadios2" value="0" checked>
                                <label class="form-check-label" for="exampleRadios2">
                                    Снять с публикации
                                </label>
                            </div>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('admin.news.index') }}">Back</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
