window.fbAsyncInit = function() {
  FB.init({
    appId      : '419331041567720',
    status		: true,
    cookie		: true,
    xfbml      : true,
    oauth		: true,
    version    : 'v2.2'
  });
};

(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/fr_FR/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));

jQuery(function($){
	
	$('.facebookConnect').click(function() {
		
		var url = $(this).attr('href');
		FB.login(function(response) {
			
			if(response.authResponse){
				window.location = url;
			}
		}, {scope : 'email'});
		return false;
	});
	
});