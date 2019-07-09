<?php /*I'm not quite sure why this is here, but wordpress told me to include it and trust them*/
	global $query_string;

	$query_args = explode("&", $query_string);
	$search_query = array();

	foreach($query_args as $key => $string) {
		$query_split = explode("=", $string);
		$search_query[$query_split[0]] = urldecode($query_split[1]);
	} // foreach

	$search = new WP_Query($search_query);
?>

<?php get_header(); ?>
<div id="search-results-content" class="page-content news-item">
   <!--Begin Content-->
   <h1>Search Results</h1>
   
   <?php show_search_pagination($wp_query); ?>
   <?php if (have_posts()):?>
      <h2><?php printf( __( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>'); ?></h2>
      <?php 
         $start = ($posts_per_page * (get_query_var('paged') - 1)  + 1);
         if( $start < 1 ) $start = 1;				
      ?>
      
      <ol id="search-results" start="<?php echo $start; ?>">
      <?php while (have_posts()): ?>
         <?php the_post(); ?>
         <a class="search-results" href="<?php echo get_page_link();?>">
            <li class="search-results">
               <h3 class="search-results"><?php echo get_the_title(); ?></h3>
               <p><?php echo get_the_excerpt(); ?></p>
            </li>
         </a>
      <?php endwhile;  ?>
      </ol>
      
      <?php show_search_pagination($wp_query); ?>
      <h2>Didn't find what you were looking for?  You could:</h2>
      
   <?php else: ?>
      <h2><?php printf( __( 'No Results found for: %s' ), '<span>' . get_search_query() . '</span>'); ?></h2>

   <?php endif; ?>
   
   <ul id="search-page-alternate-options">
      <li>Refine your search:<br/><span style="display: inline-block; white-space: nowrap; width: 300px"><?php get_search_form(); ?></span></li>
      <li>Visit the <a href="/">Home Page</a>.</li>
      <li>View the <a href="/sitemap">Sitemap</a>.</li>
      <li>Contact the <a target="_blank" href="mailto:webmaster@dhara.dhamma.org">webmaster</a> for help.</li>
   </ul>
   <!--End Content-->	
   
</div>
<?php get_footer(); ?>


<?php function show_search_pagination($wp_query) {?>
	<?php if ( $wp_query->max_num_pages >= 2 ): ?>
	<section class="pagination-links search">
		<hr />
			<nav class="pagination search">
				
					<?php 
						$big = 999999999;
						echo paginate_links(array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => '?paged=%#%',
							'show_all' => false,
							'end_size' => "16",
							'mid_size' => "8",
							'current' => max( 1, get_query_var('paged') ),
							'total' => $wp_query->max_num_pages
						) );
					?> 
				
			</nav>
		<hr />
	</section>
	<?php endif; ?>
<?php } ?>

