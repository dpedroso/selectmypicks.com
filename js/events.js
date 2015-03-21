$(document).ready(function(){

	// Click events
	$("[id*='-button']").click(function(){
	
	
		// Remove active class from all elements
		$( ".active" ).toggleClass( 'active', false );
		
		// Set the element that was clicked to active
		$( '#' + this.id ).toggleClass( 'active', true );
		
		// Hide content from main content div
		$(".content").hide();
		
		// Remove -button from id to get corresponding content to display
		$('.content').load("content_"+this.id.replace('-button','')+".php");
		//console.log('loading page');
		
		// Display  new content in div
		$(".content").fadeIn(500);
		
	});
	
	// Page events
	$(".content").hide();
	$('.content').load("content_home.php");
	$(".content").fadeIn(500);
	
	// Set the refresh rate
	setInterval(updateScores, 5000);
	function updateScores(){
		if($('#results-button').attr('class')=="active")
			$('.content').load('content_results.php').fadeIn("slow");
	}
});


