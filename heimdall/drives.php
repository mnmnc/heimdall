<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="mnmnc">
    <link rel="icon" href="favicon.ico">

    <title>Heimdall</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Heimdall</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="./"><span class="glyphicon glyphicon-th-large" aria-label="Dashboard" aria-hidden="true"></span></a></li>
            <li><a href="network.php">Network</a></li>
            <li><a href="connections.php">Connections</a></li>
            <li><a href="processes.php">Processes</a></li>
            <li class="active"><a href="drives.php">Drives</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="#">Performance</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" style="margin-top:2em">
    <a class='button' href="javascript:request()"> Load </a>
      <div class="panel panel-default">
        <div class="panel-body">
          Drives:
          <span id="dyn_drives"></span><br>
          </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-body">
          IO stats:
          <span id="dyn_io_stats"></span><br>
        </div>
      </div>
      

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
<script>
function request(){
    // JSON REQUEST

    $.getJSON( "test.php", function( data ) {
      
      var obj = jQuery.parseJSON( data );
      // DRIVES
      var drives_str = "<table class=\"table\"><tr><td>Device</td><td>Mount point</td><td>fstype</td><td>options</td><td>usage</td></tr>";
      obj.disks.forEach(function(entry) {
          var row = "<tr>"
          row += "<td>" + entry.device + "</td>";
          row += "<td>" + entry.mount + "</td>";
          row += "<td>" + entry.fstype + "</td>";
          row += "<td>" + entry.options + "</td>";
          row += "<td>" + entry.usage[3] + "</td>";
          row += "</tr>";
          drives_str += row;
      });
      drives_str += "</table>"
      $('#dyn_drives').html(drives_str);

      // IO STATS
      var io_counters_str = "<table class=\"table\"><tr><td>Disk</td><td>r_count</td><td>r_bytes</td><td>r_time</td><td>w_count</td><td>w_bytes</td><td>w_time</td></tr>";
      obj.io_counters.forEach(function(entry) {
          var row = "<tr>"
          row += "<td>" + entry.disk + "</td>";
          row += "<td>" + entry.r_count + "</td>";
          row += "<td>" + entry.r_bytes + "</td>";
          row += "<td>" + entry.r_time + "</td>";
          row += "<td>" + entry.w_count + "</td>";
          row += "<td>" + entry.w_bytes + "</td>";
          row += "<td>" + entry.w_time + "</td>";

          row += "</tr>";
          io_counters_str += row;
      });
      io_counters_str += "</table>"
      $('#dyn_io_stats').html(io_counters_str);

     
    });
}
</script>

