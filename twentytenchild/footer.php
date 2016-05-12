<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
	</div><!-- #main -->

	<div id="footer" role="contentinfo">
		<div id="colophon">

<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>

			<div id="site-info">
				<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?> // <a href="<?php echo home_url( '/' ); ?>wp-login.php">Log In</a>
				</a>
			</div><!-- #site-info -->

			<!-- 
<div id="site-generator">
				<?php do_action( 'twentyten_credits' ); ?>
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentyten' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentyten' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s.', 'twentyten' ), 'WordPress' ); ?></a>
			</div><!~~ #site-generator ~~>
 -->

		</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #wrapper -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

</body>


<script>		  
// 	Shows a banner if CSZ is live streaming
	var onAirBanner = '<div class="on-air-banner"><span>On Air</span><p>Watch Services LIVE Now!</p></div>';
	var offAirBanner = '<div class="off-air-banner"><div><span>Off Air</span><p>Services are NOT Live.</p></div></div>';
	
	var pageOutput= ''; // pulls the content to the services page
		
	var mainSanctuary = '<iframe style="border: 0px none transparent;" src="http://www.ustream.tv/embed/13784753?v=3&amp;wmode=direct" height="437" width="800" frameborder="0" scrolling="no"></iframe>';
	var smallChapel = '<iframe width="800" height="437" src="http://www.ustream.tv/embed/13679159?v=3&amp;wmode=direct" scrolling="no" frameborder="0" style="border: 0px none transparent;"></iframe>';
	
	var videoOutput = ''; //pulls the content for the bar above the menu when live
	var pageClose = '<div class="close-button"><p><span>X</span>CLOSE</p></div><div style="clear:both;"></div>';
	var sponsorMessage = '<div class="alert"><strong>Streaming of Services</strong> is generously provided by the <strong>Richard &amp; Sharon (z\'l) Brown Live Streaming Fund</strong>.</div>';
	var mainSanctuaryTitle = '<p>the Sanctuary at Congregation Shaarey Zedek</p>';
	var smallChapelTitle = '<p>the Chapel at Congregation Shaarey Zedek</p>';
	
	var displayBothVideos = '<div class="video-title">' + pageClose + sponsorMessage + '<br />' + mainSanctuaryTitle + '</div>' + mainSanctuary + '<div class="video-title">' + smallChapelTitle + '</div>' + smallChapel;
						
						
	var displayChapelVideo = '<div class="video-title">' + pageClose + sponsorMessage + '<br />' + smallChapelTitle + '</div>' + smallChapel;
						
	
	var displaySanctuaryVideo = '<div class="video-title">' + pageClose + sponsorMessage + '<br />' + mainSanctuaryTitle + '</div>' + mainSanctuary;
						
	
// 	var cszLive;
						
	jQuery(document).ready(function() {
		// 	Gets the ustream json feed and checks to see if the user is live on the air
		
		function getUstream(){		
			jQuery.getJSON( "https://api.ustream.tv/json/channel/all/search/userID:eq:22195169?key=3C0DBE7400C793AD35B3E7FCD62B974B/" + "&callback=?", function( ustream ) {					   
			   // 	checks to see if their is a live feed, if there is display banner on all pages
			   if (ustream[0].status == 'live' || ustream[1].status == 'live')
			   {	
// 			   		cszLive = true;
					jQuery('#watch-live').append(onAirBanner);
					
					// if there is a live feed choose the live feed to display to the user
					if (ustream[0].status == ustream[1].status){
						videoOutput = displayBothVideos;
						pageOutput = sponsorMessage + '<br />' + mainSanctuary + smallChapel;
					}
					else if (ustream[1].status == 'live' && ustream[0].status == 'offline'){
						videoOutput = displaySanctuaryVideo;
						pageOutput = sponsorMessage + '<br />' + mainSanctuary;
					}
					else if (ustream[0].status == 'live' && ustream[1].status == 'offline'){
						videoOutput = displayChapelVideo;
						pageOutput = sponsorMessage + smallChapelTitle + smallChapel;
					}
				} else {
// 					cszLive = false;
					videoOutput = displayBothVideos;
					pageOutput = sponsorMessage + '<br />' + mainSanctuary + smallChapel;
					jQuery('#watch-live').append(offAirBanner);
				}
// 				pageOutput = '<div class="video-title">' + sponsorMessage + '<br />' + '</div>' + mainSanctuary + smallChapel;

				jQuery('.live-video-stream-page').append(pageOutput);
				
				jQuery("#watch-live-player").hide();
				jQuery('#watch-live-player').append(videoOutput);
				
				jQuery("#watch-live").click(function(){
						jQuery("#watch-live-player").toggle('slow')
						jQuery(".on-air-banner").toggle('slow')
					});
			});
		}  //maybe the way to do it is to append / remove videos if they are running or not instead of whole watchlive payer element which would disrupt viewing.
		//break up function between check status and adding videos to the DOM
		getUstream(); //runs the ustream code above
		
// 		function refreshUstream(){
// 			jQuery.ajaxSetup ({  
// 				cache: false 
// 			});  	
// 			
// 			jQuery("#watch-live").empty();
// 			getUstream();
// 				
// 		}
// 		var refreshInterval = setInterval(refreshUstream, 6 * 1000);

});
	
	
	
</script>



</html>
