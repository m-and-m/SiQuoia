<!DOCTYPE html>
<html>
<head>
  <title>Video and Audio players.</title>

    <!-- Change URLs to wherever Video.js files will be hosted -->
    <link href="../mediaplayer/video-js.css" rel="stylesheet" type="text/css">
    <!-- video.js must be in the <head> for older IEs to work. -->
    <script src="../mediaplayer/video.js"></script>

    <!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->
    <script>
        videojs.options.flash.swf = "../mediaplayer/video-js.swf";
    </script>

    <script src="../mediaplayer/audio.min.js"></script>
    <script>
        audiojs.events.ready(function() {
        var as = audiojs.createAll();
    });
</script>
</head>
<body>
Here is some video:
  <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="640" height="480"
      poster="../mediaplayer/videobg.png" data-setup="{}">
    <source src="../files/q21.mp4" type='video/mp4' />
  </video>
<br>

Here is some music:
<br>
<audio src="../files/q21.mp3" preload="auto"> </audio>
<br>
Here is an image
<br>
<img src="../files/q001.gif">
<br>
<img src="../files/q001.gif" height="480" width="640">

<br>
<hr>
<br>
video player is using <a href="http://www.videojs.com/">video.js</a><br>
<br>
audio player is using <a href="http://kolber.github.io/audiojs/">audio.js</a><br>
<br>
both should work on most web browsers, as well as android and iOS.

</body>
</html>

/*
 $extension = strtolower(pathinfo($mediaile, PATHINFO_EXTENSION));
 if ($extension == "mp3")
 {
 	echo "<audio src='$mediafile' preload='auto> </audio>";
 }
 */
