<?php
/**
 * Breadcrumb features
 * Based on unyson breadcrumb
 *
 * @link https://github.com/ThemeFuse/Unyson-Breadcrumbs-Extension
 * @since 1.0.0
 * @package Newkarma Core
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'newkarma_core_current_url' ) ) :
	/**
	 * Get current URL
	 *
	 * @return string Current url
	 */
	function newkarma_core_current_url() {
		static $url = null;
		if ( $url === null ) {
			$url = 'http://';
			/* https://github.com/ThemeFuse/Unyson/issues/126 */
			if ( '_' === $_SERVER['SERVER_NAME'] ) {
				$url .= $_SERVER['HTTP_HOST'];
			} else {
				$url .= $_SERVER['SERVER_NAME'];
			}
			if ( ! in_array( intval( $_SERVER['SERVER_PORT'] ), array( 80, 443 ) ) ) {
				$url .= ':' . $_SERVER['SERVER_PORT'];
			}
			$url .= $_SERVER['REQUEST_URI'];

			$url = set_url_scheme( $url ); /* https fix */
			if ( is_multisite() ) {
				if ( defined( 'SUBDOMAIN_INSTALL' ) && SUBDOMAIN_INSTALL ) {
					$site_url = wp_parse_url( $url );
					if ( isset( $site_url['query'] ) ) {
						$url = home_url( $site_url['path'] . '?' . $site_url['query'] );
					} else {
						$url = home_url( $site_url['path'] );
					}
				}
			}
		}
		return $url;
	}
endif;

/**
 * Classes Breadcrumb
 */

