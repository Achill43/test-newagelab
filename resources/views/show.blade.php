@extends('layouts.app')


@section('content')
<div class="container">
    <h2>Обращение</h2>
    <hr>
    <form class="mx-auto col-md-8" name="messageForm" action="{{route('editMessage')}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$appeal->id}}">
        <div class="form-group">
            <label class="control-label">Тема обращения: </label>
             <input class="form-control" id="theme" type="text" name="theme" data-required="true" data-validation="text" value="{{$appeal->theme}}">
        </div>
        <div class="form-group">
            <label class="control-label">Ваше имя:</label>
             <input class="form-control" id="userName" type="text" name="userName" data-validation="text" data-required="true" value="{{$appeal->userName}}">
        </div>
        <div class="form-group">
            <label class="control-label">Ваш Email:</label>
             <input class="form-control" id="userEmail" type="text" name="userEmail" data-required="true" data-validation="email" value="{{$appeal->userEmail}}">
        </div>
        <div class="form-group">
            <label class="control-label">Название организации:</label>
             <input class="form-control" id="organization" type="text" name="organization" data-validation="text" data-required="true" value="{{$appeal->organization}}">
        </div>
        <div class="form-group">
            <label class="control-label">Текст сообщения:</label>
            <textarea name="notes" id="notes" cols="1" rows="10" class="form-control" data-validation="text" data-required="true">{{$appeal->message}}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn"  name="send_review" id="send_review"  value="Надісллати"/> 
        </div>
    </form>
</div>
@endsection
