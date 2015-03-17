<?php

/**
 * HTML5 Schema Markup initialization.
 *
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 */
class Schema_Markup {
	// Setup schema metadata.
	public static function schema_metadata( $args ) {
		if ( ! empty( $args ) ) {
			$args = array_merge(
				array(
					'post_type' => '',
					'context'   => '',
					'echo'      => true,
				),
				$args
			);
		}

		$args = apply_filters( 'schema_metadata_args', $args );

		if ( empty( $args['context'] ) ) {
			return;
		}

		// Markup string - stores markup output
		$markup     = ' ';
		$attributes = array();

		// Try to fetch the right markup
		switch ( $args['context'] ) {
			case 'body':
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/WebPage';
			break;

			case 'header':
				$attributes['role']      = 'banner';
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/WPHeader';
			break;

			case 'contact':
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/LocalBusiness';
			break;

			case 'breadcrumb':
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/breadcrumb';
			break;

			case 'nav':
				$attributes['role']      = 'navigation';
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/SiteNavigationElement';
			break;

			case 'content':
				$attributes['role']     = 'main';
				$attributes['itemprop'] = 'mainContentOfPage';

				// Frontpage, Blog, Archive & Single Post
				if ( is_singular( 'post' ) || is_archive() || is_home() ) {
					$attributes['itemscope'] = 'itemscope';
					$attributes['itemtype']  = 'http://schema.org/WebPageElement';
				}

				// Search Results Pages
				if ( is_search() ) {
					$attributes['itemscope'] = 'itemscope';
					$attributes['itemtype']  = 'http://schema.org/SearchResultsPage';
				}
			break;

			case 'entry':
				global $post;

				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/CreativeWork';

				// Blog posts microdata
				if ( 'post' === $post->post_type ) {
					$attributes['itemtype'] = 'http://schema.org/BlogPosting';

					// If main query,
					if ( is_main_query() )
						$attributes['itemprop'] = 'blogPost';
				}
			break;

			case 'image':
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/ImageObject';
			break;

			case 'image_url':
				$attributes['itemprop'] = 'contentURL';
			break;

			case 'name':
				$attributes['itemprop'] = 'name';
			break;

			case 'email':
				$attributes['itemprop'] = 'email';
			break;

			case 'url':
				$attributes['itemprop'] = 'url';
			break;

			case 'telephone':
				$attributes['itemprop'] = 'telephone';
			break;

			case 'author':
				$attributes['itemprop']  = 'author';
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/Person';
			break;

			case 'author_link':
				$attributes['itemprop'] = 'url';
			break;

			case 'author_name':
				$attributes['itemprop'] = 'name';
			break;

			case 'author_description':
				$attributes['itemprop'] = 'description';
			break;

			case 'entry_time':
				$attributes['itemprop'] = 'datePublished';
				$attributes['datetime'] = get_the_time( 'c' );
			break;

			case 'entry_title':
				$attributes['itemprop'] = 'headline';
			break;

			case 'entry_content':
				$attributes['itemprop'] = 'text';
			break;

			case 'comment':
				$attributes['itemprop']  = 'comment';
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/UserComments';
			break;

			case 'comment_author':
				$attributes['itemprop']  = 'creator';
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/Person';
			break;

			case 'comment_author_link':
				$attributes['itemprop']  = 'creator';
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/Person';
				$attributes['rel']       = 'external nofollow';
			break;

			case 'comment_time':
				$attributes['itemprop']  = 'commentTime';
				$attributes['itemscope'] = 'itemscope';
				$attributes['datetime']  = get_the_time( 'c' );
			break;

			case 'comment_text':
				$attributes['itemprop'] = 'commentText';
			break;

			case 'sidebar':
				$attributes['role']      = 'complementary';
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/WPSideBar';
			break;

			case 'footer':
				$attributes['role']      = 'contentinfo';
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/WPFooter';
			break;
		}

		$attributes = apply_filters( 'schema_metadata_attributes', $attributes, $args );

		// If failed to fetch the attributes - let's stop
		if ( empty( $attributes ) ) {
			return;
		}

		// Cycle through attributes, build tag attribute string
		foreach ( $attributes as $key => $value ) {
			$markup .= $key . '="' . $value . '" ';
		}

		$markup = apply_filters( 'schema_metadata_output', $markup, $args );

		if ( $args['echo'] ) {
			echo '' . $markup;
		} else {
			return $markup;
		}
	}
}
