var camara = {
 
	initialize: function() {
	  this.bindEvents();
	},

	bindEvents: function() {
	  var takePhoto = document.getElementById('takePhoto');
	  takePhoto.addEventListener('click', camara.takePhoto, false);
	  var sendPhoto = document.getElementById('sendPhoto');
	  sendPhoto.addEventListener('click', camara.sendPhoto, false);
	},

	sendPhoto: function() {
	  alert('Imagen enviada al servidor');
	},

	takePhoto: function(){
	  navigator.camera.getPicture(camara.onPhotoDataSuccess, camara.onFail, { quality: 20, 
	      allowEdit: true, destinationType: navigator.camera.DestinationType.DATA_URL });
	},

	onPhotoDataSuccess: function(imageData) {

	var photo = document.getElementById('photo');

	photo.style.display = 'block';

	photo.src = "data:image/jpeg;base64," + imageData;

	var sendPhoto = document.getElementById('sendPhoto');
	sendPhoto.style.display = 'block';

	},

	onFail: function(message) {
	alert('Failed because: ' + message);
	}

};