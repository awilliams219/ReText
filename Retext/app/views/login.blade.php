@extends('root')

@section('Canvas')
<div class="LoginBox">
    <div class="logo centered">&nbsp;</div>
    <form name="login" method="POST" action="{{ URL::action('LoginController@postLogin') }}" >
        <input type="hidden" name="_token" value="{{ csrf_token(); }}" />
        <span class="ErrorMessage">
            {{ $message or null }}     
        </span>
        <div class="username">
            <label for="LoginUsername">Username</label>
            <input type="text" name="username" id="LoginUsername" />
        </div>
        <div class="password">
            <label for="LoginPassword">Password</label>
            <input type="password" name="password" id="LoginPassword" />
        </div>
        <button class="btn btn-primary" onClick="this.form.submit()">Login</button>
    </form>
</div>
@stop

