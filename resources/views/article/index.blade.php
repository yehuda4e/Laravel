@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            @foreach($articles as $article)
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{ urlencode($article->slug) }}">{{ $article->subject }}</a></div>

                <div class="panel-body">
                    {!! str_limit(nl2br($article->content), 120, '.. <a href="'.url(urlencode($article->slug)).'">continiue read</a>') !!}
                </div>

                <div class="panel-footer">
                    <i class="fa fa-user"></i> {!! $article->user->profile() !!}
                    <i class="fa fa-clock-o"></i> {{ $article->created_at->diffForHumans() }}
                    <i class="fa fa-comments"></i> <a href="{{ url($article->slug.'#comments') }}">{{ $article->comments->count() ?? 0 }}</a>
                    <i class="fa fa-eye"></i> {{ Redis::get("article.$article->id.views") ?? 0 }}
                </div>
            </div>
            @endforeach
            {{ $articles->links() }}
        </div>
        @include('article._category')
    </div>
@endsection
