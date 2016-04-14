<?php

add_action('admin_menu', 'free_register_newsdesigns_submenu_page');

function free_register_newsdesigns_submenu_page() {
	add_submenu_page( 'edit.php?post_type=news', 'Pro News Designs', 'Pro News Designs', 'manage_options', 'newsdesigns-submenu-page', 'free_newsdesigns_page_callback' );
}

function free_newsdesigns_page_callback() {
	
	$result ='<div class="wrap"><div id="icon-tools" class="icon32"></div><h2 style="padding:15px 0">Pro News Designs</h2></div>
	<a href="http://wponlinesupport.com/wp-plugin/sp-news-and-scrolling-widgets/" target="_blank"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/News_banner.png"></a>
	<div class="medium-12 wpcolumns"><h3>News Slider/Carousel</h3>
	<p><b>Complete shortcode is:</b><br /><code>[sp_news_slider design="design-1" slides_column="1" slides_scroll="1" dots="true" arrows="true" autoplay="true" autoplay_interval="3000" speed="300"
	loop="true" limit="5" category="5" category_name="Sports" show_read_more="false" show_date="true" show_category_name="true" show_content="true" content_words_limit="20"]</code></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-1.jpg"><p><code>[sp_news_slider design="design-1"]</code></p></div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-2.jpg"><p><code>[sp_news_slider design="design-2"]</code></p></div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-3.jpg"><p><code>[sp_news_slider design="design-3"]</code></p></div></div>
				<div class="medium-3 wpcolumns" ><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-4.jpg"><p><code>[sp_news_slider design="design-4"]</code></p></div></div>
				<div class="medium-3 wpcolumns" style="clear:both"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-5.jpg"><p><code>[sp_news_slider design="design-5"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns" ><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-6.jpg"><p><code>[sp_news_slider design="design-6" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</p></div></div>				
				<div class="medium-3 wpcolumns" ><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-7.jpg"><p><code>[sp_news_slider design="design-7" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</p></div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-8.jpg"><p><code>[sp_news_slider design="design-8" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns" style="clear:both"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-9.jpg"><p><code>[sp_news_slider design="design-9" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-10.jpg"><p><code>[sp_news_slider design="design-10" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-11.jpg"><p><code>[sp_news_slider design="design-11" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-12.jpg"><p><code>[sp_news_slider design="design-12" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-13.jpg"><p><code>[sp_news_slider design="design-13" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-14.jpg"><p><code>[sp_news_slider design="design-14" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-15.jpg"><p><code>[sp_news_slider design="design-15" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-32.jpg"><p><code>[sp_news_slider design="design-32" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-33.jpg"><p><code>[sp_news_slider design="design-33" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-38.jpg"><p><code>[sp_news_slider design="design-38"]</code></p></div></div>
				
				<div class="medium-12 wpcolumns"><h3>News Grid View and Block View</h3>				
	<p><b>Complete shortcode is:</b><br /><code>[sp_news design="design-16" limit="5" grid="2" category="5" category_name="Sports" pagination="true"  show_date="true" 
	show_category_name="true" show_content="true" show_full_content="true" content_words_limit="20" show_read_more="false"]</code></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-16.jpg"><p><code>[sp_news design="design-16" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-17.jpg"><p><code>[sp_news design="design-17" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-18.jpg"><p><code>[sp_news design="design-18" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-19.jpg"><p><code>[sp_news design="design-19" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-20.jpg"><p><code>[sp_news design="design-20" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-21.jpg"><p><code>[sp_news design="design-21" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-22.jpg"><p><code>[sp_news design="design-22" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-23.jpg"><p><code>[sp_news design="design-23" limit="3" pagination="false"]</code></p>Use same paramater as given</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-24.jpg"><p><code>[sp_news design="design-24"]</code></p>Only List View</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-25.jpg"><p><code>[sp_news design="design-25" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-26.jpg"><p><code>[sp_news design="design-26"]</code></p>Only List View</div></div>
					<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-27.jpg"><p><code>[sp_news design="design-27"]</code></p>Only List View</div></div>
					<div class="medium-3 wpcolumns" style="clear:both"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-28.jpg"><p><code>[sp_news design="design-28" limit="4" pagination="false"]</code></p>Use same paramater as given</div></div>
					<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-29.jpg"><p><code>[sp_news design="design-29" limit="4" pagination="false"]</code></p>Use same paramater as given</div></div>
					<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-30.jpg"><p><code>[sp_news design="design-30" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
					<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-31.jpg"><p><code>[sp_news design="design-31" limit="4" pagination="false"]</code></p>Use same paramater as given</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-34.jpg"><p><code>[sp_news design="design-34" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-35.jpg"><p><code>[sp_news design="design-35" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-36.jpg"><p><code>[sp_news design="design-36"]</code></p></div></div>
				<div class="medium-3 wpcolumns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-37.jpg"><p><code>[sp_news design="design-37" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="medium-12 wpcolumns">
				<a href="http://wponlinesupport.com/wp-plugin/sp-news-and-scrolling-widgets/" target="_blank"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/News_banner.png"></a>
				<h2>Check the demo</h2>
				<p><strong>Check Demo Link</strong> <a href="http://demo.wponlinesupport.com/prodemo/news-plugin-pro/" target="_blank">Pro WP News and Widget Plugin</a></div>';

	echo $result;
}
function free_newsdesign_admin_style(){
	?>
	<style type="text/css">
	.postdesigns{-moz-box-shadow: 0 0 5px #ddd;-webkit-box-shadow: 0 0 5px#ddd;box-shadow: 0 0 5px #ddd; background:#fff; padding:10px;  margin-bottom:15px;}
	.wpcolumn, .wpcolumns {-webkit-box-sizing: border-box;-moz-box-sizing: border-box;  box-sizing: border-box;}
.postdesigns img{width:100%; height:auto;}
@media only screen and (min-width: 40.0625em) {  
  .wpcolumn,
  .wpcolumns {position: relative;padding-left:10px;padding-right:10px;float: left; }
  .medium-1 {    width: 8.33333%; }
  .medium-2 {    width: 16.66667%; }
  .medium-3 {    width: 25%; }
  .medium-4 {    width: 33.33333%; }
  .medium-5 {    width: 41.66667%; }
  .medium-6 {    width: 50%; }
  .medium-7 {    width: 58.33333%; }
  .medium-8 {    width: 66.66667%; }
  .medium-9 {    width: 75%; }
  .medium-10 {    width: 83.33333%; }
  .medium-11 {    width: 91.66667%; }
  .medium-12 {    width: 100%; }   

   }
	</style>
<?php }

add_action('admin_head', 'free_newsdesign_admin_style');
