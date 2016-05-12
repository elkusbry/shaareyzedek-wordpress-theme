<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

			<?php
			/* Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
			get_template_part( 'loop', 'page' );
			?>
<!-- 		xml feed from scribd to pull the latest documents -->
			<?php
				$xml = simplexml_load_file('http://api.scribd.com/api?method=collections.listDocs&api_key=21hj7rcn7eui0qn32zx3k&collection_id=4288278');
				
				$count = 20;
				echo '<ul>';
				for ( $i = 0; $i < $count; $i++){
					
					if ( $xml->result_set->result[$i]->thumbnail_url != ''){
						$img = $xml->result_set->result[$i]->thumbnail_url;
						$title = $xml->result_set->result[$i]->title;
						$description = $xml->result_set->result[$i]->description;
						$page_count = $xml->result_set->result[$i]->page_count;
						$doc_id = $xml->result_set->result[$i]->doc_id;
						$url = 'http://www.scribd.com/doc/' + $doc_id;					
						echo '<li><a href="'. $url .'">' . '<img src="' . $img . '" />' . $title . '</a>' . '</li>';
					}	
				}
				echo '</ul>';
			?>
			<div>
				<a href="http://www.scribd.com/collections/4288278/">View Older <?php echo get_the_title($ID); ?></a>
			</div>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
