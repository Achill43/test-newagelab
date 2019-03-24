@extends('layouts.app')


@section('content')
<div class="container">
   
    <script src="<?=URL::asset('/public/js/getAllMessage.js');?>"></script>
    <h2>Список обращений</h2>
    <hr>
    <table class="table table-striped table-hover">
        <thead>
            <th class="danger">Tема обращения</th>
            <th class="danger">Статус</th>
            <th class="danger">Дата</th>
            <th class="danger">Действие</th>
        </thead>
        <tbody id="allmessage">
            
        </tbody>
        <tfoot>
            <td colspan="3">
                
            </td>
        </tfoot>
    </table>
    <button class="btn" id="seeMore">Пoказать больше...</button>
    <br>
</div>
@endsection
