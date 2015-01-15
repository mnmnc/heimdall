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
            <li class="active"><a href="connections.php">Connections</a></li>
            <li><a href="processes.php">Processes</a></li>
            <li><a href="drives.php">Drives</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="#about">Performance</a></li>
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
          Connections:
          <span id="dyn_connections"></span><br>
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

      // NETWORK CONNECTIONS
      var net_connections_str = "<table class=\"table\"><tr><td>Local</td><td>Remote</td><td>status</td><td>pid</td><td>family</td><td>type</td></tr>";
      obj.net_connections.forEach(function(entry) {
          var row = "<tr>"

          if ( entry.local_address != null && entry.local_address.length == 2 ) {
              row += "<td>" + entry.local_address[0] + ":" + entry.local_address[1] + "</td>";
          }
          else {
              row += "<td>-</td>";
          }

          if ( entry.remote_address != null && entry.remote_address.length == 2 ) {
              row += "<td>" + entry.remote_address[0] + ":" + entry.remote_address[1] + "</td>";
          }
          else {
              row += "<td>-</td>";
          }
          row += "<td>" + entry.status + "</td>";
          row += "<td>" + entry.pid + "</td>";
          row += "<td>" + entry.family + "</td>";
          row += "<td>" + entry.type + "</td>";


          row += "</tr>";
          net_connections_str += row;
      });
      net_connections_str += "</table>"
      $('#dyn_connections').html(net_connections_str);

      

    });
}
</script>

