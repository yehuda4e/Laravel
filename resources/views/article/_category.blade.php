@foreach($categories as $category)
<div class="col-md-3">
	<div class="panel panel-info">
		<div class="panel-heading">{{ $category->name }}</div>
		<ul class="list-group">
			@foreach($category->articles as $article)
			<li class="list-group-item"><a href="{{ $article->slug }}">{{ $article->subject }}</a></li>
			@endforeach
		</ul>
	</div>
</div>
@endforeach