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
      document.getElementById("audio-one").style.display = "none";
      document.getElementById("audio-two").style.display = "none";
      document.getElementById("audio-three").style.display = "none";
      document.getElementById("audio-four").style.display = "none";
      document.getElementById("audio-five").style.display = "none";
      document.getElementById("audio-six").style.display = "none";
      document.getElementById("audio-seven").style.display = "none";
      document.getElementById("audio-eight").style.display = "none";
      document.getElementById("audio-nine").style.display = "none";
      document.getElementById("audio-one").pause();
      document.getElementById("audio-two").pause();
      document.getElementById("audio-three").pause();
      document.getElementById("audio-four").pause();
      document.getElementById("audio-five").pause();
      document.getElementById("audio-six").pause();
      document.getElementById("audio-seven").pause();
      document.getElementById("audio-eight").pause();
      document.getElementById("audio-nine").pause();

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
         case 5:
            document.getElementById( "audio-six").style.display = "block";
            break;
         case 6:
            document.getElementById( "audio-seven").style.display = "block";
            break;
         case 7:
            document.getElementById( "audio-eight").style.display = "block";
            break;
         case 8:
            document.getElementById( "audio-nine").style.display = "block";
            break;
      }
   }

   function changeBackgroundTo(backgroundIndex) {
      imageFileName = "1.png";
      switch (backgroundIndex) {
         case 0:
            imageFileName = "1.png";
            break;
         case 1:
            imageFileName = "2.jpg";
            break;
         case 2:
            imageFileName = "3.jpg";
            break;
         case 3:
            imageFileName = "4.jpg";
            break;
         case 4:
            imageFileName = "5.jpg";
            break;
         case 5:
            imageFileName = "6.jpg";
            break;
         case 6:
            imageFileName = "7.jpg";
            break;
         case 7:
            imageFileName = "8.jpg";
            break;
      }
      document.getElementById( "vgs-body").style.backgroundImage = "url('/filebase/virtual-group-sittings/backgrounds/" + imageFileName + "')";
   }

   window.onload = function() {
      document.getElementById("session-chooser").onchange = function() {
         changeAudioPlayerTo( this.selectedIndex );
      }
      document.getElementById("background-chooser").onchange = function() {
         changeBackgroundTo( this.selectedIndex );
      }
   }
</script>
<?php wp_head(); ?>
</head>
<body id="vgs-body">
<div id="intro-text">
   <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php the_content(__('(more...)')); ?>
   <?php endwhile; endif; ?>
</div>
<div id="audio-controls">
   <div id="audio-sliders">
      <audio controls id="audio-one" class="audio">
         <source src="/filebase/virtual-group-sittings/khetta-short.mp3" type="audio/mpeg">
      </audio>
      <audio controls id="audio-two" class="audio">
         <source src="/filebase/virtual-group-sittings/sikhara-short.mp3" type="audio/mpeg">
      </audio>
      <audio controls id="audio-three" class="audio">
         <source src="/filebase/virtual-group-sittings/setu-long.mp3" type="audio/mpeg">
      </audio>
      <audio controls id="audio-four" class="audio">
         <source src="/filebase/virtual-group-sittings/dubai-long.mp3" type="audio/mpeg">
      </audio>
      <audio controls id="audio-five" class="audio">
         <source src="/filebase/virtual-group-sittings/juhu-mumbai-short.mp3" type="audio/mpeg">
      </audio>
      <audio controls id="audio-six" class="audio">
         <source src="/filebase/virtual-group-sittings/salila-long.mp3" type="audio/mpeg">
      </audio>
      <audio controls id="audio-seven" class="audio">
         <source src="/filebase/virtual-group-sittings/salila-short.mp3" type="audio/mpeg">
      </audio>
      <audio controls id="audio-eight" class="audio">
         <source src="/filebase/virtual-group-sittings/day-ten-short.mp3" type="audio/mpeg">
      </audio>
      <audio controls id="audio-nine" class="audio">
         <source src="/filebase/virtual-group-sittings/giri-long.mp3" type="audio/mpeg">
      </audio>
   </div>
   <div id="control-choosers">
      <label for="session-chooser">Audio Session:</label>
      <select id="session-chooser">
         <option>1 - Khetta Short Instructions</option>
         <option>2 - Sikhara Short Instructions</option>
         <option>3 - Setu Long Instructions</option>
         <option>4 - Dubai Long Instructions</option>
         <option>5 - Juhu Mumbai Short Instructions</option>
         <option>6 - Salila Long Instructions</option>
         <option>7 - Salila Short Instructions</option>
         <option>8 - Day Ten Short Instructions</option>
         <option>9 - Giri Long Instructions</option>
      </select>
      <label for="background-chooser">Background:</label>
      <select id="background-chooser">
         <option>1 - Dharā Arial</option>
         <option>2 - Dharā Tree</option>
         <option>3 - Dharā Gong</option>
         <option>4 - Patapa Lotus</option>
         <option>5 - Patapa Sign</option>
         <option>6 - Patapa Dhamma Hall</option>
         <option>7 - Pubannanda Day</option>
         <option>8 - Pubannanda Night</option>
      </select>
      <button id="toggle-text-button" type="button" onclick="toggleTextHide()">Hide Text</button> 
   </div>
</div>
</body>
</html>
