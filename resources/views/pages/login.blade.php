@extends('layouts.main-layout')

@section('title') Login  @endsection
@section('keywords') Bota,shop,doors,windows,garage doors, webshop @endsection
@section('description') Bota shop login page, best quality doors, windows and pvc @endsection

@section('content')
<div id="login-div">
    <h2>Uloguj se</h2>
    <form>
        <p><b>Korisnicko ime</b></p>
        <input type="text" class="form-control" id="#login_username" aria-describedby="basic-addon3">
        <p><b>Lozinka</b></p>
        <input type="password" class="form-control" id="login_password" aria-describedby="basic-addon3">
        <br/>
        <input type="button" id="login_button" class="btn btn-danger" value="Uloguj se">
        <br/>
        <a href="{{route('register')}}">Nemas nalog ?</a>
        <br/>
        <div id="loginErrors"></div>
    </form>
</div>
@endsection