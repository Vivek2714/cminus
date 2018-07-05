jQuery( document ).ready(function(){
	jQuery('body').on( "click", ".cminus-leave", function(){
		jQuery('.cminus-confirmation-box').hide();
		jQuery('.cminus-thankyou-message').show();
	});
});