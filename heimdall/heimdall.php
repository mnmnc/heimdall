<html>

<body>

<a href="javascript:request()"> click </a>
<br><div id="out"> in</div>

</body>

</html>
<script src="jquery.js"></script>
<script>
function request(){
    // JSON REQUEST

    $.getJSON( "test.php", function( data ) {
	var obj = jQuery.parseJSON( data );
	console.log(obj.mem_usage.free);
	$('#out').text(obj.mem_usage.free);

    });
}
</script>
