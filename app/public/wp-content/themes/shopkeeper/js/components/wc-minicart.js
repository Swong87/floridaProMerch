jQuery(document).ready(function($){

	//==============================================================================
	//	Minicart events
	//==============================================================================

	if (getbowtied_scripts_vars.option_minicart == 1) {
		/* toggle minicart*/
		$('body:not(.woocommerce-account)').on('click', '.shopping-bag-button .tools_button, .product_notification_wrapper', function(e) {

			$('.product_notification_wrapper').parent().hide();
			
			if ( $(window).width() >= 1024 ) {

				e.preventDefault();
				$('.shopkeeper-mini-cart').toggleClass('open');
				e.stopPropagation();	
				
			} else {

				e.stopPropagation();	
			}

		});

		/* close minicart */
		$('body').on('click', function(event){
			if( $('.shopkeeper-mini-cart').hasClass('open') ) 
			{
				if (!$(event.target).is('.shopkeeper-mini-cart') && !$(event.target).is('.shopping-bags-button .tools-button') && !$(event.target).is('.woocommerce-message')
					&& ( $('.shopkeeper-mini-cart').has(event.target).length === 0) )
				{
					$('.shopkeeper-mini-cart').removeClass('open');
				}
			}
		});
	}				
});