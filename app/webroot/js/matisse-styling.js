$(document).ready(function(){
   $('a.qtip_me').qtip({
      content: {
         text: $(this).next('div.qtip-data').attr('data-content'),
         title: $(this).next('div.qtip-data').attr('data-title')
      },
      position: {
         my: 'center left',
         at: 'center right'
      }
   });
});