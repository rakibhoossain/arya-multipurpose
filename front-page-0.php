    
<?php
/**
 * The front page template
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package molakat
 */
get_header();
?>
	<div id="fm-area">
  	<div class="container" id="logo_big">
  		<div class="row justify-content-center align-items-center">
  			<div class="text-logo" id="branding">
  				<img class="colours img-responsive" src="<?php echo esc_url(arya_multipurpose_get_option( 'arya_multipurpose_fm_text' ));?>" alt="<?php bloginfo( 'name' ); ?>" />
  			</div>
  		</div>
  	</div>

  	<div class="container" id="logo_slogan">
  		<div id="shout_and_player">
  			<div class="radio-player">
  				<div id="jquery_jplayer_1" class="jp-jplayer"></div>
  				<div id="jp_container_1" class="jp-audio-stream" role="application" aria-label="media player">
  					<div class="jp-type-single">
  						<div class="jp-gui jp-interface">
  							<div class="jp-controls">
  								<div class="player-bg" id="play"><i class="fa fa-play"></i></div>
  							</div>
  							<div class="jp-volume-controls text-center" id="volume-controls">
                  <i class="fa fa-volume-up"></i>
  							</div>
  						</div>
  					</div>
  				</div>		
  			</div>
  		</div>
  	</div>

  	<div class="container-fluid" id="player_big" style="background-image:url(<?php echo esc_url(arya_multipurpose_get_option( 'arya_multipurpose_fm_lg_logo' ));?>)">
  		<div id="butterfly-left"></div>
  		<div id="butterfly-right"></div>  
  	</div>
  </div>

  <!-- <canvas id="oscilloscope"></canvas> -->
  <style type="text/css">
    #oscilloscope {
    width: 100%;
    height:13vh;
  }


/*copy*/
.player-bg.player-animate::before,
.player-bg.player-animate::after {
  -webkit-border-radius: 1000px;
  -moz-border-radius: 1000px;
  border-radius: 1000px;
  content: "";
  display: block;
  position: absolute;
  height: 65px;
  right: 0;
  top: 0;
  width: 65px;
  z-index: -9;
  box-shadow: 0 0 0 rgba(255, 255, 255, 0);
  -webkit-transition: all 0.25s linear;
  transition: all 0.25s linear;
}

.player-bg.player-animate::before {
  -moz-animation: audio1 1.5s infinite ease-in-out;
  -o-animation: audio1 1.5s infinite ease-in-out;
  -webkit-animation: audio1 1.5s infinite ease-in-out;
  animation: audio1 1.5s infinite ease-in-out;
}
.player-bg.player-animate::after {
  -moz-animation: audio2 2.2s infinite ease-in-out;
  -o-animation: audio2 2.2s infinite ease-in-out;
  -webkit-animation: audio2 2.2s infinite ease-in-out;
  animation: audio2 2.2s infinite ease-in-out;
}

.jp-play{
  -webkit-transition: transform 0.25s ease-in-out;
    transition: transform 0.25s ease-in-out;
}

.player-bg:hover .jp-play{
  transform: scale(1.1);
}
.player-bg:hover {
  box-shadow: 0 0 12px rgba(255, 238, 125, 0.8);
}

@keyframes audio1 {
  0%,
  100% {
    box-shadow: 0 0 0 0.4em rgba(255, 255, 255, 0.4);
  }
  25% {
    box-shadow: 0 0 0 0.15em rgba(255, 255, 255, 0.15);
  }
  50% {
    box-shadow: 0 0 0 0.55em rgba(255, 255, 255, 0.55);
  }
  75% {
    box-shadow: 0 0 0 0.25em rgba(255, 255, 255, 0.25);
  }
}

@keyframes audio2 {
  0%,
  100% {
    box-shadow: 0 0 0 0.25em rgba(255, 255, 255, 0.15);
  }
  25% {
    box-shadow: 0 0 0 0.4em rgba(255, 255, 255, 0.3);
  }
  50% {
    box-shadow: 0 0 0 0.15em rgba(255, 255, 255, 0.05);
  }
  75% {
    box-shadow: 0 0 0 0.55em rgba(255, 255, 255, 0.45);
  }
}


.bg__logo {
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: absolute;
    width: 100px;
    height: 100px;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
}






  </style>

	<script type="text/javascript">
  // <![CDATA[
  // @ref
  // https://www.w3.org/TR/webaudio
  // https://developer.mozilla.org/en-US/docs/Web/API/HTMLAudioElement
  // https://noisehack.com/build-music-visualizer-web-audio-api

  // ========================================================
  // Global Config
  // ========================================================

  let start_button = document.getElementById('play'),
  volume = document.getElementById('volume-controls'),
  radio_box = document.getElementById('player_big');
  // ========================================================
  // Audio Setup
  // ========================================================

  function audioSetup() {
    let source = "<?php echo esc_url(arya_multipurpose_get_option( 'arya_multipurpose_fm_link' )); ?>";


  // Audio source
  let song = new Audio(source),
  mute = false;

    song.crossOrigin = 'anonymous';

    start_button.addEventListener('click', function () {
      if (!song.paused) {
        song.pause();
        start_button.classList.remove('player-animate');
        radio_box.classList.remove('radio');
        start_button.innerHTML = '<i class="fa fa-play"></i>';
      } else {
        song.play();
        start_button.classList.add('player-animate');
        radio_box.classList.add('radio');
        start_button.innerHTML = '<i class="fa fa-pause"></i>';
      }

    });


    volume.addEventListener('click', function () {
      if (mute) {
        volume.innerHTML = '<i class="fa fa-volume-up"></i>';
      } else {
        volume.innerHTML = '<i class="fa fa-volume-off"></i>'; 
      }
      song.muted = !mute;
      mute = !mute;
      
    });

    song.addEventListener('ended', function () {
      song.currentTime = 0;

      start_button.classList.remove('player-animate');
      radio_box.classList.remove('radio');
      start_button.innerHTML = '<i class="fa fa-play"></i>';
    });


  }

  audioSetup();

  // ]]>
	</script>	


<?php
get_footer();