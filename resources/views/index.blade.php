@extends('template')
@section('content')
    <div>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                @php($i = 1)
                @foreach( $slider as $img)
                    @if($i == 1)
                        <div class="carousel-item active">
                            <img src="{{ asset($img->url)}}" class="d-block w-100" alt="...">
                        </div>
                    @else
                        <div class="carousel-item">
                            <img src="{{ asset($img->url)}}" class="d-block w-100" alt="...">
                        </div>
                    @endif
                    @php($i++)
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <br>
        <div class="card-columns">
            @foreach($allNews as $news)
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
        @if($allNews->total() > $allNews->count())
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    {{$allNews->links()}}
                </ul>
            </nav>
        @endif
@endsection
