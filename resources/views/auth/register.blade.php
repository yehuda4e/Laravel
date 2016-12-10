@extends('layouts.app')

@section('js')
<script>
$(document).ready(function() {
    $("#registerForm").submit(function(e){
        e.preventDefault();
        $('#username-error').html("");
        $('#email-error').html("");
        $('#password-error').html("");
        $("#register-username").removeClass("has-error");
        $("#register-email").removeClass("has-error");
        $("#register-password").removeClass("has-error");

        $.ajax({
            url: '/register',
            type: 'POST',
            data: $('#registerForm').serialize(),
            success:function (data){
                location.reload(true);
            },
            error: function (data) {
                console.log(data.responseText);
                var obj = jQuery.parseJSON(data.responseText);
               if(obj.username){
                    $("#register-username").addClass("has-error");
                    $('#username-error').html( obj.username );
                }
                if(obj.email){
                    $("#register-email").addClass("has-error");
                    $('#email-error').html( obj.email );
                }
                if(obj.password){
                    $("#register-password").addClass("has-error");
                    $('#password-error').html( obj.password );
                }
            }
        });
    });
});
</script>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" id="registerForm" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div id="register-username" class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Choose username" required autofocus>
                                <span class="help-block"><strong id="username-error"></strong></span>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div id="register-email" class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter email" required>
                                <span class="help-block"><strong id="email-error"></strong></span>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div id="register-password" class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Choose password" required>
                                <span class="help-block"><strong id="password-error"></strong></span>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm your password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
