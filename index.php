<!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#" <?php body_class( 'layout-default' ); ?>>

<head>
	<?php
	// This is required by WordPress
	wp_head();
	?>
</head>

<body>
	<?php
	// This is required by WordPress
	wp_body_open();
	?>

	<?php use_component( 'header' ); ?>

	<main class="template-fallback page">
		<?php
		if ( have_posts() ) {

			// Load posts loop.
			while ( have_posts() ) {
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1><?php the_title(); ?></h1>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</article>
				<?php
			}
		}
		?>
	</main>

	<?php use_component( 'footer' ); ?>

	<?php
	// This is required by WordPress
	wp_footer();
	?>
</body>

</html>
