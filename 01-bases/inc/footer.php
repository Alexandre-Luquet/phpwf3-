<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function(){
        $(".play-trailer").click(function(){
            toggleVideo('show');
            $(".moviecard").addClass("movie-view-trailer");
            });
            $(".back-btn").click(function(){
              $(".moviecard").removeClass("movie-view-trailer");
              toggleVideo('hide');
            });	
          });
          function toggleVideo(state) {
              // if state == 'hide', hide. Else: show video
              var div = document.getElementById("youvideo");
              var iframe = div.getElementsByTagName("iframe")[0].contentWindow;
              div.style.display = state == 'hide' ? 'none' : '';
              func = state == 'hide' ? 'pauseVideo' : 'playVideo';
              iframe.postMessage('{"event":"command","func":"' + func + '","args":""}', '*');
        }
    </script>
  </body>
</html>