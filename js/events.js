$(document).ready( function(){	// Click events	$("[id*='-button']").click(function(){				// Remove active class from all elements		$( ".active" ).toggleClass( 'active', false );				// Set the element that was clicked to active		$( '#' + this.id ).toggleClass( 'active', true );				window.location.hash=this.id.replace('-button','');			});		// Page events	$(".content").hide();	$('#pickem-button').click();		// Set the refresh rate	setInterval(updateScores, 5000);	function updateScores(){		if($('#results-button').attr('class')=="active")			$('.content').load('content_results.php').fadeIn("slow");	}		// Set the refresh rate	setInterval(refreshTime, 1000);	function refreshTime(){		if($('#pickem-button').attr('class')=="active"){		$.post( "process/cal_time.php" )			.done(function( data ) {				$('#time').html(data);			});		}	}	window.addEventListener('hashchange', function(event){		var hash = window.location.hash;		var page = hash.replace("#","");				// Hide content from main content div		$(".content").hide();				// Remove -button from id to get corresponding content to display		$('.content').load("content_"+page+".php");				// Display  new content in div		$(".content").fadeIn(500);			});});$('#pickem-button').click();