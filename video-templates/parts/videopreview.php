<?php  
$upload_dir = wp_upload_dir();
$videopath = $upload_dir['baseurl'];
?>
<div class="video-left col-left">
	<video width="630" height="356" poster="<?php echo $videopath;?>/video/<%= filename %>.jpg" controls="true" preload="auto">
		<source src="<?php echo $videopath;?>/video/<%= filename %>.mp4" type="video/mp4"></source>
		<source src="<?php echo $videopath;?>/video/<%= filename %>.ogg" type="video/ogg"></source>
		<object id="<%= filename %>" name="<%= filename %>" width="630" height="356" type="application/x-shockwave-flash" data="<?php echo $videopath;?>/video/player.swf?image=<?php echo $videopath;?>/video/<%= filename %>.jpg&amp;file=<?php echo $videopath;?>/video/<%= filename %>.mov">
			<param name="allowScriptAccess" value="always" />
			<param name="wmode" value="transparent">
			<param name="movie" value="<?php echo $videopath;?>/video/player.swf?image=<?php echo $videopath;?>/video/<%= filename %>.jpg&amp;file=<?php echo $videopath;?>/video/<%= filename %>.mp4" />
			<img src="<?php echo $videopath;?>/video/<%= filename %>.jpg" width="630" height="356" alt="" title="No video playback capabilities, please download the video below" />
		</object>
	</video>	
 </div>
 <div class="col-right">
 	<h2><%= title %></h2>
 	<%= description %>
 </div>