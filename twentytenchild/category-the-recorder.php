<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

				<h1 class="page-title"><?php
					printf( __( 'Category Archives: %s', 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' );
				?></h1>
				
				
				<?php
			
				
				
			
				$xml = simplexml_load_file('http://api.scribd.com/api?method=collections.listDocs&api_key=21hj7rcn7eui0qn32zx3k&collection_id=4288263');
				
				$count = 20;
				echo '<ul class="scribd-xml">';
				for ( $i = 0; $i < $count; $i++){
					
					if ( $xml->result_set->result[$i]->thumbnail_url != ''){
						$img = $xml->result_set->result[$i]->thumbnail_url;
						$title = $xml->result_set->result[$i]->title;
						$description = $xml->result_set->result[$i]->description;
						$page_count = $xml->result_set->result[$i]->page_count;
						$doc_id = $xml->result_set->result[$i]->doc_id;
						$url = 'http://www.scribd.com/doc/' . $doc_id;					
						echo '<li><a href="'. $url .'" target="_blank" >' . '<img src="' . $img . '" />' . '<p>' . $title . '</p>' . '</a>' . '</li>';
					}	
				}
				echo '</ul>';
				
				echo '<div class="scribd-more-btn">';
					echo '<a href="http://www.scribd.com/collections/4288263/" target="_blank"
					
					>View Older ' . get_the_title($ID) . ' Releases</a>';
				echo '</div>';
			?>
			
			
			
			<!-- 
				<ul>
				<?php
				query_posts( array( 'posts_per_page' => -1, 'category_name' => 'the-recorder' ));
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '<div class="archive-meta">' . $category_description . '</div>';

				/* Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				 */
				// get_template_part( 'loop', 'category' );
				
				while ( have_posts() ) : the_post();
				
				echo '<li><div><a href="' . get_permalink(). '">';
				
				if (has_post_thumbnail()){
					echo get_the_post_thumbnail( $post_id, 'thumbnail');
				}	
				else{
					echo '<img src="http://www.shaareyzedek.org/wp-content/uploads/2012/11/wp_icon.jpg" />';
				}
				echo '<h2 class="entry-title">' . get_the_title($ID) . '</h2>';	
				echo '</a></div></li>';
				?>
				
				<?php endwhile; // End the loop. Whew. ?>
				</ul>
 -->
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
