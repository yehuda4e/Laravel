@extends('layouts.app')

@section('js')
<script src="/js/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Create new topic</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" method="POST" action="{{ url('topic/'.$id.'/store') }}">
					{{ csrf_field() }}
                    <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                        <label for="subject" class="col-md-1 control-label">Subject</label>

                        <div class="col-md-10">
                            <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject') }}" required autofocus>

                            @if ($errors->has('subject'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>		
                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                        <label for="content" class="col-md-1 control-label">Content</label>

                        <div class="col-md-10">
                        	<textarea name="content" id="content" rows="50" class="form-control">{{ old('content') }}</textarea>

                            @if ($errors->has('content'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>	
                    <div class="form-group">
                        <div class="col-md-11 text-center">
                            <button type="submit" class="btn btn-primary">Post</button>
                        </div>
                    </div>                                        			
				</form>
			</div>
		</div>		
	</div>	
</div>
@stop