@if(Session::has('flash_message'))
<script type="text/javascript">
	swal({
		title: "{{Session::get('flash_message')}}",
		html: "{{Session::get('flash_message')}}",
		timer: 3500,
		showCancelButton: false,
	});
</script>
@endif