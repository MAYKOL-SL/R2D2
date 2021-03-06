<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/dropdown.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/chosen/chosen.jquery.js') }}" type="text/javascript"></script>

            
             <script src="{{ asset('js/jquery-multi-select/js/jquery.multi-select.js') }}"></script>
             
             <script src="{{ asset('js/jquery-multi-select/js/jquery.quicksearch.js') }}"></script>
             
             <script src="{{ asset('js/jquery-multi-select/js/jquery.tinysort.js') }}"></script>
                <script src="{{ asset('js/multi-select-init.js') }}"></script>

	<!-- Fullcalendar -->	
	<script src='fullcalendar/lib/moment.min.js'></script>
	<script src='fullcalendar/fullcalendar.min.js'></script>

  @yield('js')
	 		
<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->