<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package ThemeGrill
 * @subpackage accesspress
 * @since accesspress 1.0
 */

add_action( 'widgets_init', 'accesspress_widgets_init');
/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function accesspress_widgets_init() {
   
   register_widget( "accesspress_service_widget" );
   register_widget( "accesspress_featured_posts_widget" );
   register_widget( "accesspress_our_business_widget" );   
}

/**************************************************************************************/

/**
 * Service Widget section.
 */
class accesspress_service_widget extends WP_Widget {
   function __construct() {
      $widget_ops = array( 'classname' => 'widget_service_block', 'description' => __( 'Display some pages as services.', 'accesspress-store' ) );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false, $name = __( 'TG: Service Widget', 'accesspress-store' ), $widget_ops, $control_ops);
   }

   function form( $instance ) {
      $defaults['service_menu_id'] = '';
      $defaults['title'] = '';
      $defaults['text'] = '';
      $defaults['number'] = '6';

      $instance = wp_parse_args( (array) $instance, $defaults );

      $service_menu_id = esc_attr( $instance[ 'service_menu_id' ] );
      $title = esc_attr( $instance['title'] );
      $text = esc_textarea( $instance['text'] );
      $number = absint( $instance[ 'number' ] ); ?>

      <p><?php _e( 'Note: Enter the Service Section ID and use same for Menu item. Only used for One Page Menu.', 'accesspress-store' ); ?></p>

      <p>
         <label for="<?php echo $this->get_field_id('service_menu_id'); ?>"><?php _e( 'Service Section ID:', 'accesspress-store' ); ?></label>
         <input id="<?php echo $this->get_field_id('service_menu_id'); ?>" name="<?php echo $this->get_field_name('service_menu_id'); ?>" type="text" value="<?php echo $service_menu_id; ?>" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'accesspress-store' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
      </p>

      <?php _e( 'Description:','accesspress-store' ); ?>
      <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

      <p>
         <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of pages to display:', 'accesspress-store' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><?php _e( 'Note: Create the pages and select Services Template to display Services pages.', 'accesspress-store' ); ?></p>
   <?php }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'service_menu_id' ] = strip_tags( $new_instance[ 'service_menu_id' ] );
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );

      if ( current_user_can('unfiltered_html') )
         $instance[ 'text' ] =  $new_instance[ 'text' ];
      else
         $instance[ 'text' ] = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'text' ] ) ) ); // wp_filter_post_kses() expects slashed

      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $service_menu_id = isset( $instance[ 'service_menu_id' ] ) ? $instance[ 'service_menu_id' ] : '';
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
      $text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
      $number = empty( $instance[ 'number' ] ) ? 6 : $instance[ 'number' ];

      $page_array = array();
      $pages = get_pages();
      // get the pages associated with Services Template.
      foreach ( $pages as $page ) {
         $page_id = $page->ID;
         $template_name = get_post_meta( $page_id, '_wp_page_template', true );
         if( $template_name == 'page-templates/template-services.php' ) {
            array_push( $page_array, $page_id );
         }
      }

      $get_featured_pages = new WP_Query( array(
         'posts_per_page'        => $number,
         'post_type'             =>  array( 'page' ),
         'post__in'              => $page_array,
         'orderby'               => array( 'menu_order' => 'ASC', 'date' => 'DESC' )
      ) );

      $section_id = '';
      if( !empty( $service_menu_id ) )
         $section_id = 'id="' . $service_menu_id . '"';

      echo $before_widget; ?>
      <div <?php echo $section_id; ?> >
         <div  class="section-wrapper">
            <div class="tg-container">

               <div class="section-title-wrapper">
                  <?php if( !empty( $title ) ) echo $before_title . esc_html( $title ) . $after_title;

                  if( !empty( $text ) ) { ?>
                     <h4 class="sub-title"><?php echo esc_textarea( $text ); ?></h4>
                  <?php } ?>
               </div>

               <?php
               if( !empty( $page_array ) ) {
                  $count = 0; ?>
                  <div class="service-content-wrapper clearfix">
                     <div class="tg-column-wrapper clearfix">

                        <?php while( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();

                           if ( $count % 3 == 0 && $count > 1 ) { ?> <div class="clearfix"></div> <?php } ?>

                           <div class="tg-column-3 tg-column-bottom-margin">
                              <?php
                              $accesspress_icon = get_post_meta( $post->ID, 'accesspress_font_icon', true );
                              $accesspress_icon = isset( $accesspress_icon ) ? esc_attr( $accesspress_icon ) : '';

                              $icon_image_class = '';
                              if( !empty ( $accesspress_icon ) ) {
                                 $icon_image_class = 'service_icon_class';
                                 $services_top = '<i class="fa ' . esc_html( $accesspress_icon ) . '"></i>';
                              }
                              if( has_post_thumbnail() ) {
                                 $icon_image_class = 'service_image_class';
                                 $services_top = get_the_post_thumbnail( $post->ID, 'accesspress-services' );
                              }

                              if( has_post_thumbnail() || !empty ( $accesspress_icon ) ) { ?>

                                 <div class="<?php echo $icon_image_class; ?>">
                                    <div class="image-wrap">
                                       <?php echo $services_top; ?>
                                    </div>
                                 </div>
                              <?php } ?>

                              <div class="service-desc-wrap">
                                 <h5 class="service-title"><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>"> <?php echo esc_html( get_the_title() ); ?></a></h5>

                                 <div class="service-content">
                                    <?php the_excerpt(); ?>
                                 </div>

                                 <a class="service-read-more" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php  _e( 'Read more', 'accesspress-store' ) ?><i class="fa fa-angle-double-right"> </i></a>
                              </div>
                           </div>
                           <?php $count++;
                        endwhile; ?>
                     </div>
                  </div>
                  <?php
                  // Reset Post Data
                  wp_reset_query();
               } ?>
            </div>
         </div>
      </div>
      <?php echo $after_widget;
   }
}

