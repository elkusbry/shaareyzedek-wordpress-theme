<?php
/**
 * Template Name: Education Template
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
				$parent = 33;
				$args=array(
				  'child_of' => $parent
				);
				$pages = get_pages($args);  
				if ($pages) {
				  $pageids = array();
				  foreach ($pages as $page) {
					$pageids[]= $page->ID;
				  }
				
				  $args=array(
					'title_li' => '<h2>Browse Topics:</h2>',
					'include' =>  $parent . ',' . implode(",", $pageids)
				  );
				  wp_list_pages($args);
				}
				?>
			</div>			
			
			
			
			<div id="content" role="main">
				
			<?php
			/* Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
			 get_template_part( 'loop', 'page' );
			?>

			</div><!-- #content -->
		</div><!-- #container -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
