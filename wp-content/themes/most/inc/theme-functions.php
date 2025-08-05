<?php if ( ! defined( 'ABSPATH' ) ) { exit( 'Direct script access denied.' ); }

// Menu
function most_primary_menu() {

    $manu_class = 'navbar-nav';

    if ( ! class_exists( 'acf' ) ) {
        $manu_class = 'navbar-nav';
    } else {
        if ( get_field('menu_variation') ) {
            
            if (get_field('menu_variation') == 'default') {
                $manu_class = 'navbar-nav';
            } else {
                $manu_class = 'navbar-nav-button';
            }        
        }     
    }

    echo wp_nav_menu( array(
        'theme_location' => 'primary-menu',
        'container' => true,
        'depth' => 3,
        'menu_id'        => 'primary-menu',
        'menu_class'     => $manu_class,
    ) );
}

// Theme Mode
function most_theme_mode() {
    if(get_theme_mod( 'mode_switcher' )) {
        $out = most_theme_mode_cookie();
    } else {
        if(get_theme_mod( 'theme_mode' )) {
            $out = get_theme_mod( 'theme_mode' );
        } else {
            $out = "light";
        }
    }
    return $out;
}

function most_theme_mode_cookie() {
    if (empty($_COOKIE["theme-mode"])) {
        if(get_theme_mod( 'theme_mode' )) {
            $theme_mode = get_theme_mod( 'theme_mode' );
        } else {
            $theme_mode = 'light';
        }
        return $theme_mode;
    }
    
    if(!isset($_COOKIE["theme-mode"])) {
        $theme_mode = get_theme_mod( 'theme_mode' );
    } else {
        $theme_mode = $_COOKIE["theme-mode"];
    }
    return $theme_mode;

}
function most_theme_mode_cheked() {

    $theme_mode = most_theme_mode_cookie();
    if ($theme_mode === 'light') {
        $cheked = 'checked';
    } else {
        $cheked = '';
    }
    return $cheked;
    
}

// Menu Type
function most_menu_type() {

    get_template_part( 'template-parts/menu/default', get_post_format() );
    
}

// Menu Widgets
function most_menu_widgets() {

    if ( get_theme_mod( 'cart_widget' ) === true ) {
        get_template_part( 'template-parts/menu/widgets/cart' );
    } 
    
}

function most_search_widgets() {

    if ( get_theme_mod( 'search_widget' ) === true ) {
        get_template_part( 'template-parts/menu/widgets/search' );
    } 

}

function most_mode_switcher() {

    if( get_theme_mod( 'mode_switcher' ) && get_theme_mod( 'mode_switcher' ) == '1') {
        get_template_part( 'template-parts/menu/widgets/switcher' );
    } 

}

function most_search_woo() {

    if ( is_woocommerce() || is_cart() ) { 
        get_product_search_form(); 
    } else {
        get_search_form();
    }

}

function most_page_transition() {

    if(get_theme_mod( 'page_transition' ) && get_theme_mod( 'page_transition' ) == '1') {
        $transition = '<div id="loaded"></div>';
        return $transition;
    }

}

// Elementor Templates List Footer
function ms_get_elementor_templates( $type = null ) {

    $args = [
        'post_type' => 'elementor_library',
        'posts_per_page' => -1,
    ];

    if ( $type ) {

        $args[ 'tax_query' ] = [
            [
                'taxonomy' => 'elementor_library_type',
                'field' => 'slug',
                'terms' => $type,
            ],
        ];

    }

    $page_templates = get_posts( $args );

    $options[0] = esc_html__( 'Select a Template', 'most' );

    if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ) {
        foreach ( $page_templates as $post ) {
            $options[$post->ID] = $post->post_title;
        }
    } else {

        $options[0] = esc_html__( 'Create a Template First', 'most' );

    }

    return $options;

}

// Footer Parallax Effect
function most_footer_effect() {
    // footer_parallax
    if(get_theme_mod( 'footer_parallax' ) && get_theme_mod( 'footer_parallax' ) == '1') {
        $out = 'on';
        return $out;
    } else {
        $out = 'off';
        return $out;
    }
}

