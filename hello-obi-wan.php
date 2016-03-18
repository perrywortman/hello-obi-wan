<?php
/**
 * @package Hello_Obi-Wan
 * @version 0.2
 */
/*
Plugin Name: Hello Obi-Wan
Plugin URI: http://wordpress.org/extend/plugins/hello-obi-wan/
Description: I couldn't resist forking the Hello Darth plugin and paying tribute to Obi-Wan. When activated you will randomly see a quote from <a href="http://www.imdb.com/character/ch0000004/quotes">Obi Wan Kenobi's IMDB page</a> in the upper right of your admin screen on every page. HT to <a href="http://ma.tt">Matt Mullenberg</a> for the original code. <a href="https://wordpress.org/support/plugin/hello-obi-wan">Support and suggestions</a> are welcome. 
Author: W. Perry Wortman | @kloptikus
Version: 0.3
Author URI: http://perrywortman.com/
*/

function hello_obiwan_get_quote() {
	/** These are Obi-Wan Kenobi Quotes */
	$quotes = "
		You have made a commitment to the Jedi order, a commitment not easily broken.
		This little one's not worth the effort. Come, let me get you something. 
		I have something here for you. Your father wanted you to have this when you were old enough, but your uncle wouldn't allow it. He feared you might follow old Obi-Wan on some damn fool idealistic crusade like your father did. 
		This is the weapon of a Jedi Knight. Not as clumsy or random as a blaster; an elegant weapon for a more civilized age. For over a thousand generations, the Jedi Knights were the guardians of peace and justice in the Old Republic. Before the dark times... before the Empire. 
		There was nothing you could have done, Luke, had you been there. You'd have been killed too, and the droids would now be in the hands of the Empire. 
		Rest easy, son. You've had a busy day. You're fortunate to be all in one piece. 
		The Jundland Wastes are not to be traveled lightly. Tell me, young Luke, what brings you out this far? 
		Obi-Wan Kenobi. Obi-Wan... Now, that's a name I've not heard in a long time. A long time. 
		Oh, he's not dead. Not yet. 
		But of course I know him. He's me. 
		I haven't gone by the name of Obi-Wan since... oh, before you were born. 
		Only a master of evil, Darth. 
		That's no moon. It's a space station.
		You must learn the ways of the Force, if you're to come with me to Alderaan. 
		I need your help, Luke. She needs your help. I'm getting too old for this sort of thing. 
		That's your uncle talking. 
		The Force is what gives a Jedi his power. It's an energy field created by all living things. It surrounds us and penetrates us. It binds the galaxy together. 
		For over a thousand generations, the Jedi knights were the guardians of peace and justice in the old Republic... before the dark times... before the empire. 
		A young Jedi named Darth Vader, who was a pupil of mine until he turned to evil, helped the Empire hunt down and destroy the Jedi knights. He betrayed and murdered your father. Now the Jedi are all but extinct. Vader was seduced by the dark side of the Force. 
		Mos Eisley spaceport: You will never find a more wretched hive of scum and villainy. We must be cautious. 
		The Force can have a strong influence on the weak-minded.
		Only passengers. Myself, the boy, two droids... and no questions asked.
		Let's just say we'd like to avoid any Imperial entanglements.
		Who's the more foolish? The fool, or the fool who follows him?
		You can't win, Darth. If you strike me down, I shall become more powerful than you could possibly imagine. 
		The Force will be with you, always.
		Use the Force, Luke.
		In my experience, there's no such thing as luck.
		You don't need to see his identification. These aren't the droids you're looking for. He can go about his business. Move along.
		I felt a great disturbance in the Force, as if millions of voices suddenly cried out in terror and were suddenly silenced. I fear something terrible has happened.
		That's what your uncle told you. He didn't hold with your father's ideals; he felt he should've stayed here and not gotten involved.
		Yes. I was once a Jedi knight, the same as your father.
		He was the best star pilot in the galaxy, and a cunning warrior. I understand that you've become quite a good pilot yourself.
		Your eyes can deceive you; don't trust them.
		How long before you can make the jump to light speed?
		That's good. You have taken your first step into a larger world.
	";

	// Here we split it into lines
	$quotes = explode( "\n", $quotes );

	// And then randomly choose a line
	return wptexturize( $quotes[ mt_rand( 0, count( $quotes ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function hello_obiwan() {
	$chosen = hello_obiwan_get_quote();
	echo "<p id='obi-wan'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_obiwan' );

// We need some CSS to position the paragraph
function obiwan_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#obi-wan {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 12px;
	}
	</style>
	";
}

add_action( 'admin_head', 'obiwan_css' );