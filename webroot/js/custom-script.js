$(document).ready(function() {
  $('form').submit(function() {
    $.colorbox({
      opacity: 0.5, 
      rel: 'loading', 
      width: '100%', 
      height: '100%',
      overlayClose: false,
      escKey: false,
      close: ''
    });
  });

	$("input[type='file']").uniform();
});