/**************************************************************************************/

/**
 * Featured Posts widget
 */
class accesspress_featured_posts_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_featured_posts_block', 'description' => __( 'Display latest posts or posts of specific category', 'accesspress-store') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Featured Posts', 'accesspress-store' ),$widget_ops);
   }

   function form( $instance ) {
      $defaults[ 'featured_menu_id' ] = '';
      $defaults['background_color'] = '#f1f1f1';
      $defaults['background_image' ] = '';
      $defaults[ 'title' ] = '';
      $defaults[ 'text' ] = '';
      $defaults[ 'number' ] = 3;
      $defaults[ 'type' ] = 'latest';
      $defaults[ 'category' ] = '';
      $defaults['button_text'] = '';
      $defaults['button_url' ] = '';
	  $defaults['display_title' ] = '';

      $instance = wp_parse_args( (array) $instance, $defaults );

      $featured_menu_id = esc_attr( $instance[ 'featured_menu_id' ] );
      $background_color = esc_attr( $instance[ 'background_color' ] );
      $background_image = esc_url_raw( $instance[ 'background_image' ] );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea( $instance[ 'text' ] );
      $number = absint( $instance[ 'number' ] );
      $type = $instance[ 'type' ];
      $category = $instance[ 'category' ];
      $button_text = esc_attr( $instance[ 'button_text' ] );
      $button_url = esc_url( $instance[ 'button_url' ] );
		$display_title = $instance[ 'display_title' ];	  ?>

      <p><?php _e( 'Note: Enter the Featured Post Section ID and use same for Menu item. Only used for One Page Menu.', 'accesspress-store' ); ?></p>
       <p>
         <label for="<?php echo $this->get_field_id( 'featured_menu_id' ); ?>"><?php _e( 'Featured Post Section ID:', 'accesspress-store' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'featured_menu_id' ); ?>" name="<?php echo $this->get_field_name( 'featured_menu_id' ); ?>" type="text" value="<?php echo $featured_menu_id; ?>" />
      </p>

      <p>
         <strong><?php _e( 'DESIGN SETTINGS :', 'accesspress-store' ); ?></strong><br />
         <label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php _e( 'Background Color:', 'accesspress-store' ); ?></label><br />
         <input class="my-color-picker" type="text" data-default-color="#f1f1f1" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo  $background_color; ?>" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'background_image' ); ?>"> <?php _e( 'Image:', 'accesspress-store' ); ?> </label> <br />

         <?php
         if ( $background_image  != '' ) :
            echo '<img id="' . $this->get_field_id( 'background_image' . 'preview' ) . '"src="' . $background_image . '"style="max-width: 250px;" /><br />';
         endif;
         ?>
         <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'background_image' ); ?>" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="<?php echo $background_image; ?>" style="margin-top: 5px;"/>

         <input type="button" class="button button-primary custom_media_button" id="custom_media_button_portfolio" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="<?php _e( 'Upload Image', 'accesspress-store' ) ?>" style="margin-top: 5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( 'background_image' ); ?>' ); return false;"/>
      </p>

      <strong><?php _e( 'OTHER SETTINGS :', 'accesspress-store' ); ?></strong><br />

      <p>
         <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'accesspress-store' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <?php _e( 'Description:','accesspress-store' ); ?>
      <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>

      <p>
         <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to display:', 'accesspress-store' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p>
         <input type="radio" <?php checked( $type, 'latest' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'accesspress-store' );?><br />
         <input type="radio" <?php checked( $type,'category' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'accesspress-store' );?><br />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'accesspress-store' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text:', 'accesspress-store' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo $button_text; ?>" />
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php _e( 'Button Redirect Link:', 'accesspress-store' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="text" value="<?php echo $button_url; ?>" />
      </p>
	  <p>
		<label for="<?php echo $this->get_field_id( 'display_title' ); ?>"><?php _e( 'Display title:', 'accesspress-store' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'display_title' ); ?>" name="<?php echo $this->get_field_name( 'display_title' ); ?>" type="checkbox" checked="<?php echo $button_url; ?>" />
	  </p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;

      $instance[ 'featured_menu_id' ] = strip_tags( $new_instance[ 'featured_menu_id' ] );
      $instance[ 'background_color' ] = $new_instance[ 'background_color' ];
      $instance[ 'background_image' ] = esc_url_raw( $new_instance[ 'background_image' ] );
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      if ( current_user_can( 'unfiltered_html' ) )
         $instance[ 'text' ] =  $new_instance[ 'text' ];
      else
         $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance[ 'text' ]) ) ); // wp_filter_post_kses() expects slashed
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];
      $instance[ 'button_text' ] = strip_tags( $new_instance[ 'button_text' ] );
      $instance[ 'button_url' ] = esc_url_raw( $new_instance[ 'button_url' ] );
	  $instance[ 'display_title' ] =  strip_tags($new_instance[ 'display_title' ]) ;

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $featured_menu_id = isset( $instance[ 'featured_menu_id' ] ) ? $instance[ 'featured_menu_id' ] : '';
      $background_color = isset( $instance[ 'background_color' ] ) ? $instance[ 'background_color' ] : '';
      $background_image = isset( $instance[ 'background_image' ] ) ? $instance[ 'background_image' ] : '';
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
      $text = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
      $number = empty( $instance[ 'number' ] ) ? 3 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
      $button_text = isset( $instance[ 'button_text' ] ) ? $instance[ 'button_text' ] : '';
      $button_url = empty( $instance[ 'button_url' ] ) ? '#' : $instance[ 'button_url' ];
	  $display_title = empty( $instance[ 'display_title' ] ) ? "off" : $instance[ 'display_title' ];
		$display_title = ($display_title=="off") ? "block;": "none;";
      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'news',
            'ignore_sticky_posts'   => true
         ) );
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'news',
            'category__in'          => $category
         ) );
      }
