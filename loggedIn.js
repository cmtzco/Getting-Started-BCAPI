		//this will allow you to mention the cookie by index
		function getCookie(name) {
		  var value = "; " + document.cookie;
		  var parts = value.split("; " + name + "=");
		  if (parts.length == 2) return parts.pop().split(";").shift();
		}
        //set variable that will check if login email exists
		var loggedIn = getCookie('LoginEmail');
		
		//logic that will output different content based on the loggedIn Status
		if(typeof loggedIn === 'undefined'){
			console.log("They are not logged in!");
			var notLoggedIn = '<ul><li><a href="/membership/">Become a Member</a></li></ul><p>Already a member? <a href="/login.php">Sign In >></a></p>';
			$(notLoggedIn).appendTo(".LandingInnerContent");
		}
		else{
			console.log("They are logged in! ");
			var isLoggedIn = '<ul><li><a href="/membership/">Shop Now</a></li></ul><p>Access <a href="/account.php">Account Page >></a></p>';
			$(isLoggedIn).appendTo(".LandingInnerContent");
		}