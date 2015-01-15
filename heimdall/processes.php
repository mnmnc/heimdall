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
            <li class="active"><a href="processes.php">Processes</a></li>
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
          Processes:
          <span id="dyn_processes"></span><br>
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
      
      // PROCESSES
      var processes_str = "<table class=\"table\"><tr><td>Name</td><td>Ctime</td><td>Files</td><td>io count</td>\
      <td>cpu times</td><td>threads count</td><td>mem use</td><td>context sw</td><td>cwd</td><td>ppid</td><td>threads</td>\
      <td>status</td><td>exec</td><td>nice</td><td>user</td><td>cpu aff</td><td>pid</td><td>cpu usage</td><td>ip nice</td>\
      <td>mem info</td><td>connections</td></tr>";
      obj.processes.forEach(function(entry) {
          var row = "<tr>"
          row += "<td>" + entry.name + "</td>";
          row += "<td>" + entry.creation_time + "</td>";
          row += "<td>" + entry.open_files + "</td>";
          row += "<td>" + entry.io_counter + "</td>";
          row += "<td>" + entry.cpu_times + "</td>";
          row += "<td>" + entry.threads_num + "</td>";
          row += "<td>" + entry.mem_usage + "</td>";
          row += "<td>" + entry.context_switches + "</td>";
          row += "<td>" + entry.working_directory + "</td>";
          row += "<td>" + entry.parent_pid + "</td>";
          row += "<td>" + entry.threads + "</td>";
          row += "<td>" + entry.status + "</td>";
          row += "<td>" + entry.executable + "</td>";
          row += "<td>" + entry.priority + "</td>";
          row += "<td>" + entry.username + "</td>";
          row += "<td>" + entry.cpu_affinity + "</td>";
          row += "<td>" + entry.pid + "</td>";
          row += "<td>" + entry.cpu_usage + "</td>";
          row += "<td>" + entry.io_priority + "</td>";
          //row += "<td>" + entry.mem_info + "</td>";
          row += "<td>" + "</td>";
          //row += "<td>" + entry.connections + "</td>";
          row += "<td>" + "</td>";
          row += "</tr>";
          processes_str += row;
      });
      processes_str += "</table>"
      $('#dyn_processes').html(processes_str);

    });
}
</script>

