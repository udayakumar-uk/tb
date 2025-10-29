
$(document).on('ready', function() {
		
	// Screen Reader Text-To-Speach
	
    let screenReaderEnabled = false;

    // ✅ Speak function
    function speak(text) {
      if (!text || text.trim().length === 0) return;

      if (!('speechSynthesis' in window)) {
        alert('Sorry, your browser does not support text-to-speech.');
        return;
      }

      window.speechSynthesis.cancel(); // stop ongoing speech

      const utter = new SpeechSynthesisUtterance(text.trim());
      utter.lang = 'en-US';
      utter.rate = 1;
      utter.volume = 1;
      utter.pitch = 1;

      window.speechSynthesis.speak(utter);
    }

    // ✅ Toggle button
    const toggleBtn = document.getElementById('screenReader');

    toggleBtn.addEventListener('click', () => {

		screenReaderEnabled = !screenReaderEnabled;

		if (screenReaderEnabled) {
			toggleBtn.textContent = '🔇 Disable Screen Reader';
		} else {
			toggleBtn.textContent = '🔈 Enable Screen Reader';
			window.speechSynthesis.cancel();
		}
    });

    // ✅ Hover event for individual elements
    document.body.addEventListener('mouseover', (event) => {
		if (!screenReaderEnabled) return;

		const target = event.target;
		// Ignore large containers like <body>, <html>, or empty elements
		if (["input", "img", "svg", "path", "span.notranslate"].includes(target.tagName)) {return};

		if ($(event.target).closest(".notranslate").length) {
			return; // stop reading for .notranslate elements
		}
		

		const text = target.innerText?.trim() ?? target.getAttribute('aria-label') ?? '';

		// Speak if the element contains text
		if (text.length > 0) {
		speak(text);
		}
	
    });

    document.body.addEventListener('mouseout', () => {
		if (screenReaderEnabled && window.speechSynthesis.speaking) {
			window.speechSynthesis.cancel();
		}
    });





	// Increase and Decrease the fontsize

	resetFont();
	
	$('#incFont').on('click', function(){
		const fontSize = getFontSizeFromLocationStrage();
		if(+fontSize > 15){
			return false;
		}
		const incFont = +fontSize + 1;
		$('body, html').css({'fontSize': incFont+'px'});
		setFontSizeToLocationStrage(incFont);
	})

	$('#decFont').on('click', function(){
		const fontSize = getFontSizeFromLocationStrage();
		if(+fontSize < 13){
			return false;
		}
		const decFont = +fontSize - 1;
		$('body, html').css({'fontSize': decFont+'px'});
		setFontSizeToLocationStrage(decFont);
	})

	$('#resetFont').on('click', function(){
		resetFont(14);
	});

	function resetFont(size){
		const fontSize = size ? size : getFontSizeFromLocationStrage();

		$('body, html').css({'fontSize': `${fontSize ? fontSize : '14'}px`});
		setFontSizeToLocationStrage(fontSize);

	}

	const getThemeMode = localStorage.getItem('theme');
	localStorage.setItem('theme', (getThemeMode ?? 'light'));
	$('html').attr('data-bs-theme', (getThemeMode ?? 'light'));

	$('#theme').on('change', function() {
		const isDark = $(this).is(':checked');
		$('html').attr('data-bs-theme', isDark ? 'dark' : 'light');
		localStorage.setItem('theme', (isDark ? 'dark' : 'light'));
	});
		

});



// Stop video playback when modal is closed
$(document).on('hidden.bs.modal', '#videoPopup', function () {
  var $video = $('#CVC-PIDPI-VAW-2023-comp');
  if ($video.length) {
      $video[0].pause();
      $video[0].currentTime = 0;
  }
});




// Enable submenus

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll('.dropdown-submenu .dropdown-toggle').forEach(function (el) {
    el.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();

      let submenu = this.nextElementSibling;
      if (submenu) {
        submenu.classList.toggle('show');
        this.classList.toggle('show');
      }
    });
  });

  // Close all submenus when parent closes
  document.querySelectorAll('.dropdown').forEach(function (dd) {
    dd.addEventListener('hidden.bs.dropdown', function () {
      this.querySelectorAll('.dropdown-menu.show').forEach(function (submenu) {
        submenu.classList.remove('show');
      });
      this.querySelectorAll('.dropdown-toggle.show').forEach(function (submenu) {
        submenu.classList.remove('show');
      });
    });
  });


});



function setFontSizeToLocationStrage(size){
	localStorage.setItem('fontSize', size);
}

function getFontSizeFromLocationStrage(){
	return localStorage.getItem('fontSize');
}


function show_pop(dname,id){
	if(dname!="" && dname!='#'){
		window.open(dname,"DisplayWindow","resizable=no,titlebar=no,toolbar=no,scrollbars=yes,directories=no,menubar=no,width=600,height=900,left=300,top=25");
	}
}