// Footer Parallax Effect
function most_footer_corners() {
    if(get_theme_mod( 'footer_border_corners' ) && get_theme_mod( 'footer_border_corners' ) == '1') {
        $out = 'on';
        return $out;
    } else {
        $out = 'off';
        return $out;
    }
}

// DELETE
function most_one_print_first_instance_of_block( $block_name, $content = null, $instances = 1 ) {
	$instances_count = 0;
	$blocks_content  = '';

	if ( ! $content ) {
		$content = get_the_content();
	}

	// Parse blocks in the content.
	$blocks = parse_blocks( $content );

	// Loop blocks.
	foreach ( $blocks as $block ) {

		// Sanity check.
		if ( ! isset( $block['blockName'] ) ) {
			continue;
		}

		// Check if this the block matches the $block_name.
		$is_matching_block = false;

		// If the block ends with *, try to match the first portion.
		if ( '*' === $block_name[-1] ) {
			$is_matching_block = 0 === strpos( $block['blockName'], rtrim( $block_name, '*' ) );
		} else {
			$is_matching_block = $block_name === $block['blockName'];
		}

		if ( $is_matching_block ) {
			// Increment count.
			$instances_count++;

			// Add the block HTML.
			$blocks_content .= render_block( $block );

			// Break the loop if the $instances count was reached.
			if ( $instances_count >= $instances ) {
				break;
			}
		}
	}

	if ( $blocks_content ) {
		/** This filter is documented in wp-includes/post-template.php */
		echo apply_filters( 'the_content', $blocks_content ); // phpcs:ignore WordPress.Security.EscapeOutput
		return true;
	}

	return false;
}

function ms_render_elementor_template( $template ) {

    if ( ! $template ) {
      return;
    }

    if ( 'publish' !== get_post_status( $template ) ) {
      return;
    }
    if ( did_action( 'elementor/loaded' ) ) {
        $new_frontend = new Elementor\Frontend;
        return $new_frontend->get_builder_content_for_display( $template, false );        
    }

}

// Footer query
function most_get_footer() {
    $args = array(
        'post_type' => 'elementor_library',
        'posts_per_page' => -1,
    );

    $ps = get_posts( $args );
    return $ps;
}

// Sanitize Class
if ( ! function_exists( 'most_sanitize_class' ) ) {
  function most_sanitize_class( $class, $fallback = null ) {

    if ( is_string( $class ) ) {
      $class = explode( ' ', $class );
    }

    if ( is_array( $class ) && count( $class ) > 0 ) {
      $class = array_map( 'sanitize_html_class', $class );
      return implode( ' ', $class );
    } else {
      return sanitize_html_class( $class, $fallback );
    }

  }
}

// Header Class
function most_header_class() {

    if( class_exists('acf')) {

        if (get_field('header_transparent')) {
            $h_transparent = (get_field('header_transparent') == '1' ? ' ms-nb--transparent' : '');
        } else {
            $h_transparent = '';
        }

        if (get_field('header_white') && get_field('header_transparent')) {
            $h_white = (get_field('header_white') == '1' ? ' ms-nb--white' : '');
        } else {
            $h_white = '';
        }

        if ( function_exists('get_field') && get_field('full_width') ) {
            $full_width = get_field('full_width') ? ' full-width' : '';
        } else {
            $full_width = '';
        }
        $h_ac = $h_transparent . $full_width . $h_white;

    } else {
        $h_ac = '';
    }

    if (get_theme_mod('menu_align')) {
        $menu_align = ' menu-' . get_theme_mod('menu_align');
    } else {
        $menu_align = '';
    }

    $menu_class = 'main-header js-main-header auto-hide-header' . $h_ac . $menu_align;

    return most_sanitize_class($menu_class);

}
// Header Type
function most_header_type() {
    $header_style = 'default';
    if ( function_exists('get_theme_mod') ) {
        $header_style = get_theme_mod('type_header');
    }
    return $header_style;
}

