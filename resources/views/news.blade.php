@extends('template')
@section('content')
        <div class="container">
            <div class="row">
                <div class="col-8">
                    @if(isset($news->img))
                        <img src={{asset('/storage/newsImg/'.$news->img)}} class="card-img-top">
                    @endif
                    <h5 class="card-title"> {{$news->title}}</h5>
                    <p class="card-text">{{$news->content}}</p>
                    <a href="{{route('index')}}" class="btn btn-primary">Назад</a>
                    <p class="card-text float-right"><small class="text-muted">{{$news->author->name}} {{$news->author->surname}}</small></p>
                </div>
                <div class="col-4">
                    @foreach($bracingNews as $news)
                        @if(isset($news->img))
                            <div class="card">
                                <img src={{asset('/storage/newsImg/'.$news->img)}} class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title"><a href={{route('news',['slug'=>$news->slug])}}>{{$news->title}}</a></h5>
                                    <p class="card-text">{{$news->excerpt}}</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">
                                        {{date('d-m-y', strtotime($news->published_ad))}}
                                    </small>
                                </div>
                            </div>
                        @else
                            <div class="card p-3">
                                <blockquote class="blockquote mb-0 card-body">
                                    <h5 class="card-title"><a href={{route('news',['slug'=>$news->slug])}}>{{$news->title}}</a></h5>
                                    <p>{{$news->excerpt}}</p>
                                </blockquote>
                                <div class="card-footer">
                                    <small class="text-muted">
                                        {{date('d-m-y', strtotime($news->published_ad))}}
                                    </small>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
@endsection
