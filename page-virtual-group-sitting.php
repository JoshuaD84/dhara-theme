<html <?php language_attributes(); ?>>
<head>
<title>Virtual Group Sitting - Dhara Dhamma</title>
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/style-virtual-group-sitting.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/JavaScript">
   function toggleTextHide() {
      if(document.getElementById("intro-text").style.display == "none") {
        document.getElementById("intro-text").style.display = "block";
        document.getElementById("toggle-text-button").innerHTML = "hide text";
        document.getElementById("audio-controls").style.opacity = "1";
      } else {
        document.getElementById("intro-text").style.display = "none";
        document.getElementById("toggle-text-button").innerHTML = "show text";
        document.getElementById("audio-controls").style.opacity = ".5";
      }
   }

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
<div id="intro-text">
<a href="http://dhara.dhamma.org/os/">&lsaquo;- return to dhara.dhamma.org</a>
   <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php the_content(__('(more...)')); ?>
   <?php endwhile; endif; ?>
</div>
<div id="audio-controls">
<audio controls id="audio-one" class="audio">
   <source src="/filebase/virtual-group-sittings/audio-1.mp3" type="audio/mpeg">
</audio>
<audio controls id="audio-two" class="audio">
   <source src="/filebase/virtual-group-sittings/audio-2.mp3" type="audio/mpeg">
</audio>
<audio controls id="audio-three" class="audio">
   <source src="/filebase/virtual-group-sittings/audio-3.mp3" type="audio/mpeg">
</audio>
<audio controls id="audio-four" class="audio">
   <source src="/filebase/virtual-group-sittings/audio-4.mp3" type="audio/mpeg">
</audio>
<audio controls id="audio-five" class="audio">
   <source src="/filebase/virtual-group-sittings/audio-5.mp3" type="audio/mpeg">
</audio>
<div id="chooser">
   <label for="session-chooser">Change Audio Session:</label>
   <select id="session-chooser">
      <option>1 - Dhamma Khetta Short</option>
      <option>2 - Dhamma Giri Minimal Instructions</option>
      <option>3 - Dhamma Salila Long Instructions</option>
      <option>4 - Dhamma Salila Short Instructions</option>
      <option>5 - Dhamma Setu Long Instructions</option>
   </select>
   <button id="toggle-text-button" type="button" onclick="toggleTextHide()">Hide Text</button> 
</div>
</div>
</body>
</html>
