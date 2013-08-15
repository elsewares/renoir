/*$(document).ready(function(){
   $('form.artwork_submission', document).hide().first().addClass('current_form').show();
   
   $('input.artsubform', 'form.current_form').live('click', function(e){
        e.stopPropagation();
        e.preventDefault();
        
        var dat = $('form.current_form').serialize();
        var url = '/matisse/artworks/submission';
        $.ajax({url: url, data: dat, dataType: 'HTML', type: 'POST', success: function(data){
            alert(data);
        }});
   });
});*/