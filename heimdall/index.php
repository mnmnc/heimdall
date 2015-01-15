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
          <a class="navbar-brand" href="./">Heimdall</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="./"><span class="glyphicon glyphicon-th-large" aria-label="Dashboard" aria-hidden="true"></span></a></li>
            <li><a href="network.php">Network</a></li>
            <li><a href="connections.php">Connections</a></li>
            <li><a href="processes.php">Processes</a></li>
            <li><a href="drives.php">Drives</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="#">Performance</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="container">

      <div class="page-header">
        <h1>
          <small>hostname: </small>
          <span id="dyn_sys_name" style='margin-right:2em'></span>
          <span id="dyn_sys_logo" ></span>
          <small><small><span id="dyn_users"></span></small></small>
        </h1>
      </div>
      <div>
        <h3>
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-lg-4">
              <small>
                LAST BOOT: 
              </small>
              <span id="dyn_boot_time"></span>
            </div>

            <div class="col-xs-12 col-sm-6 col-lg-4">
              <small>
                LAST SEEN: 
              </small>
              <span id="dyn_boot_time2"></span>
            </div>
          </div>
        </h3>
      </div>
    </div>
    <br>

    <div class="container">
      <a class='button' href="javascript:request()"> Load </a>
    </div> 

    <div class="container">
      <h4>Network:</h4>

      <span id="dyn_network_stat"></span>
    </div>

    <div class="container">
      <h4>Cpu / Memory:</h4>
      <table class="table">
        <tr>
          <th>Cpu used</th>
          <th>Mem used</th>
          <th>Processes</th>
          <th>Connections</th>
        </tr>
        <tr>
          <td><span id="dyn_cpu_usage"></span></td>
          <td><span id="dyn_mem_used"></span> %</td>
          <td><span id="dyn_processes"></span>ttt</td>
          <td><span id="dyn_connections"></span></td>
        </tr>
        <tr>
          <td><span id=""></span><h4>Network:</h4></td>
          <td><span id=""></span><h4></h4></td>
          <td><span id=""></span><h4></h4></td>
          <td><span id=""></span><h4></h4></td>
        </tr>
        <tr>
          <td><span id=""></span>s</td>
          <td><span id=""></span> %</td>
          <td><span id=""></span>ttt</td>
          <td><span id=""></span>s</td>
        </tr>
      </table>
    </div>

    <div class="container">
      <h4>Drives:</h4>
      <span id="dyn_drives"></span>
      </table>
    </div>






    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
function time_to_date(t){
  var d = new Date(t*1000);

  var result = d.getDate() + '/' + (d.getMonth()+1) + '/' + d.getFullYear() + "  " + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
  return result;
}

function bytes_to_fixed(bytes){
  var result = bytes;
  var unit = " B";
  if (result > 1024){
    result = result / 1024;
    unit = " KB";
  }
  if (result > 1024){
    result = result / 1024;
    unit = " MB";
  }
  if (result > 1024){
    result = result / 1024;
    unit = " GB";
  }
  if (result > 1024){
    result = result / 1024;
    unit = " TB";
  }
  if (result > 1024){
    result = result / 1024;
    unit = " PB";
  }
  if (result > 1024){
    result = result / 1024;
    unit = " EB";
  }
  return (Math.round(result)).toString() + unit;
}

function number_to_fixed(bytes){
  var result = bytes;
  var unit = " ";
  if (result > 1000){
    result = result / 1000;
    unit = " K";
  }
  if (result > 1000){
    result = result / 1000;
    unit = " M";
  }
  return (Math.round(result)).toString() + unit;
}

function request(){
    // JSON REQUEST

    $.getJSON( "test.php", function( data ) {
      
      var obj = jQuery.parseJSON( data );

      $('#dyn_sys_name').text(obj.system_info.hostname);
      //$('#dyn_sys_family').text(obj.system_info.family); 
      if (obj.system_info.family = "Linux"){
        $('#dyn_sys_logo').html("<img src=\"img/tux-icon2.png\" width=40 alt=\"tux icon\" class=\"img-rounded\">");
      }

      //$('#dyn_sys_release').text(obj.system_info.release);
      //$('#dyn_sys_version').text(obj.system_info.version);
      //$('#dyn_sys_iset').text(obj.system_info.i_set);

      $('#dyn_boot_time').text(time_to_date(obj.boot_time.boot));
      $('#dyn_boot_time2').text(time_to_date(obj.boot_time.boot));

      $('#dyn_mem_total').text(obj.mem_usage.total);
      $('#dyn_mem_free').text(obj.mem_usage.free);
      $('#dyn_mem_used').text(obj.mem_usage.used_percent);

      $('#dyn_swap_total').text(obj.swap_usage.total);
      $('#dyn_swap_free').text(obj.swap_usage.free);
      $('#dyn_swap_used').text(obj.swap_usage.used);

      // CPU USAGE
      var cpu_usage_str = "";
      obj.cpu_usage.forEach(function(entry) {
          cpu_usage_str += "<span class='label label-default'>" + entry + "</span> ";
      });
      $('#dyn_cpu_usage').html(cpu_usage_str);

      $('#dyn_cpu_cores').text(obj.cpu_count.logical + "/" + obj.cpu_count.physical);

      // DRIVES
      var drives_str = "<table class='table'>\
        <tr>\
          <td>Mount</td>\
          <td>Usage</td>\
          <td>Fstype</td>\
          <td>Mode</td>\
        </tr>";
      obj.disks.forEach(function(entry) {
          var row = "<tr>"
          row += "<td>" + entry.mount + "</td>";
          row += "<td>" + entry.usage[3] + "</td>";
          row += "<td>" + entry.fstype + "</td>";
          var options = entry.options.split(',')[0];
          if (options == 'rw'){
            row += "<td><span class='label label-default'>" + options + "</span></td>";
          }
          else {
            row += "<td><span class='label label-warning'>" + options + "</span></td>";
          }

          row += "</tr>";
          drives_str += row;
      });
      drives_str += "</table>";
      $('#dyn_drives').html(drives_str);


      // NET STATS
      var net_bsent = 0;
      var net_brecv = 0;
      var net_psent = 0;
      var net_precv = 0;
      obj.net_counters.forEach(function(entry) {
          net_bsent += entry.bytes_sent;
          net_brecv += entry.bytes_recv;
          net_psent += entry.packets_sent;
          net_precv += entry.packets_recv;
      });
      $('#dyn_network_stat').html("<table class=\"table\"><tr>\
        <td>Bytes <span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></td>\
        <td>Bytes <span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></td>\
        <td>Packets <span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></td>\
        <td>Packets <span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></td></tr>\
        <tr><td>"+bytes_to_fixed(net_bsent)+"</td><td>"+bytes_to_fixed(net_brecv)+"</td>\
        <td>"+number_to_fixed(net_psent)+"</td><td>"+number_to_fixed(net_precv)+"</td></tr></table>");

      // NETWORK CONNECTIONS
      var counter = 0;
      obj.net_connections.forEach(function(entry) {
          if (entry.status == "ESTABLISHED"){
            counter+=1;
          }
      });
      $('#dyn_connections').text(counter);

      // CURRENT SESSIONS
      $('#dyn_users').html( "<span class='glyphicon glyphicon-user'></span> " + (obj.current_users.length).toString());

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
      //$('#dyn_processes').html(processes_str);

    });
}
</script>

