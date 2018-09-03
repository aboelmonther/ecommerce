$(function(){

'use strict';

//Hide placeholder On Form Focus

$('[placeholder]').focus(function(){
 
  $(this).attr('data-text', $(this).attr('placeholder'));

  $(this).attr('placeholder', '');

//When pressed show them (input-UserName-password)

}).blur(function(){

	$(this).attr('placeholder', $(this).attr('data-text'));
  });

});