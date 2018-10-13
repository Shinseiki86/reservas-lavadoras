@push('head')
	{!! Html::style('assets/stylesheets/datatable/datatable/dataTables.bootstrap.min.css') !!}

	{!! Html::style('assets/stylesheets/datatable/buttons/buttons.dataTables.min.css') !!}
	{!! Html::style('assets/stylesheets/datatable/buttons/buttons.bootstrap4.min.css') !!}

	{!! Html::style('assets/stylesheets/datatable/responsive/responsive.bootstrap.min.css') !!}
	{!! Html::style('assets/stylesheets/datatable/responsive/responsive.dataTables.min.css') !!}

	{!! Html::style('assets/stylesheets/datatable/scroller/scroller.dataTables.min.css') !!}
	{!! Html::style('assets/stylesheets/datatable/scroller/scroller.bootstrap.min.css') !!}
@endpush

@push('scripts')
	{!! Html::script('assets/scripts/datatable/libs_export/jszip.min.js') !!}
	{!! Html::script('assets/scripts/datatable/libs_export/pdfmake.min.js') !!}
	{!! Html::script('assets/scripts/datatable/libs_export/vfs_fonts.js') !!}

	{!! Html::script('assets/scripts/datatable/datatable/jquery.dataTables.min.js') !!}
	{!! Html::script('assets/scripts/datatable/datatable/dataTables.bootstrap.min.js') !!}

	{!! Html::script('assets/scripts/datatable/buttons/dataTables.buttons.min.js') !!}
	{!! Html::script('assets/scripts/datatable/buttons/buttons.html5.min.js') !!}
	{!! Html::script('assets/scripts/datatable/buttons/buttons.colVis.min.js') !!}
	{!! Html::script('assets/scripts/datatable/buttons/buttons.print.min.js') !!}
	{!! Html::script('assets/scripts/datatable/buttons/buttons.flash.min.js') !!}
	{!! Html::script('assets/scripts/datatable/buttons/buttons.bootstrap4.min.js') !!}

	{!! Html::script('assets/scripts/datatable/responsive/dataTables.responsive.min.js') !!}
	{!! Html::script('assets/scripts/datatable/responsive/responsive.bootstrap.min.js') !!}

	{!! Html::script('assets/scripts/datatable/scroller/dataTables.scroller.min.js') !!}

	{!! Html::script('assets/scripts/datatable/init.js') !!}

@endpush
