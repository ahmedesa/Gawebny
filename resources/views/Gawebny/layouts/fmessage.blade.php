@if(Session::has('flash_message'))
<script type="text/javascript">
  alertify.success('{{Session::get('flash_message')}}');

     </script>
@endif