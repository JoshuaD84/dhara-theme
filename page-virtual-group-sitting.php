<html <?php language_attributes(); ?>>
<head>
<title>Virtual Group Sitting - Dhara Dhamma</title>
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/style-virtual-group-sitting.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/JavaScript">
   function changeAudioPlayerTo(playerIndex) {
      document.getElementById( "audio-one").style.display = "none";
      document.getElementById( "audio-two").style.display = "none";
      document.getElementById( "audio-three").style.display = "none";
      document.getElementById( "audio-four").style.display = "none";
      document.getElementById( "audio-five").style.display = "none";
      document.getElementById( "audio-one").pause();
      document.getElementById( "audio-two").pause();
      document.getElementById( "audio-three").pause();
      document.getElementById( "audio-four").pause();
      document.getElementById( "audio-five").pause();

      switch (playerIndex) {
         case 0:
            document.getElementById( "audio-one").style.display = "block";
            break;
         case 1:
            document.getElementById( "audio-two").style.display = "block";
            break;
         case 2:
            document.getElementById( "audio-three").style.display = "block";
            break;
         case 3:
            document.getElementById( "audio-four").style.display = "block";
            break;
         case 4:
            document.getElementById( "audio-five").style.display = "block";
            break;
      }
   }
   window.onload = function() {
      document.getElementById("session-chooser").onchange = function() {
         changeAudioPlayerTo( this.selectedIndex );
      }
   }
</script>
<?php wp_head(); ?>
</head>
<body>
<a href="http://dhara.dhamma.org/os/">&lsaquo; Return to dhara.dhamma.org</a>
<div id="intro-text">
   <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php the_content(__('(more...)')); ?>
   <?php endwhile; endif; ?>
</div>
<div id="audio-controls">
<audio controls id="audio-one" class="audio">
   <source src="audio/virtual-group-sitting-audio-1.mp3" type="audio/mpeg">
</audio>
<audio controls id="audio-two" class="audio">
   <source src="audio/virtual-group-sitting-audio-2.mp3" type="audio/mpeg">
</audio>
<audio controls id="audio-three" class="audio">
   <source src="audio/virtual-group-sitting-audio-3.mp3" type="audio/mpeg">
</audio>
<audio controls id="audio-four" class="audio">
   <source src="audio/virtual-group-sitting-audio-4.mp3" type="audio/mpeg">
</audio>
<audio controls id="audio-five" class="audio">
   <source src="audio/virtual-group-sitting-audio-5.mp3" type="audio/mpeg">
</audio>
<div id="chooser">
   <label for="session-chooser">Change Audio Session:</label>
   <select id="session-chooser">
      <option value="one">One</option>
      <option value="two">Two</option>
      <option value="three">Three</option>
      <option value="four">Four</option>
      <option value="five">Five</option>
   </select>
</div>
</div>
</body>
</html>