<?php
/**
 * Template Name: home template
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
				<div class="home-text">
					<img src="http://www.shaareyzedek.org/wp-content/uploads/2016/02/Static-Splash-page.jpg" alt="Congregation Shaarey Zedek | Southfield, MI" title="Congregation Shaarey Zedek | Southfield, MI" style="max-width:100%;" width="800" height="532" class="alignleft size-full wp-image-303" />
					<p style="float:left;width:100%;font-size:15px;">
						Congregation Shaarey Zedek is a warm, welcoming, inclusive and egalitarian Conservative Jewish community. We provide to all generations innovative, stimulating and diverse spiritual, educational, leadership and social opportunities that nurture our love and commitment to Jewish life, our Synagogue, our country and the State of Israel.
						<div class="home-seeall alignright">
						<a href="<?php bloginfo('url'); ?>/about">Learn More...</a>
					</div>
					</p>
					<div style="clear:both;"></div>
				</div>
				<div class="home-content">
					<form id="searchform" method="get" action="<?php bloginfo('siteurl')?>/">
						<input type="text" name="s" id="s" class="textbox" value="Search the Site..." onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
						<input class="button main" id="btnSearch" type="submit" name="submit" value="<?php _e('Search'); ?>" />
					</form>
				</div>
				<div class="home-content home-events">
					<div class="home-h1"><h1><a href="<?php bloginfo('url'); ?>/services">Upcoming Services:</a></h1></div>
						<?php echo do_shortcode( '[gcal id="3424" interval="events" interval_count="4" display="grouped-list"]' ); ?>
					<div class="home-seeall alignright"><a href="<?php bloginfo('url'); ?>/services">All Service Times...</a></div>
				</div>
				<div class="home-content home-recent-news">
					<div class="home-h1"><h1><a href="<?php bloginfo('url'); ?>/news">Congregation News:</a></h1></div>
						<ul>
							<?php query_posts('showposts=3'); ?>
							<?php while (have_posts()) : the_post(); ?>
							<li>
								<div style="float:left; width:100%;">
									<a href="<?php the_permalink() ?>">
										<?php 
										if ( has_post_thumbnail() ) {
											the_post_thumbnail('thumbnail', array('class' => 'alignleft')); 
										} else {
											if ( in_category( 'shabbat-message' ) ){ 
												echo '<img src="'. get_site_url($blog_id) .'/wp-content/uploads/2013/06/shabbat_icon.jpg" class="alignleft wp-post-image" />';
											} else if ( in_category( 'israel-update' ) ){ 
												echo '<img src="'. get_site_url($blog_id) .'/wp-content/uploads/2013/06/isrealnews-icon.jpg" class="alignleft wp-post-image" />';
											} else {
												echo '<img src="'. get_site_url($blog_id) .'/wp-content/uploads/2012/11/wp_icon.jpg" class="alignleft wp-post-image" />';
											}
										} 
										?>
									</a>
									<div class="recent-home-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
									<div style="float: left; width: 460px;"><?php the_excerpt(__('(more…)')); ?></div>
								<div class="social-buttons-page">
									<div class="social-btn">
										<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php echo get_the_title(); ?>" data-url="<?php echo get_permalink(); ?>" data-via="shaareyzedek">Tweet</a>
										<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
										</div>
										<div class="fb-like social-btn" data-href="<?php the_permalink();?>" data-send="false" data-layout="button_count" data-show-faces="false" data-action="like"></div>					
								</div>
							</div>
							</li>
							<?php endwhile; // end of the loop.?>
						</ul>
					<div class="home-seeall alignright"><a href="<?php bloginfo('url'); ?>/news">All Congregation News...</a></div>
				</div>	
				<div class="home-content home-events">
					<div class="home-h1"><h1><a href="<?php bloginfo('url'); ?>/events">Upcoming Events:</a></h1></div>
						<?php echo do_shortcode( '[google-calendar-events id="7,8" type="list-grouped" max="6"]' ); ?>
					<div class="home-seeall alignright"><a href="<?php bloginfo('url'); ?>/events">All Congregation Events...</a></div>
				</div>
				<div class="home-content">	
					<div class="home-h1"><h1>Recent Publications:</h1></div>	
					<?php
						echo '<ul class="scribd-xml">';
						
						$scribdArray = array(4288278, 4288279, 4288263);
	
						foreach ($scribdArray as $value) {
											
							$xml = simplexml_load_file('http://api.scribd.com/api?method=collections.listDocs&api_key=21hj7rcn7eui0qn32zx3k&collection_id='.$value);
							console.log($xml);
							$count = 1;
							
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
						}
						
						echo '</ul>';					
					?>
				</div>
				<div class="home-content home-involve">
					<div class="home-h1"><h1>Get Involved:</h1></div>
						
						<div style="margin-left:40px; float:left;width:100%;">
							<ul>
								<li ><a class="button main" href="<?php echo get_site_url(); ?>/faqs/#8">Volunteer</a></li>
								<li ><a class="button main" href="<?php echo get_site_url(); ?>/sisterhood/">Sisterhood</a></li>
								<li><a class="button main" href="<?php echo get_site_url(); ?>/mens-club/">Men's Club</a></li>
								<li><a class="button main" href="<?php echo get_site_url(); ?>/seniors/">Seniors</a></li>
							</ul>
						</div>
					<div class="home-seeall alignright"></div>
				</div>
				<div class="home-content meet-the-team">
					<div class="home-h1"><h1><a href="<?php bloginfo('url'); ?>/staff">Meet The Team:</a></h1></div>
						<div style="float:left;width:100%;">
							<a href="<?php bloginfo('url'); ?>/staff">
                        <img class="img-thumbnail" src="http://www.shaareyzedek.org/wp-content/uploads/2012/11/Rabbi_Starr_Small-150x150.jpg">
                        <img class="img-thumbnail" src="http://www.shaareyzedek.org/wp-content/uploads/2013/07/Cantor-David-Propis-150x150.jpg">
                        <img class="img-thumbnail" src="http://www.shaareyzedek.org/wp-content/uploads/2012/11/1242gutmana-300x1991-150x150.jpg">
                     </a>
						</div>
					<div class="home-seeall alignright"><a href="<?php bloginfo('url'); ?>/staff">Meet the Whole Team...</a></div>
				</div>
				<div class="home-content ">
					<div class="home-h1"><h1><a href="<?php bloginfo('url'); ?>/join-congregation-shaarey-zedek/">Looking To Join:</a></h1></div>
						<p class="">
							Join the families of the Metro Detroit area at Congregation Shaarey Zedek. 
						</p>
						<div style="margin-left:40px; float:left;width:100%;height:100px;">
							<ul>
								<a href="<?php bloginfo('url'); ?>/join-congregation-shaarey-zedek/" class="button main">Join Us</a> 
								<a href="<?php bloginfo('url'); ?>/join-congregation-shaarey-zedek/" class="button secondary">Learn More</a>
							</ul>
						</div>
						<div class="home-seeall alignright"></div>
				</div>
				
				
			
				
				
				
				
				
				
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
