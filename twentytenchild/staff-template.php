<?php
/**
 * Template Name: Staff Template
 *
 * A custom page template.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>


		<div id="container">
			<div class="faqbrowse">
				<?php 
				// use wp_list_pages to display parent and all child pages all generations (a tree with parent)
					$parent = 25;
					$args = array(
					  'child_of' => $parent
					);
					$pages = get_pages($args);  
					if ($pages) {
						$pageids = array();
						foreach ($pages as $page) {
						$pageids[]= $page->ID;
						}				
						$args=array(
						'title_li' => '<h2>Browse Staff:</h2>',
						'include' =>  $parent . ',' . implode(",", $pageids)
						);
						wp_list_pages($args);
					}
				?>
			</div><!-- #faqbrowse -->		
			<div id="content" role="main">								
				<?php $child_pages = $wpdb->get_results("SELECT *    FROM $wpdb->posts WHERE post_parent = ".$post->ID."    AND post_type = 'page' ORDER BY menu_order", 'OBJECT'); ?>
				<?php if ( $child_pages ) : foreach ( $child_pages as $pageChild ) : setup_postdata( $pageChild ); ?>
				<a href="<?php echo get_permalink($pageChild->ID); ?>" rel="bookmark" title="<?php echo $pageChild->post_title; ?>">
				<div class="child-thumb">
					<?php if ( has_post_thumbnail($pageChild->ID) ) {
						echo get_the_post_thumbnail($pageChild->ID, 'thumbnail', array('class' => 'alignleft')); 
						} else { ?>
						<img src="http://www.shaareyzedek.org/wp-content/uploads/2013/09/wp_icon.jpg" class="alignleft wp-post-image" />
						<?php } 
					?>
				<span><?php echo $pageChild->post_title; ?></span>
				</div></a>
				<?php endforeach; endif;
				?>
					<?php
					/* Run the loop to output the page.
					 * If you want to overload this in a child theme then include a file
					 * called loop-page.php and that will be used instead.
					 */
					 get_template_part( 'loop', 'page' );
				?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
