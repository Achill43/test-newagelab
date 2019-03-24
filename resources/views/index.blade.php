@extends('layouts.app')


@section('content')
<div class="container">
    <h2>Форма для обращений</h2>
    <hr>
    <form class="mx-auto col-md-8" name="messageForm" id="messageForm" action="{{route('addMessage')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label class="control-label">Тема обращения: </label>
             <input class="form-control" id="theme" type="text" name="theme" data-required="true" data-validation="text" placeholder="Тема обращения">
        </div>
        <div class="form-group">
            <label class="control-label">Ваше имя:</label>
             <input class="form-control" id="userName" type="text" name="userName" data-validation="text" data-required="true" placeholder="Ваше имя">
        </div>
        <div class="form-group">
            <label class="control-label">Ваш Email:</label>
             <input class="form-control" id="userEmail" type="text" name="userEmail" data-required="true" data-validation="email" placeholder="Ваш Email">
        </div>
        <div class="form-group">
            <label class="control-label">Название организации:</label>
             <input class="form-control" id="organization" type="text" name="organization" data-validation="text" data-required="true" placeholder="Название организации">
        </div>
        <div class="form-group">
            <label class="control-label">Текст сообщения:</label>
            <textarea name="notes" id="notes" cols="1" rows="10" class="form-control" data-validation="text" data-required="true"></textarea>
        </div>
        <div class="form-group">
            <div class="g-recaptcha" data-sitekey="6Le6GpkUAAAAAG3mdOsFJ6OlWNfmApMWEURb35_j"></div>
        </div>
        <div class="form-group">
            <button class="btn"  name="send_review" id="send_review">Надісллати</button> 
        </div>
    </form>
</div>
@endsection
