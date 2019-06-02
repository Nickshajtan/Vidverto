<form role="search" method="get" class="search-form d-none" action="<?php echo home_url( '/' ); ?>" style="opacity:0">
	<label>
		<span class="screen-reader-text sr-only"><?php echo _x( 'Search for:', 'label' ) ?></span>
		<input type="search" class="search-field" placeholder="<?php echo __('Пошук...'); /*echo esc_attr_x( 'Search …', 'placeholder' ) */?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
	</label>
	<input type="submit" class="sr-only search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
</form>