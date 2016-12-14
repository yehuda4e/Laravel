<div class="col-md-3">
	<div class="panel panel-info">
		<div class="panel-heading">Categories</div>
		@foreach($categories as $category)
		<ul class="list-group">
			<li class="list-group-item"><a href="{{ url('article/cat/'.$category->name) }}">{{ $category->name }}</a></li>
		</ul>
		@endforeach
	</div>
	<div class="panel panel-info">
		<div class="panel-heading">5 Last articles</div>
		@foreach($articles as $article)
		<ul class="list-group">
			<li class="list-group-item"><a href="{{ url('article/cat/'.$article->slug) }}">{{ $article->subject }}</a></li>
		</ul>
		@endforeach			
	</div>
</div>