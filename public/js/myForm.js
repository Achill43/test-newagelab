$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    } 
 });
$(document).ready(function()
{
    //#messageForm
    $('#messageForm').on('submit', function(e){
        e.preventDefault();
        
        var same_errors=false;
        var patern_email=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
        
        $('input').removeClass('error_field');
        $('select').removeClass('error_field');
        $('.error').remove();
        $('[data-required="true"]').each(function(){
            var field_value=$(this).val();
            if(field_value=="")
            {
                $(this).addClass('error_field');
                $(this).after('<p class="error" style="color:red">This field is required!</p>');
                same_errors=true;
            }
        });
        
        $('[data-validation="text"]').each(function(){
            var field_value=$(this).val();
            if(field_value.search(/'/)!=-1 || field_value.search(/"/)!=-1){
                $(this).addClass('error_field');
                $(this).after('<p class="error" style="color:red">This field has not contain \' or \"!</p>');
                same_errors=true;
        }
        });
        
        $('[data-validation="email"]').each(function(){
            var field_value=$(this).val();
            if(field_value.search(patern_email)==-1){
                $(this).addClass('error_field');
                $(this).after('<p class="error" style="color:red">Email address is not valid!</p>');
                same_errors=true;
        }
        });
        if(same_errors){
                window.alert("Mising same errors!!!");
            }
        else{
            $.post($('#messageForm').attr('action'),{
                theme: $('#theme').val(),
                userName: $('#userName').val(),
                userEmail: $('#userEmail').val(),
                organization: $('#organization').val(),
                notes: $('#notes').val(),
                gRecaptchaResponse: $('#g-recaptcha-response').val(),
                }, function(result){
                            var data = JSON.parse(result);
                            
                            console.log(data);
                            switch(data.status){
                                case 'success':
                                $('input').val('');
                                $('textarea').val('');
                                alert('Обращение  отправлено успешно');
                                    break;
                                case 'robot':
                                    alert('Пройдите проверку Re-Captcha!');
                                    break;
                                default: alert('Возникла ошибка!');
                            }
            });
        }
    });
});