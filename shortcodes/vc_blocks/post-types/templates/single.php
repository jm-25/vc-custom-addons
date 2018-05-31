<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="charset="UTF-8"" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />		
		<?php wp_head(); ?>
	</head>
	<body>
		<div id="page-full-width" class="single-vc_block" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
		  <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
		      <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
		      <div class="entry-content">
		          <?php the_content(); ?>
		      </div>
		  </article>
		<?php endwhile;?>
		</div>
	<?php wp_footer(); ?>
</body>
</html>
