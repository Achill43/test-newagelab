$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    } 
 });
 $(document).ready(function()
{
 var goods=[];
 var limit=10;
 var seeGoods=true;
 function getMessages(){
    $.post('getMessages',{
        'id': 'all',
        }, function(result){
                var data = JSON.parse(result);
                goods=data;
                var text;
                var alltext=[];
                for(var i=0; i<10; i++){
                    var checked='';
                    if(data[i]['status']!='new'){
                        checked='checked';
                    }
                    text='<tr id="'+goods[i]['id']+'"><td>'+data[i]['theme']+
                    '</td><td><input class="statusCheck" type="checkbox" id="'+data[i]['id']+'" '+checked+
                    '></td><td>'+data[i]['created_at']+
                    '</td><td class="text-right"> <a href="oneMessage?id='+data[i]['id']+'" class="seeMessage"><i class="fas fa-pencil-alt"></i>Просмотр</a><button type="submit" class="btn mybtn deleteMessage" id="'+
                    data[i]['id']+'"><i class="fas fa-trash-alt"></i> Удалить</button> </td></tr>';
                    alltext.push(text);
                }
                $('#allmessage').html(alltext);
            });
 }
getMessages();
 $('#seeMore').on('click', function(){
     var start=limit;
     limit=limit+10;
     if(seeGoods){
        if(limit<goods.length){
            for(var i=start; i<limit; i++){
                var checked='';
                if(goods[i]['status']!='new'){
                       checked='checked';
                }
                text='<tr id="'+goods[i]['id']+'"><td>'+goods[i]['theme']+
                '</td><td><input class="statusCheck" id="'+goods[i]['id']+'" type="checkbox" '+checked+
                '></td><td>'+goods[i]['created_at']+
                '</td><td class="text-right"> <a href="oneMessage?id='+goods[i]['id']+'" class="seeMessage"><i class="fas fa-pencil-alt"></i>Просмотр</a><button type="submit" class="btn mybtn deleteMessage" id="'+
                goods[i]['id']+'"><i class="fas fa-trash-alt"></i> Удалить</button> </td></tr>';
                $('#allmessage').append(text);
            }
        }
        else{
            limit=goods.length;
            seeGoods=false;
            for(var i=start; i<limit; i++){
                var checked='';
                    if(goods[i]['status']!='new'){
                        checked='checked';
                    }
                    text='<tr id="'+goods[i]['id']+'"><td>'+goods[i]['theme']+
                    '</td><td><input type="checkbox" class="statusCheck" id="'+goods[i]['id']+'" '+checked+
                    '></td><td>'+goods[i]['created_at']+
                '</td><td class="text-right"> <a href="oneMessage?id='+goods[i]['id']+'" class="seeMessage"><i class="fas fa-pencil-alt"></i>Просмотр</a><button type="submit" class="btn mybtn deleteMessage" id="'+
                goods[i]['id']+'"><i class="fas fa-trash-alt"></i> Удалить</button> </td></tr>';
                $('#allmessage').append(text);
            }
        }
     }
     else{
         alert('Все сообщения выведены');
     }
 });
 $('body').on('click', '.statusCheck', function(){
    $.post('setStaus',{
        'id': $(this).attr('id'),
        }, function(result){
                var data = JSON.parse(result);
                switch(data.status){
                    case 'success':
                        console.log('success');
                        break;
                    default: alert('Возникла ошибка!');
                }
            });
 });
 $('body').on('click', '.deleteMessage', function(){
    var id=$(this).attr('id');
    $.post('deleteMessage',{
        'id': id,
        }, function(result){
                var data = JSON.parse(result);
                switch(data.status){
                    case 'success':
                        $('#allmessage').children('tr[id="'+id+'"]').remove();
                        break;
                    default: alert('Возникла ошибка!');
                }
            });
 });
});