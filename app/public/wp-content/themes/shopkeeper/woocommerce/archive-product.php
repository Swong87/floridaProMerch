<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.4.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


get_header('shop'); 

global $shopkeeper_theme_options;

//woocommerce_before_main_content
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );

add_action( 'woocommerce_before_main_content_breadcrumb', 'woocommerce_breadcrumb', 20 );

//woocommerce_before_shop_loop
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );

add_action( 'woocommerce_before_shop_loop_result_count', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_before_shop_loop_catalog_ordering', 'woocommerce_catalog_ordering', 30 );

$category_header_src = "";
$shop_has_sidebar = false;

if (function_exists('woocommerce_get_header_image_url'))  $category_header_src = woocommerce_get_header_image_url();

if ( 
	is_active_sidebar( 'catalog-widget-area' )
	 && (isset($shopkeeper_theme_options['sidebar_style']))
	 && ($shopkeeper_theme_options['sidebar_style'] == "0") 
)
{
	$shop_has_sidebar = true;
}

// $shopkeeper_theme_options['category_header_parallax'] = 1;
$category_header_parallax_ratio = '';

if ((isset($shopkeeper_theme_options['category_header_parallax'])) && ($shopkeeper_theme_options['category_header_parallax'] == "1"))
{
   // $category_header_parallax_ratio = 'data-stellar-background-ratio="0.5"';
   $category_header_parallax_class = ' parallax';
   $category_header_with_parallax = ' with_parallax';
} else {
   $category_header_parallax_ratio = '';
   $category_header_parallax_class = '';
   $category_header_with_parallax = '';
}

$page_header_src = "";

if (has_post_thumbnail(get_option( 'woocommerce_shop_page_id' ))) $page_header_src = wp_get_attachment_url( get_post_thumbnail_id(get_option( 'woocommerce_shop_page_id' )), 'full' );

if ( is_shop() && get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'page_title_meta_box_check', true ) ) {
	$page_title_option = get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'page_title_meta_box_check', true );
} else {
	$page_title_option = "on";
}

ob_start();
do_action( 'woocommerce_archive_description' );
$archive_description = ob_get_contents();
ob_end_clean();
?>

<!-- <div class="travel__header header-bg">

</div>

