
$(document).on('ready', function() {
		
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