#[\AllowDynamicProperties]
class Newkarma_Core_Breadcrumbs {
	/**
	 * Construct for class breadcrumb
	 *
	 * @param array $settings applied on text breadcrumbs.
	 */
	public function __construct( $settings = array() ) {

		$newkar_breadcrumbs = get_option( 'newkar_breadcrumbs' );

		if ( isset( $newkar_breadcrumbs['breadcrumbs_hometext'] ) && ! empty( $newkar_breadcrumbs['breadcrumbs_hometext'] ) ) {
			// option, section, default.
			$homepage_title = $newkar_breadcrumbs['breadcrumbs_hometext'];
		} else {
			$homepage_title = 'Homepage';
		}

		if ( isset( $newkar_breadcrumbs['breadcrumbs_blogtext'] ) && ! empty( $newkar_breadcrumbs['breadcrumbs_blogtext'] ) ) {
			// option, section, default.
			$blog_title = $newkar_breadcrumbs['breadcrumbs_blogtext'];
		} else {
			$blog_title = 'Blog';
		}

		if ( isset( $newkar_breadcrumbs['breadcrumbs_errortext'] ) && ! empty( $newkar_breadcrumbs['breadcrumbs_errortext'] ) ) {
			// option, section, default.
			$error_title = $newkar_breadcrumbs['breadcrumbs_errortext'];
		} else {
			$error_title = '404 Not found';
		}

		$this->settings['labels'] = array(
			'homepage-title' => esc_attr( $homepage_title ),
			'blogpage-title' => esc_attr( $blog_title ),
			'404-title'      => esc_attr( $error_title ),
		);
		if ( isset( $settings['labels'] ) ) {
			$this->settings['labels'] = array_merge( $this->settings['labels'], $settings['labels'] );
		}
	}
	/**
	 * Determine if the page has parents and in case it has, adds all page parents hierarchy
	 *
	 * @param Number $id page id.
	 *
	 * @return array
	 */
	private function get_page_hierarchy( $id ) {
		$page = get_post( $id );
		if ( empty( $page ) || is_wp_error( $page ) ) {
			return array();
		}
		$return   = array();
		$page_obj = array();

		$page_obj['type']      = 'post';
		$page_obj['post_type'] = $page->post_type;
		$page_obj['name']      = $page->post_title;
		$page_obj['id']        = $id;
		$page_obj['url']       = get_permalink( $id );
		$return[]              = $page_obj;
		if ( $page->post_parent > 0 ) {
			$return = array_merge( $return, $this->get_page_hierarchy( $page->post_parent ) );
		}
		return $return;
	}
	/**
	 * Determine if the term has parents and in case it has, adds all term parents hierarchy
	 *
	 * @param Number $id , term id.
	 * @param String $taxonomy , term taxonomy name.
	 *
	 * @return array
	 */
	private function get_term_hierarchy( $id, $taxonomy ) {
		$term = get_term( $id, $taxonomy );
		if ( empty( $term ) || is_wp_error( $term ) ) {
			return array();
		}
		$return   = array();
		$term_obj = array();

		$term_obj['type']     = 'taxonomy';
		$term_obj['name']     = $term->name;
		$term_obj['id']       = $id;
		$term_obj['url']      = get_term_link( $id, $taxonomy );
		$term_obj['taxonomy'] = $taxonomy;

		$return[] = $term_obj;
		if ( $term->parent > 0 ) {
			$return = array_merge( $return, $this->get_term_hierarchy( $term->parent, $taxonomy ) );
		}
		return $return;
	}
	/**
	 * Determine the current frontend page location, in creates the breadcrumbs array
	 *
	 * @return Array
	 */
	private function build_breadcrumbs() {
		if ( is_admin() ) {
			return array();
		}

		if ( 0 === did_action( 'wp' ) ) {
			return array();
		}

		$return = array(
			0 => array(
				'name' => $this->settings['labels']['homepage-title'],
				'url'  => esc_url( home_url( '/' ) ),
				'type' => 'front_page',
			),
		);

		$custom_page = array();
		if ( is_array( $custom_page ) && ! empty( $custom_page ) ) {
			$return[] = $custom_page;
			return $return;
		}
		if ( is_404() ) {
			$page         = array();
			$page['type'] = '404';
			$page['name'] = $this->settings['labels']['404-title'];
			$page['url']  = newkarma_core_current_url();
			$return[]     = $page;
		} elseif ( is_search() ) {
			$search         = array();
			$search['type'] = 'search';
			$search['name'] = __( 'Searching for:', 'newkarma-core' ) . ' ' . get_search_query();
			$s              = '?s=' . get_search_query();
			$search['url']  = home_url( '/' ) . $s;
			$return[]       = $search;
		} elseif ( is_front_page() ) {
		} elseif ( is_home() ) {
			$blog     = array(
				'name' => $this->settings['labels']['blogpage-title'],
				'url'  => newkarma_core_current_url(),
				'type' => 'front_page',
			);
			$return[] = $blog;
		} elseif ( is_page() ) {
			global $post;
			$return = array_merge( $return, array_reverse( $this->get_page_hierarchy( $post->ID ) ) );
		} elseif ( is_attachment() ) {
			$attachment = array(
				'name' => __( 'Attachment', 'newkarma-core' ),
				'url'  => newkarma_core_current_url(),
				'type' => 'Attachment',
			);
			$return[]   = $attachment;
		} elseif ( is_single() ) {
			global $post;
			$taxonomies = get_object_taxonomies( $post->post_type, 'objects' );
			$slugs      = array();
			if ( ! empty( $taxonomies ) ) {
				foreach ( $taxonomies as $key => $tax ) {
					if ( true === $tax->show_ui && true === $tax->public && false !== $tax->hierarchical ) {
						array_push( $slugs, $tax->name );
					}
				}
				$terms = wp_get_post_terms( $post->ID, $slugs );
				if ( ! empty( $terms ) ) {
					$lowest_term = $this->get_lowest_taxonomy_terms( $terms );
					$term        = $lowest_term[0];
					$return      = array_merge(
						$return,
						array_reverse(
							$this->get_term_hierarchy(
								$term->term_id,
								$term->taxonomy
							)
						)
					);
				}
			}
			$return = array_merge( $return, array_reverse( $this->get_page_hierarchy( $post->ID ) ) );

		} elseif ( is_category() ) {
			$term_id = get_query_var( 'cat' );
			$return  = array_merge( $return, array_reverse( $this->get_term_hierarchy( $term_id, 'category' ) ) );
		} elseif ( is_tag() ) {
			$term_id = get_query_var( 'tag' );
			$term    = get_term_by( 'slug', $term_id, 'post_tag' );
			if ( empty( $term ) || is_wp_error( $term ) ) {
				return array();
			}
			$tag             = array();
			$tag['type']     = 'taxonomy';
			$tag['name']     = $term->name;
			$tag['url']      = get_term_link( $term_id, 'post_tag' );
			$tag['taxonomy'] = 'post_tag';
			$return[]        = $tag;
		} elseif ( is_tax() ) {
			$term_id  = get_queried_object()->term_id;
			$taxonomy = get_query_var( 'taxonomy' );
			$return   = array_merge( $return, array_reverse( $this->get_term_hierarchy( $term_id, $taxonomy ) ) );
		} elseif ( is_author() ) {
			$author         = array();
			$author['name'] = get_queried_object()->data->display_name;
			$author['id']   = get_queried_object()->data->ID;
			$author['url']  = get_author_posts_url( $author['id'], get_queried_object()->data->user_nicename );
			$author['type'] = 'author';
			$return[]       = $author;
		} elseif ( is_date() ) {
			$date = array();
			if ( get_option( 'permalink_structure' ) ) {
				$day   = get_query_var( 'day' );
				$month = get_query_var( 'monthnum' );
				$year  = get_query_var( 'year' );
			} else {
				$m     = get_query_var( 'm' );
				$year  = substr( $m, 0, 4 );
				$month = substr( $m, 4, 2 );
				$day   = substr( $m, 6, 2 );
			}
			if ( is_day() ) {
				$date['name']      = mysql2date( 'd F Y', $day . '-' . $month . '-' . $year );
				$date['url']       = get_day_link( $year, $month, $day );
				$date['date_type'] = 'daily';
				$date['day']       = $day;
				$date['month']     = $month;
				$date['year']      = $year;
			} elseif ( is_month() ) {
				$date['name']      = mysql2date( 'F Y', '01.' . $month . '.' . $year );
				$date['url']       = get_month_link( $year, $month );
				$date['date_type'] = 'monthly';
				$date['month']     = $month;
				$date['year']      = $year;
			} else {
				$date['name']      = mysql2date( 'Y', '01.01.' . $year );
				$date['url']       = get_year_link( $year );
				$date['date_type'] = 'yearly';
				$date['year']      = $year;
			}
			$return[] = $date;
		} elseif ( is_archive() ) {
			$post_type = get_query_var( 'post_type' );
			if ( $post_type ) {
				$post_type_obj   = get_post_type_object( $post_type );
				$archive         = array();
				$archive['name'] = $post_type_obj->labels->name;
				$archive['url']  = get_post_type_archive_link( $post_type );
				$return[]        = $archive;
			}
		}
		foreach ( $return as $key => $item ) {
			if ( empty( $item['name'] ) ) {
				$return[ $key ]['name'] = __( 'No title', 'newkarma-core' );
			}
		}
		return $return;
	}
	/**
	 * Returns the lowest hierarchical term
	 *
	 * @param  array $terms term id.
	 * @return array
	 */
	private function get_lowest_taxonomy_terms( $terms ) {
		// if terms is not array or its empty don't proceed.
		if ( ! is_array( $terms ) || empty( $terms ) ) {
			return false;
		}
		$filter = function( $terms ) use ( &$filter ) {
			$return_terms = array();
			$term_ids     = array();
			foreach ( $terms as $t ) {
				$term_ids[] = $t->term_id;
			}
			foreach ( $terms as $t ) {
				if ( false === $t->parent || ! in_array( $t->parent, $term_ids, true ) ) {
					// remove this term.
				} else {
					$return_terms[] = $t;
				}
			}
			if ( count( $return_terms ) ) {
				return $filter( $return_terms );
			} else {
				return $terms;
			}
		};
		return $filter( $terms );
	}
	/**
	 * Returns the breadcrumbs array
	 *
	 * @return string
	 */
	public function get_breadcrumbs() {
		return $this->build_breadcrumbs();
	}
}

