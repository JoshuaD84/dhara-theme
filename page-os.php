<?php get_header(); ?>
<div id="os-home-page-content" class="page-content">
	<div id="front-page-table">
		<table>
			<tr>
				<td>
					<img alt="The Meditation Hall" src="/wp-content/uploads/your-practice.jpg" />
					<h2>Your Practice</h2>
					<ul class="old-student-home-list">
						<li><a href="/os/regions/group-sittings/">Find Local Group Sittings</a></li>
						<li><a href="https://www.dhamma.org/en/os/10-day/dsum.htm">Read the Discourse Summaries</a></li>
						<li><a href="/os/home/guidelines-for-practicing/">Guidelines for Practicing</a></li>
						<li><a target="_blank" href="http://audio.server.dhamma.org/audio/gs/gs.htm">Download Group Sitting Recordings</a></li>
						<li><a href="/os/home/courses-types/">Read about Old Student Courses</a></li>
						<li><a href="/os/home/metta-sutta/">Read the Mettā Sutta</a></li>
						<li><a target="_blank" href="http://www.vridhamma.org/Question-and-Answers">More Answer by S.N. Goenka</a></li>
					</ul>
				</td>
				<td>
					<img alt="Dhamma Servers" src="/wp-content/uploads/dhamma-service.png" />
					<h2>Dhamma Service</h2>
					<ul class="old-student-home-list">
						<li><a href="/os/dhamma-service/overview/">Overview</a></li>
						<li><a href="/os/home/dana/">Donations (Dāna)</a></li>
						<li><a href="/os/dhamma-service/code-of-conduct/">Dhamma Service Code of Conduct</a></li>
						<li><a href="/os/dhamma-service/service-periods/">Service Periods</a></li>
						<li><a href="/os/dhamma-service/regular-tasks/">Sign up for Regular Tasks</a></li>
						<li><a href="/os/dhamma-service/long-term-service/">Long Term Service</a></li>
						<li><a href="/os/trust/schedule-and-minutes/">Attend a Trust Meeting</a></li>
					</ul>
				</td>
				<td>
                   <img alt="Zedi Bells above the Meditation Pagoda" src="/wp-content/uploads/news.png" />
                   <h2>Recent News</h2>
					<ul id="os-welcome-news-feed" class="old-student-home-list">
						<?php
							  $recent_posts = wp_get_recent_posts ( array ( 'numberposts' => '6', 'post_status' => 'publish' )  );
							  foreach ( $recent_posts as $recent ) {
								 echo '<li class="os-news-item"><a href="' . get_permalink($recent["ID"]) . '">' . $recent["post_title"].'</a> </li>';
							  }
							  echo '<li class="os-welcome-news-item"><a href="/category/all-news/">... more news</a></li>';
							  wp_reset_query();
						?> 
					</ul>
				</td>
			</tr>
		</table>
	</div>
</div>
<?php get_footer(); ?>
