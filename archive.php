<?php get_header(); ?>
<div class="page-content archive">
   <h1> <?php wp_title(""); ?> </h1>
   <?php show_archive_pagination($wp_query); ?>
   <?php if (have_posts()):?>
      <?php 
         $start = ($posts_per_page * (get_query_var('paged') - 1)  + 1);
         if( $start < 1 ) $start = 1;				
      ?>
      
      <?php while (have_posts()): ?>
         <?php the_post(); ?>
         <article class="archive">
            <header class="archive">
               <h2 class="archive">
                  <a href="<?php echo get_page_link();?>"><?php echo get_the_title(); ?></a>
               </h2>
               <strong><?php the_time( get_option( 'date_format' ) ); ?></strong>
            </header>
            <p class="archive">
               <?php echo get_the_excerpt(); ?>
            </p>
            <footer class="archive">
               <img class="post-metadata-icon" width="14" height="14" 
               alt="" src="<?php bloginfo('template_directory');?>/images/postcategoryicon.png" /> Posted in <?php the_category(', ') ?>
            </footer>
         </article>
      <?php endwhile;  ?>
      
      <?php show_archive_pagination($wp_query); ?>
      
   <?php else: ?>
      <h3>Sorry, no matching pages found.</h3>
   <?php endif; ?>
</div>

<?php get_footer(); ?>

<?php function show_archive_pagination($wp_query) {?>
	<?php if ( $wp_query->max_num_pages >= 2 ): ?>
	<section class="pagination-links archive">
		<hr />
			<nav class="pagination archive">
				
					<?php 
						$big = 999999999;
						echo paginate_links(array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => '?paged=%#%',
							'show_all' => false,
							'end_size' => "16",
							'mid_size' => "8",
							'prev_text' => "« Newer",
							'next_text' => "Older »",
							'current' => max( 1, get_query_var('paged') ),
							'total' => $wp_query->max_num_pages
						) );
					?> 
			</nav>
		<hr />
	</section>
	<?php endif; ?>
<?php } ?>