//print_r($get_featured_posts);
      if ( !empty( $background_image ) ) {
         $bg_image_style = 'background-image:url(' . $background_image . ');background-repeat:no-repeat;background-size:cover;background-attachment:fixed;';
         $bg_image_class = 'parallax-section';
      }else {
         $bg_image_style = 'background-color:' . $background_color . ';';
         $bg_image_class = 'no-bg-image';
      }

      $section_id = '';
      if( !empty( $featured_menu_id ) )
         $section_id = 'id="' . $featured_menu_id . '"';

      echo $before_widget; ?>

      <div <?php echo $section_id; ?> class="<?php echo $bg_image_class ?>" style="<?php echo $bg_image_style; ?>">
         <div class="parallax-overlay"> </div>
         <div class="section-wrapper">
            <div class="tg-container">

               <div class="section-title-wrapper" style="display:<?php echo $display_title;?>">
                  <?php if ( !empty( $title ) ) { echo $before_title . esc_html( $title ) . $after_title; } ?>
                  <?php if ( !empty( $text ) ) { ?>
                     <h4 class="sub-title">
                        <?php echo esc_textarea( $text ); ?>
                     </h4>
                  <?php } ?>
               </div>

               <div class="blog-content-wrapper clearfix">
               <div class="tg-column-wrapper clearfix">

                  <?php
                  $count = 0;
                  while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();

                     if ( $count % 4 == 0 && $count > 1 ) { ?> <div class="clearfix"></div> <?php } ?>

                     <div class="tg-column-4 tg-column-bottom-margin">
                     <div class="blog-block">

                        <?php if( has_post_thumbnail() ) { ?>
                           <div class="blog-img">
                              <?php the_post_thumbnail('accesspress-featured-image'); ?>
                           </div>
                         <?php } ?>

                        <div class="blog-content-wrapper postcontent_height">

                           <h5 class="blog-title"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a></h5>

                           <div class="posted-date">

                              <?php if( has_category() ) { ?>
                                 <span>
                                    <?php _e( 'Posted ', 'accesspress-store' );
                                    ?>
                                 </span>
                              <?php } ?>
                              <!--<span>
                                 <?php _e( 'by ', 'accesspress-store' ); ?>
                                 <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a>
                              </span>-->

                              <span>
                                 <?php _e( 'on ', 'accesspress-store' );

                                 $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

                                 $time_string = sprintf( $time_string,
                                    esc_attr( get_the_date( 'c' ) ),
                                    esc_html( get_the_date() )
                                 );
                                 printf( __( '<span><a href="%1$s" title="%2$s" rel="bookmark"> %3$s</a></span>', 'accesspress-store' ),
                                    esc_url( get_permalink() ),
                                    esc_attr( get_the_time() ),
                                    $time_string
                                 ); ?>
                              </span>
                           </div>

                           <div class="blog-content">
                              <?php echo excerpt(14); ?>
                           </div>

                           <a class="blog-readmore" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php echo __( 'Read more' , 'accesspress-store' ) ?> <i class="fa fa-angle-double-right"> </i> </a>
                        </div>

                     </div><!-- .blog-block -->
                     </div><!-- .tg-column-3 -->

                  <?php $count++;
                  endwhile;

                  if( !empty( $button_text ) ) { ?>
                     <div class="clearfix"></div>

                     <a class="blog-view" href="<?php echo $button_url; ?>" title="<?php echo esc_attr( $button_text ); ?>"><?php echo esc_html( $button_text ); ?></a>
                  <?php } ?>
					<script type="text/javascript">
				/*jQuery(window).load(function(){
						jQuery.each( jQuery('.postcontent_height'), function(k,v){
							var height1 = jQuery(jQuery('.postcontent_height')[k]).height();
							var height2 = jQuery(jQuery('.postcontent_height')[k+1]).height();
							var height = ( height1 > height2 ? height1 : height2 );	
height = height + 10;							
							jQuery(jQuery('.postcontent_height')[k]).height( height );
							jQuery(jQuery('.postcontent_height')[k+1]).height( height );
						});
						jQuery.each( jQuery('.tg-column-3'), function(k,v){
							var height1 = jQuery(jQuery('.tg-column-3')[k]).height();
							var height2 = jQuery(jQuery('.tg-column-3')[k+1]).height();
							var height = ( height1 > height2 ? height1 : height2 );							
							jQuery(jQuery('.tg-column-3')[k]).height( height );
							jQuery(jQuery('.tg-column-3')[k+1]).height( height );
						});
					});*/
				</script>
               </div><!-- .tg-column-wrapper -->
               </div><!-- .blog-content-wrapper -->

            </div><!-- .tg-container -->
         </div><!-- .section-wrapper -->
      </div>

      <?php
      // Reset Post Data
      wp_reset_query();
      echo $after_widget;
   }
}

