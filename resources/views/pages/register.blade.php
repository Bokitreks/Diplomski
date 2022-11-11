@extends('layouts.main-layout')

@section('title') Register  @endsection
@section('keywords') Bota,shop,doors,windows,garage doors, webshop @endsection
@section('description') Bota shop register page, best quality doors, windows and pvc @endsection

@section('content')
<div id="register-div">
    <h2>Registruj se</h2>
    <form>
        <p><b>Korisnicko ime</b></p>
        <input name="register_username" id="register_username" type="text" class="form-control" aria-describedby="basic-addon3">
        <p><b>Lozinka</b></p>
        <input name="register_password" id="register_password" type="password" class="form-control" aria-describedby="basic-addon3">
        <p><b>Email</b></p>
        <input name="email" id="register_email" type="text" class="form-control" aria-describedby="basic-addon3">
        <br/>
        <input type="button" id="register_button" class="btn btn-danger" value="Registruj se">
        <br/>
        <div id="registerErrors"></div>
    </form>
</div>
@endsection