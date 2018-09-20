<?php
/*
Template Name: Shop Template
*/
?>

<?php
	
    global $shopkeeper_theme_options;
	
	$page_id = "";
	if ( is_single() || is_page() ) {
		$page_id = get_the_ID();
	} else if ( is_home() ) {
		$page_id = get_option('page_for_posts');		
	}

    $page_header_src = "";

    if (has_post_thumbnail()) $page_header_src = wp_get_attachment_url( get_post_thumbnail_id( $page_id ) );
	
	if (get_post_meta( $page_id, 'page_title_meta_box_check', true )) {
		$page_title_option = get_post_meta( $page_id, 'page_title_meta_box_check', true );
	} else {
		$page_title_option = "on";
	}	
	
?>


	<!--Body Container-->
<div class="main--container <?php echo $shop_has_sidebar ? ' shop-has-sidebar':'';?>">

<!--Header/Nav-->
<?php get_header('welcome'); ?>


<div class="travel__header header-bg">

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
    <?php while ( have_posts() ) : the_post(); ?>

        <div class="entry-content">
            <?php the_content(); ?>
        </div><!-- .entry-content -->
            
        <?php
            // If comments are open or we have at least one comment, load up the comment template
            if ( comments_open() || '0' != get_comments_number() ) comments_template();
        ?>

    <?php endwhile; ?>





</div>


<!--End body, begin footer-->
    
<?php get_footer('main'); ?>
<?php get_footer(); ?>
