<?php
/**
 * Template Name: Scribd XML Temp
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container" class="one-column">
			<div id="content" role="main">
			
			

			<?php
			/* Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
			 get_template_part( 'loop', 'page' );
			?>
			

<!-- 		xml feed from scribd to pull the latest documents -->
			<div class="scribd-logo-container">
				<a href="http://www.scribd.com/ShaareyZedek"><img class="scribd-logo" src="http://www.shaareyzedek.org/wp-content/uploads/2013/06/scribd_logo.png" /></a>
			</div>
			<?php
				$yahrzeitListId = 4288279;
				$shabbatCardIs = 4288278;
				$theRecorderId = 4288263;
				
				$scribdCollection="";
				$currentPage = get_the_ID();
				
				switch ($currentPage)
				{
				case "1327":
				  $scribdCollection = $yahrzeitListId;
				  break;
				case "1323":
				  $scribdCollection = $shabbatCardIs;
				  break;
				case "1330":
				  $scribdCollection = $theRecorderId;
				  break;
				default:
				  echo "";
				}
				
				
			
				$xml = simplexml_load_file('http://api.scribd.com/api?method=collections.listDocs&api_key=21hj7rcn7eui0qn32zx3k&collection_id='.$scribdCollection);
				
				$count = 12;
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
				
				echo '<div>';
					echo '<a class="button main" href="http://www.scribd.com/collections/' . $scribdCollection . '/" target="_blank"
					
					>View All ' . get_the_title($ID) . ' Releases</a>';
				echo '</div>';
			?>
			
			

			</div><!-- #content -->
		</div><!-- #container -->
		
<?php get_sidebar(); ?>
<?php get_footer(); ?>
