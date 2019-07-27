<?php get_header(); ?>
<div id="home-page-content" class="page-content">
	<div id="front-page-table">
      <table>
         <tr>
            <td>
               <a href="/about/vipassana/"><img alt="A Bell to Signal Group Sittings and Meals." src="/wp-content/uploads/home2-768x511.jpg" /></a>
               <h2><a href="/about/vipassana/">Introduction to Vipassana</a></h2>
               <p>Vipassana is one of India's oldest techniques of meditation, first taught 2,500 years ago. It is a practical method of self-awareness that allows one to face the tensions and problems of daily life in a calm and balanced way.</p>
            </td>
            <td>
               <a href="/courses/what-to-expect/"><img alt="The Meditation Hall" src="/wp-content/uploads/home3-768x511.jpg"/></a>
               <h2><a href="/courses/what-to-expect/">What to Expect on a Course</a></h2>
               <p>To learn Vipassana Meditation one needs to develop one's own experience during a residential ten day course. Courses are held throughout the year at the Center and are conducted in English, with accommodations for non-english speaking students available on most courses.</p>
            </td>
            <td>
               <a href="/courses/how-to-apply/"><img alt="Zedi Bells above the Meditation Pagoda" src="/wp-content/uploads/home5-768x511.jpg" /></a>
               <h2><a href="/courses/how-to-apply/">How to Apply for a Course</a></h2>
               <p>Find out about the prerequisites and how to apply for a Vipassana course in Massachusetts, USA.</p>
            </td>
         </tr>
      </table>
   </div>
   <div id="home-page-news-feed">
		<?php
			$recent_posts = wp_get_recent_posts ( array ( 'category' => 50, 'post_status' => 'publish' ) );
            echo "<h2>Announcements</h2>";
			echo '<ul id="home-page-news-items">';
			if ( !empty ( $recent_posts ) ) {
				foreach ( $recent_posts as $recent ) {
					echo '<li class="home-page-news-item">';
					echo '<a href="' . get_permalink($recent["ID"]) . '">' . $recent["post_title"].'</a>';
               echo '</li>';
				}
			} else {
               $view_previous_prefix = "The are no current announcements. ";
            }
            echo '<li>';
            echo '<a href="/category/front-page/old-announcements/">' . $view_previous_prefix . 'View previous announcements ...' . '</a>';
            echo '</li>';
            echo '</ul>';
            wp_reset_query();
		?>
   </div>
</div>
<?php get_footer(); ?>