/**************************************************************************************/

/**
 * Our Business section.
 */
class accesspress_our_business_widget extends WP_Widget {
   function __construct() {
      $widget_ops = array( 'classname' => 'widget_our_business_block', 'description' => __( 'Show Our Business.', 'accesspress-store' ) );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false, $name = __( 'TG: Our Business Widget', 'accesspress-store' ), $widget_ops, $control_ops);
   }

   function form( $instance ) {
      $defaults['team_menu_id'] = '';
      $defaults[ 'background_color' ] = '#575757';
      $defaults[ 'background_image' ] = '';
      $defaults['title'] = '';
      $defaults['text'] = '';
      $defaults['number'] = '3';

      $instance = wp_parse_args( (array) $instance, $defaults );

      $team_menu_id = esc_attr( $instance[ 'team_menu_id' ] );
      $background_color = esc_attr( $instance[ 'background_color' ] );
      $background_image = esc_url_raw( $instance[ 'background_image' ] );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea( $instance['text'] );
      $number = absint( $instance[ 'number' ] );
      ?>

      <p><?php _e( 'Note: Enter the Our Business Section ID and use same for Menu item. Only used for One Page Menu.', 'accesspress-store' ); ?></p>
      <p>
         <label for="<?php echo $this->get_field_id( 'team_menu_id' ); ?>"><?php _e( 'Our Business Section ID:', 'accesspress-store' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'team_menu_id' ); ?>" name="<?php echo $this->get_field_name( 'team_menu_id' ); ?>" type="text" value="<?php echo $team_menu_id; ?>" />
      </p>
      <p>
         <strong><?php _e( 'DESIGN SETTINGS :', 'accesspress-store' ); ?></strong><br />

         <label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php _e( 'Background Color:', 'accesspress-store' ); ?></label><br />
         <input class="my-color-picker" type="text" data-default-color="#575757" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo  $background_color; ?>" />
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( 'background_image' ); ?>"> <?php _e( 'Background Image:', 'accesspress-store' ); ?> </label> <br />

         <?php
         if ( $instance[ 'background_image' ]  != '' ) :
            echo '<img id="' . $this->get_field_id( 'background_image' . 'preview') . '"src="' . $instance[ 'background_image' ] . '"style="max-width: 250px;" /><br />';
         endif;
         ?>
         <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'background_image' ); ?>" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="<?php echo $instance[ 'background_image' ]; ?>" style="margin-top: 5px;"/>

         <input type="button" class="button button-primary custom_media_button" id="custom_media_button_action" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="<?php _e( 'Upload Image', 'accesspress-store' ) ?>" style="margin-top: 5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( 'background_image' ); ?>' ); return false;"/>
      </p>

      <strong><?php _e( 'OTHER SETTINGS :', 'accesspress-store' ); ?></strong><br />

      <p>
         <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'accesspress-store' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <?php _e( 'Description:','accesspress-store' ); ?>
      <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>

      <p>
         <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of pages to display:', 'accesspress-store' ); ?></label>
         <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>
      <p><?php _e( 'Note: Create the pages and select Our Business Template to display Our business pages.', 'accesspress-store' ); ?></p>
   <?php }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'team_menu_id' ] = strip_tags( $new_instance[ 'team_menu_id' ] );
      $instance['background_color'] =  $new_instance['background_color'];
      $instance['background_image'] =  esc_url_raw( $new_instance['background_image'] );
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );

      if ( current_user_can('unfiltered_html') )
         $instance[ 'text' ] =  $new_instance[ 'text' ];
      else
         $instance[ 'text' ] = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'text' ] ) ) ); // wp_filter_post_kses() expects slashed

      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $team_menu_id = isset( $instance[ 'team_menu_id' ] ) ? $instance[ 'team_menu_id' ] : '';
      $background_color = isset( $instance[ 'background_color' ] ) ? $instance[ 'background_color' ] : '';
      $background_image = isset( $instance[ 'background_image' ] ) ? $instance[ 'background_image' ] : '';
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
      $text = apply_filters( 'widget_text', empty( $instance[ 'text' ] ) ? '' : $instance[ 'text' ], $instance );
      $number = empty( $instance[ 'number' ] ) ? 3 : $instance[ 'number' ];

      $page_array = array();
      $pages = get_pages();
      // get the pages associated with Our Team Template.
      foreach ( $pages as $page ) {
         $page_id = $page->ID;
         $template_name = get_post_meta( $page_id, '_wp_page_template', true );
         if( $template_name == 'page-templates/template-about.php' ) {
            array_push( $page_array, $page_id );
         }
      }

      $get_featured_pages = new WP_Query( array(
         'posts_per_page'        => $number,
		 'post_parent'        => 947,
         'post_type'             =>  array( 'page' ),
         'post__in'              => $page_array,
         'orderby'               => array( 'menu_order' => 'ASC', 'date' => 'DESC' )
      ) );

      if ( !empty( $background_image ) ) {
         $bg_image_style = 'background-image:url(' . $background_image . ');background-repeat:no-repeat;background-size:cover;background-attachment:fixed;';
         $bg_image_class = 'parallax-section';
      }else {
         $bg_image_style = 'background-color:' . $background_color . ';';
         $bg_image_class = 'no-bg-image';
      }

      $section_id = '';
      if( !empty( $team_menu_id ) )
         $section_id = 'id="' . $team_menu_id . '"';

      echo $before_widget; ?>
      <div <?php echo $section_id; ?> class="<?php echo $bg_image_class ?> clearfix" style="<?php echo $bg_image_style; ?>">

         <div class="parallax-overlay"></div>
         <div class="section-wrapper">
            <div class="tg-container">

               <div class="section-title-wrapper">
                  <?php if( !empty( $title ) ) echo $before_title . esc_html( $title ) . $after_title;

                  if( !empty( $text ) ) { ?>
                     <h4 class="sub-title"><?php echo esc_textarea( $text ); ?></h4>
                  <?php } ?>
               </div>

               <?php if( !empty ( $page_array ) ) : ?>
               <div class="team-content-wrapper clearfix">
                  <div class="tg-column-wrapper clearfix">
                     <?php while( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();

                        $title_attribute = the_title_attribute( 'echo=0' ); ?>

                        <div class="tg-column-3 tg-column-bottom-margin">
                           <div class="team-block">

                              <div class="team-img-wrapper">

                                 <div class="team-img">
                                    <?php if( has_post_thumbnail() ) {
                                       the_post_thumbnail( 'accesspress-portfolio-image' );
                                    } else { echo '<img src="' . get_template_directory_uri() . '/images/placeholder-team.jpg' . '">';
                                    } ?>
                                 </div>

                                 <div class="team-name">
                                    <?php the_title(); ?>
                                 </div>
                              </div>

                              <div class="team-desc-wrapper">
                                 <?php
                                 $output = '';
                                 $accesspress_designation = get_post_meta( $post->ID, 'accesspress_designation', true );
                                 if( !empty( $accesspress_designation ) ) {
                                    $accesspress_designation = isset( $accesspress_designation ) ? esc_attr( $accesspress_designation ) : '';
                                    $output .= '<h5 class="team-deg">' . esc_html( $accesspress_designation ) . '</h5>';
                                 }

                                 $output .= '<div class="team-content">' . '<p>' . get_the_excerpt() . '</p></div>';

                                 $output .= '<a class="team-name" href="' . get_permalink() . '" title="' . $title_attribute . '" alt ="' . $title_attribute . '">' . get_the_title() . '</a>';

                                 echo $output; ?>
                              </div>
                           </div><!-- .team-block -->
                        </div><!-- .tg-column-3 -->
                     <?php endwhile;

                     // Reset Post Data
                     wp_reset_query(); ?>
                  </div><!-- .tg-column-wrapper -->
               </div><!-- .team-content-wrapper -->

               <?php endif; ?>

            </div><!-- .tg-container -->
         </div><!-- .section-wrapper -->
      </div>

      <?php echo $after_widget;
   }
}