<div class="surf__body max-width">

    <div class="league--title parking--h1">
    <h1>FUND FLORIDA PRO</h1>
    </div>

    <p class="parking-body"><b>The Florida Pro is so stoked to announce our new presenting sponsor - YOU & ME! The first-ever fan sponsored professional surfing event….cause Florida has the best surfers & the best fans!!</b></p>
    <br>
    <p class="parking-body">Years ago, surf brands would pony up big cash to bankroll surf contests, which includes the prize money earned by the surfer athletes. Those days are nearly gone, especially for the Qualifying Series (QS), as we can no longer rely on the corporate money to provide the prize dollars to keep the sport developing. So, what do we do? Do we give up? Do we stop having QS events? <b>NO – we evolve!</b></p>
    <br>
    <p class="parking-body">The 2019 Florida Pro Women's QS6000 and Men's QS1500 will be presented by our new sponsor - and that sponsor is us! We are excited to announce a new social sponsorship model to create the $115,000 prize purse for the Florida Pro.</p>
    <br>
    <p class="parking-body">The Florida Surf Museum, a Florida non-profit dedicated to the preservation of Florida's surfing history, a history which includes world champions C.J. Hobgood, Freida Zamba, Lisa Anderson and of course the greatest of all time Kelly Slater, will take the lead on raising as much money as possible to build the prize purse. And this money will come from you, the folks who love surfing and want to see the sport continue to evolve and grow.</p>
    <br>
    <p class="parking-body">Businesses can still join the fun with cash and products! This merchandise will then be passed along to our fans in the form of online auctions and giveaways to raise enough donations to meet our prize money goals.</p>
    <br>
    <p class="parking-body">We feel we can give our community awesome products & memorabilia while encouraging a lifestyle for kids to go live their dreams on the grandest scale - a professional surfing career that spans for decades!</p>
    <br>
    <p class="parking-body">And if anything is left over? It does not go into an event promoter or anyone's pockets. It stays with the Florida Surf Museum to continue to do great things to preserve our surfing history and advocate for the future of surfing in Florida!</p>
    <br>
	<p class="parking-body">Join the Social Sponsorship movement! Donate today or buy some of our cool merchandise <b><i>coming soon!</i></b></p>
	
	<div id="donateBtnContainer"><?php echo do_shortcode('[wpedon id="2868" align="center"]'); ?></div> -->

	<div id="primary" class="content-area shop-page<?php echo $shop_has_sidebar ? ' shop-has-sidebar':'';?>">

	<?php 
		$parent_id      = get_queried_object_id();
		$categories     = get_terms('product_cat', array('hide_empty' => 0, 'parent' => $parent_id));
		$display_mode 	= woocommerce_get_loop_display_mode();
	?>
	<?php if ( 
				$category_header_src != '' || 
				(is_shop() && $page_header_src != '') || 
				$page_title_option == 'on' || 
				($display_mode == 'both' && $shopkeeper_theme_options['category_style'] != 'original_grid') ||
				$archive_description != ''
			) : ?> 
	<div  class="shop_header <?php if ($category_header_src != "" || (is_shop() && $page_header_src != "")) : ?>with_featured_img<?php endif; ?> <?php echo $category_header_with_parallax; ?>"> 
		
		<?php if ($category_header_src != "") : ?>
		
		<div <?php echo $category_header_parallax_ratio; ?>
				class="shop_header_bkg <?php echo $category_header_parallax_class; ?>" style="background-image:url(<?php echo esc_url($category_header_src); ?>)">
		</div>
	
		<?php endif; ?>

		<?php if ( is_shop() && $page_header_src != "" ) : ?>
		
		<div <?php echo $category_header_parallax_ratio; ?>
				class="shop_header_bkg <?php echo $category_header_parallax_class; ?>" style="background-image:url(<?php echo esc_url($page_header_src); ?>)">
		</div>
	
		<?php endif; ?>
	
		<div class="shop_header_overlay"></div>
	
		<div class="row">
			<div class="large-12 large-centered columns">
				<?php if ( $page_title_option == "on" ) : ?> 					
					<h1 id="shop-title" class="page-title on-shop"><?php woocommerce_page_title(); ?></h1>
				<?php endif; ?> 
			
				<div class="row">
					<div class="large-6 large-centered columns">
						<?php echo $archive_description; ?>
					</div><!--.large-9-->
				</div><!--.row-->
			
				<?php if ($display_mode == 'both' && $shopkeeper_theme_options['category_style'] != 'original_grid') : ?>
					<?php if ($categories) : ?>
					
						<ul class="list_shop_categories list-centered">
							<?php $cat_counter = 0; 
							foreach($categories as $category) : ?>
								<li class="category_item">
									<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="category_item_link">
										<span class="category_name"><?php echo esc_html($category->name); ?></span>
									</a>
								</li>
							<?php endforeach; ?>
						</ul><!-- .list_shop_categories-->
					
					<?php endif; ?>
				<?php endif; ?>
				
			
			</div><!--.large-12-->
		</div><!-- .row-->
	</div><!--  .shop_header-->
	<?php endif; ?>
			
	<div class="row">
		<div class="xlarge-9 xlarge-centered columns">
		
		<div class="before_main_content">
			<?php do_action( 'woocommerce_before_main_content'); ?>
		</div> 
			
			<div id="content" class="site-content" role="main">
				<div class="row">
				
				<div class="large-12 columns">
					<div class="catalog_top"> 
					<?php do_action( 'woocommerce_before_shop_loop' ); ?>
					</div>
				</div>
				
				<?php if ( $shop_has_sidebar ) : ?>
				
				<div class="xlarge-2 large-3 columns show-for-large">
					<div class="shop_sidebar wpb_widgetised_column">
						<?php do_action('woocommerce_sidebar'); ?>
					</div>
				</div>
				
				<div class="xlarge-10 large-9 columns">
				
				<?php else : ?>
			
				<div class="large-12 columns">
				
				<?php endif; ?>
				
					<div class="row">
						<div class="tob_bar_shop">
							<div class="row">
								<div class="small-5 medium-7 large-6 xlarge-8 columns text-left">
									<?php if (is_active_sidebar( 'catalog-widget-area')) : ?>
										<div id="button_offcanvas_sidebar_left"  data-toggle="offCanvasLeft1">
										<span class="filters-text">
											<i class="spk-icon spk-icon-menu-filters"></i>
											<?php echo esc_html_e('Filter', 'woocommerce'); ?>
										</span>
										</div>
									<?php endif; ?>
								</div>
								<?php if ($display_mode != 'subcategories'): ?>
								<div class="small-7 medium-5 large-6 xlarge-4 columns text-right">
									<div class="catalog-ordering">
											<?php do_action( 'woocommerce_before_shop_loop_catalog_ordering' ); ?>
											<?php do_action( 'woocommerce_before_shop_loop_result_count' ); ?>
									</div> <!--catalog-ordering-->
								</div>
								<?php endif; ?>
							</div>
						</div><!-- .top_bar_shop-->
					</div>	
				
				<?php if ( $display_mode == 'subcategories' && $shopkeeper_theme_options['category_style'] != 'original_grid' ) : ?>

					<?php if ($categories) : ?>
					
						<div class="row">
						<div class="categories_grid">
							
							<?php $cat_counter = 0; ?>
							
							<?php $cat_number = count($categories); ?>
							
							<?php foreach($categories as $category) : ?>
								
								<?php                        
									$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
									$image = wp_get_attachment_url( $thumbnail_id );
									
									$cat_class = $shopkeeper_theme_options['category_style'];
								?>
								
								<?php 
									if($cat_class != "original_grid") 
									{
										$cat_counter++;                                        

										switch ($cat_number) {
											case 1:
												$cat_class = "one_cat_" . $cat_counter;
												break;
											case 2:
												$cat_class = "two_cat_" . $cat_counter;
												break;
											case 3:
												$cat_class = "three_cat_" . $cat_counter;
												break;
											case 4:
												$cat_class = "four_cat_" . $cat_counter;
												break;
											case 5:
												$cat_class = "five_cat_" . $cat_counter;
												break;
											default:
												if ($cat_counter < 7) {
													$cat_class = $cat_counter;
												} else {
													$cat_class = "more_than_6";
												}
										}
										
									}
								?>
								
								<div class="category_<?php echo $cat_class; ?>">
									<div class="category_grid_box">
										<span class="category_item_bkg" style="background-image:url(<?php echo esc_url($image); ?>)"></span> 
										<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="category_item">
											<span class="category_name"><?php echo esc_html($category->name); ?>
												<span class="category_count"><?php echo esc_html($category->count); ?></span>
											</span>
										</a>
									</div>
								</div>
							
							<?php endforeach; ?>
							
							<div class="clearfix"></div>
							
						</div>
						</div>
					<?php endif; ?>

				<?php elseif ( $shopkeeper_theme_options['category_style'] == 'original_grid' && ($display_mode == 'subcategories' || $display_mode == 'both')): ?>
					<?php if ($categories) : ?>
						<div class="row">
							<ul class="row products products-grid <?php shopkeeper_loop_columns_class(); ?>">								  
								<?php foreach($categories as $category) : ?>
									<?php 
										$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
										$image = wp_get_attachment_url( $thumbnail_id );
									?>
									<li class="category_thumbs category_list column">
										<span class="category_grid_box">
											<span class="category_item_bkg" style="background-image:url(<?php echo esc_url($image); ?>)"></span> 
											<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="category_item">
												<span class="category_name"><?php echo esc_html($category->name); ?></span>
											</a>
										</span>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif;                 
					endif; ?>

				<?php if ($display_mode != 'subcategories') : ?>
		
					<?php if ( (function_exists('woocommerce_product_loop') && woocommerce_product_loop()) || have_posts() ) : ?>
									
						<div class="row">
							<div class="large-12 columns">
								<?php 
								$animateCounter = 0;
								woocommerce_product_loop_start();

									if ( wc_get_loop_prop( 'total' ) ) {
									while ( have_posts() ) {
										the_post();
										$animateCounter++;
										do_action( 'woocommerce_shop_loop' );

										wc_get_template_part( 'content', 'product' );
									}
									}

									woocommerce_product_loop_end();
								?>
								
							</div><!-- .columns -->
						</div>

						<div class="woocommerce-after-shop-loop-wrapper">
							<?php do_action( 'woocommerce_after_shop_loop' ); ?>
						</div>

					<?php else: ?>
						<?php wc_get_template( 'loop/no-products-found.php' ); ?>
			
					<?php endif; ?>
				
				<?php endif; ?>
					
					<?php do_action('woocommerce_after_main_content'); ?>
				
					</div><!--.large-12-->
				</div><!-- .row-->
			</div><!-- #content -->           
		
		</div><!-- .large-12 -->        
	</div><!-- .row -->

	</div><!-- #primary -->

</div>
	

<?php get_footer('main'); ?>
<?php get_footer(); ?>