// Data Blur
function most_header_blur() {
    $blur_effect = '';
    if ( function_exists('get_theme_mod') ) {
        $blur_effect = get_theme_mod('blur_hedaer') ? 'data-blur=on' : '';
    }
    return $blur_effect;
}

// Posts Loop
function most_posts_loop($items, $cat, $post_id, $order, $orderby) {

    $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'paged' => $paged,
            'posts_per_page' => $items,
            'category_name' => $cat,
            'post__in' => $post_id,
            'orderby' => $orderby,
            'order' => $order
        );
    $query = new WP_Query($args);
    return $query;
}

// Posts Pagination
function most_posts_pagination( $new_query = null ) {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    if ( $new_query == null ) {
        global $wp_query;
        $new_query = $wp_query;
    } 
    /* Stop the code if there is only a single page page */
    if( $new_query->max_num_pages <= 1 )
        return;
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $new_query->max_num_pages );
    /*Add current page into the array */
    if ( $paged >= 1 )
        $links[] = $paged;
    /*Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
    echo '<nav class="pagination" aria-label="Pagination"><ol class="pagination__list">' . "\n";
    /*Display Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li class="page-item prev">%s </li>' . "\n", get_previous_posts_link(esc_html( 'Previous', 'most' )) );
    /*Display Link to first page*/
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class=""' : '';
        printf( '<li%s class=""><a href="%s" class="pagination__item">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
        if ( ! in_array( 2, $links ) )
            echo '<li class=""><span>…</span></li>';
    }
    /* Link to current page */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="page-item active"' : '';
        printf( '<li%s><a href="%s" class="pagination__item">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
    /* Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li class="display--sm">…</li>' . "\n";
        $class = $paged == $max ? ' class="display--sm"' : '';
        printf( '<li%s class="display--sm"><a href="%s" class="pagination__item pagination__item--ellipsis">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link('Next', $max) )
        printf( '<li class="page-item next">%s </li>' . "\n", get_next_posts_link( esc_html( 'Next', 'most' ), $max) );
    echo '</ol></nav>' . "\n";
}

// Related Posts
function most_related_posts() {

$post_id = get_the_ID();
    $cat_ids = array();
    $categories = get_the_category( $post_id );

    if(!empty($categories) && !is_wp_error($categories)):
        foreach ($categories as $category):
            array_push($cat_ids, $category->term_id);
        endforeach;
    endif;

    $current_post_type = get_post_type($post_id);

    $query_args = array( 
        'category__in'   => $cat_ids,
        'post_type'      => $current_post_type,
        'post__not_in'    => array($post_id),
        'posts_per_page'  => '3',
     );

    $related_cats_post = new WP_Query( $query_args );

    return $related_cats_post;
}

// Socials Custom Plugin
function most_twitter_share() {
    $posttags = get_the_tags();
    if ($posttags) {
        foreach($posttags as $tag) {
            echo strtolower('#' . $tag->name . ', '); 
        }
    }
}

// Estimated reading time
function most_reading_time($id) {

    $content = get_post_field( 'post_content', $id );
    $word_count = str_word_count( strip_tags( $content ) );
    $readingtime = ceil($word_count / 200);
    $timer = esc_html( ' min read', 'most' );

    $totalreadingtime = $readingtime . $timer;
    return $totalreadingtime;
    
}

// Custom Comments
function most_comments( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;
	
	switch ( $comment->comment_type ) :
		case 'pingback':
		case 'trackback':
		?>
        <li class="post pingback" id="comment-<?php comment_ID(); ?>">
        	<div class="pingback ms-author-name"><?php comment_author_link(); ?></div>
        	<div class="post-date"><?php comment_date(); ?></div>
        	<div class="ms-commentcontent"><?php comment_text();  ?></div>
        	<?php edit_comment_link( __( 'Edit', 'most' ), '<span class="edit-link">', '</span>' ); ?></p>
    	</li>
		<?php 
		break;
		default: 
		?>
            <li id="comment-<?php comment_ID(); ?>">
            <div <?php comment_class(); ?>>
				<div class="ms-comment-body">
                    <div class="ms-author-vcard">
                        <figure class="avatar__figure" role="img" aria-label="Avatar">
                                <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                            <div class="avatar__img"><?php echo get_avatar( $comment, 50 ); ?></div>
                        </figure>
                    </div>
					<div class="ms-author-vcard-content">
                        <div class="ms-author-vcard--info">
                            <div class="ms-author-name"><?php comment_author(); ?></div>
                            <span class="ms-comment-time"><?php comment_date(); ?></span>
                        </div>					
						<div class="ms-commentcontent">
							<?php comment_text(); ?>
                            <div class="ms-comment-footer">
							<div class="ms-comment-edit">
                                <?php edit_comment_link( $text = '<svg height="14px" version="1.1" viewBox="0 0 24 24" width="14px"><path d="M21.635,6.366c-0.467-0.772-1.043-1.528-1.748-2.229c-0.713-0.708-1.482-1.288-2.269-1.754L19,1C19,1,21,1,22,2S23,5,23,5  L21.635,6.366z M10,18H6v-4l0.48-0.48c0.813,0.385,1.621,0.926,2.348,1.652c0.728,0.729,1.268,1.535,1.652,2.348L10,18z M20.48,7.52  l-8.846,8.845c-0.467-0.771-1.043-1.529-1.748-2.229c-0.712-0.709-1.482-1.288-2.269-1.754L16.48,3.52  c0.813,0.383,1.621,0.924,2.348,1.651C19.557,5.899,20.097,6.707,20.48,7.52z M4,4v16h16v-7l3-3.038V21c0,1.105-0.896,2-2,2H3  c-1.104,0-2-0.895-2-2V3c0-1.104,0.896-2,2-2h11.01l-3.001,3H4z"/></svg>Edit' ); ?></div>
							<div class="ms-comment-reply">
								<?php comment_reply_link( array_merge( $args, array(
									'reply_text' => '<svg height="16px" version="1.1" viewBox="0 0 16 16" width="14px"><g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1"><g fill="none" class="group" transform="translate(0.000000, -336.000000)"><path d="M0,344 L6,339 L6,342 C10.5,342 14,343 16,348 C13,345.5 10,345 6,346 L6,349 L0,344 L0,344 Z M0,344"/></g></g></svg>Reply',
									'depth' => $depth,
									'max_depth' => $args['max_depth'] 
								) ) ); ?>
							</div>
						</div>
						</div>
					</div>
				</div>
            </div>
   	<?php
        break;
    endswitch;
}

// Blog Custom Comments
function most_comments_number() {

	$comment_count = get_comments_number();
	printf(
	    '<span>' . esc_html( _nx( '1 comment', '%1$s comments', get_comments_number(), 'comments title', 'most' ) ),
	    number_format_i18n( get_comments_number() ) . '</span>',
        '<span>' . get_the_title() . '</span>'
	);	
}

// Pagination
function most_link_pages() {
    wp_link_pages( array(
        'before'      => '<div class="page-links">' . __( 'Pages:', 'most' ),
        'after'       => '</div>',
        'link_before' => '<span class="page-number">',
        'link_after'  => '</span>',
    ) );
}


// Load More Button
if( !function_exists( 'most_infinity_load' ) ){

    function most_infinity_load( $query = null ) {
        
        $max = $query->max_num_pages;
        $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

        wp_localize_script( 'most-main-script', 'infinity_load', array(
                'startPage' => $paged,
                'maxPages' => $max,
                'nextLink' => next_posts($max, false)
        ) );
        
    }
    
}

// Custom Excertp
function most_get_excerpt( $id, $count ){
   $permalink = get_permalink( $id );

   $excerpt = get_the_excerpt();
   $excerpt = strip_tags( $excerpt );
   $excerpt = mb_substr( $excerpt, 0, $count );
   $excerpt = mb_substr( $excerpt, 0, strripos( $excerpt, " " ) );
   $excerpt = rtrim( $excerpt, ",.;:- _!$&#" );
   $excerpt = '<p class="post-excerpt">' . $excerpt . '...' . '</p>';

   return $excerpt;
}

// Custom excerpt lenght
add_filter( 'excerpt_length', function($length) {
    return 24;
}, PHP_INT_MAX );