if ( ! function_exists( 'newkarma_core_view_breadcrumbs' ) ) :
	/**
	 * Displaying html for breadcrumb
	 *
	 * @return void
	 */
	function newkarma_core_view_breadcrumbs() {

		$breadcrumbs   = new Newkarma_Core_Breadcrumbs();
		$data['items'] = $breadcrumbs->get_breadcrumbs();

		$items = $data['items'];

		$newkar_breadcrumbs = get_option( 'newkar_breadcrumbs' );

		if ( isset( $newkar_breadcrumbs['enable_breadcrumbs'] ) && ! empty( $newkar_breadcrumbs['enable_breadcrumbs'] ) ) {
			// option, section, default.
			$option = $newkar_breadcrumbs['enable_breadcrumbs'];
		} else {
			$option = 'on';
		}

		if ( ! is_front_page() && ! is_home() && ! empty( $items ) && ( 'on' === $option ) ) { ?>
			<div class="breadcrumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
				<?php
				$countitems = count( $items );
				for ( $i = 0; $i < $countitems; $i ++ ) :
					?>
					<?php if ( ( count( $items ) - 1 === $i ) ) : ?>
						<span class="last-item screen-reader-text" itemscope itemtype="https://schema.org/ListItem">
							<span itemprop="name"><?php echo esc_html( $items[ $i ]['name'] ); ?></span>
							<span itemprop="position" content="<?php echo esc_html( $i + 1 ); ?>"></span>
						</span>
					<?php elseif ( 0 === $i ) : ?>
						<?php if ( isset( $items[ $i ]['url'] ) ) : ?>
							<span class="first-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
								<a itemscope itemtype="https://schema.org/WebPage" itemprop="item" itemid="<?php echo esc_url( $items[ $i ]['url'] ); ?>" href="<?php echo esc_url( $items[ $i ]['url'] ); ?>">
									<span itemprop="name"><?php echo esc_html( $items[ $i ]['name'] ); ?></span>
								</a>
								<span itemprop="position" content="<?php echo esc_html( $i + 1 ); ?>"></span>
							</span>
						<?php else : ?>
							<span class="first-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
								<span itemprop="name"><?php echo esc_html( $items[ $i ]['name'] ); ?></span>
								<span itemprop="position" content="<?php echo esc_html( $i + 1 ); ?>"></span>
							</span>
						<?php endif; ?>
					<?php else : ?>
						<span class="separator">/</span>
						<?php if ( isset( $items[ $i ]['url'] ) ) : ?>
							<span class="<?php echo esc_attr( $i - 1 ); ?>-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
								<a itemscope itemtype="https://schema.org/WebPage" itemprop="item" itemid="<?php echo esc_url( $items[ $i ]['url'] ); ?>" href="<?php echo esc_url( $items[ $i ]['url'] ); ?>">
									<span itemprop="name"><?php echo esc_html( $items[ $i ]['name'] ); ?></span>
								</a>
								<span itemprop="position" content="<?php echo esc_html( $i + 1 ); ?>"></span>
							</span>
						<?php else : ?>
							<span class="<?php echo esc_attr( $i - 1 ); ?>-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
								<span itemprop="name"><?php echo esc_attr( $items[ $i ]['name'] ); ?></span>
								<span itemprop="position" content="<?php echo esc_html( $i + 1 ); ?>"></span>
							</span>
						<?php endif; ?>
					<?php endif; ?>
				<?php endfor; ?>
			</div>
			<?php
		} elseif ( ! is_front_page() && ! is_home() && function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb( '<div class="breadcrumbs">', '</div>' );
		} elseif ( ! is_front_page() && ! is_home() && function_exists( 'rank_math_the_breadcrumbs' ) ) {
			echo '<div class="breadcrumbs">';
				rank_math_the_breadcrumbs();
			echo '</div>';
		} elseif ( ! is_front_page() && ! is_home() && function_exists( 'bcn_display' ) ) {
			?>
			<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
				<?php
					/**
					 * Add breadcrumbs Via plugin navxt
					 *
					 * @link https://mtekk.us/code/breadcrumb-navxt/#basic
					 * @plugin https://wordpress.org/plugins/breadcrumb-navxt
					 */
					bcn_display();
				?>

			</div>
			<?php
		}
	}
endif;
add_action( 'newkarma_core_view_breadcrumbs', 'newkarma_core_view_breadcrumbs', 10, 1 );
