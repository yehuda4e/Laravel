@foreach($categories as $category)
<div class="col-md-3">
	<div class="panel panel-info">
		<div class="panel-heading"><a href="{{ url('article/cat/'.$category->name) }}">{{ $category->name }}</a></div>
		<ul class="list-group">
			@foreach($category->articles as $article)
			<li class="list-group-item"><a href="{{ url(urlencode($article->slug)) }}">{{ $article->subject }}</a></li>
			@endforeach
		</ul>
	</div>
</div>
@endforeach