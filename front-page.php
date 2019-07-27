    
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
	
	<div class="container" id="logo_big">
		<div class="row justify-content-center align-items-center">
			<div class="text-logo" id="branding">
				<img class="colours" src="<?php echo esc_url(arya_multipurpose_get_option( 'arya_multipurpose_fm_text' ));?>" alt="<?php bloginfo( 'name' ); ?>" />
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
	<div class="container-fluid" id="player_big">
		<div class="row justify-content-center align-items-center">
			<div class="radio-box" id="radio-box">
				<div id="butterfly-left"></div>
				<img src="<?php echo esc_url(arya_multipurpose_get_option( 'arya_multipurpose_fm_lg_logo' ));?>" class="img-responsive" alt="" />
				<div id="butterfly-right"></div>  
			</div>
		</div>
	</div>
  <canvas id="oscilloscope"></canvas>
  <style type="text/css">
    #oscilloscope {
    width: 100%;
    height:100px;
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
radio_box = document.getElementById('radio-box'),
audioContext,
masterGain;


// ========================================================
// Audio Setup
// ========================================================

function audioSetup() {
  let source = "<?php echo esc_url(arya_multipurpose_get_option( 'arya_multipurpose_fm_link' )); ?>";
  audioContext = new (window.AudioContext || window.webkitAudioContext)();
  masterGain = audioContext.createGain();

  masterGain.connect(audioContext.destination);


// Audio source
let song = new Audio(source),
songSource = audioContext.createMediaElementSource(song),
mute = false;

  song.crossOrigin = 'anonymous';
  songSource.connect(masterGain);

  start_button.addEventListener('click', function () {
    if (!song.paused) {
      song.pause();
      start_button.classList.remove('player-animate');
      radio_box.classList.remove('radio');
      start_button.innerHTML = '<i class="fa fa-play"></i>';
    } else {
      song.play();
      drawOscilloscope();
      updateWaveForm();
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


// ========================================================
// Create Wave Form
// ========================================================

const analyser = audioContext.createAnalyser();
masterGain.connect(analyser);

const waveform = new Float32Array(analyser.frequencyBinCount);
analyser.getFloatTimeDomainData(waveform);

function updateWaveForm() {
  requestAnimationFrame(updateWaveForm);
  analyser.getFloatTimeDomainData(waveform);
}


// ========================================================
// Draw Oscilloscope
// ========================================================

function drawOscilloscope() {
  requestAnimationFrame(drawOscilloscope);

  const scopeCanvas = document.getElementById('oscilloscope');
  const scopeContext = scopeCanvas.getContext('2d');

  scopeCanvas.width = waveform.length;
  scopeCanvas.height = 100;

  scopeContext.clearRect(0, 0, scopeCanvas.width, scopeCanvas.height);
  scopeContext.beginPath();

  for (let i = 0; i < waveform.length; i++) {
    const x = i;
    const y = (0.5 + waveform[i] / 2) * scopeCanvas.height;


    if (i == 0) {
      scopeContext.moveTo(x, y);
    } else {
      scopeContext.lineTo(x, y);
    }
  }

  scopeContext.strokeStyle = 'rgba(255, 255, 255, 0.14)';
  scopeContext.lineWidth = 2;
  scopeContext.stroke();
}

// ]]>
	</script>	


<?php
get_footer();