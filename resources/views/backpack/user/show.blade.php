@extends('layouts.app')
@section('content-header')
	<section class="content-header">
	  <h1>
        <span class="text-capitalize">{{ $crud->entity_name_plural }}</span>
        <small>{{ ucfirst(trans('backpack::crud.preview')).' '.$crud->entity_name }}.</small>
      </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('flexi_crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('flexi_crud.preview') }}</li>
	  </ol>
	</section>
@endsection

@section('content')

	@if ($crud->hasAccess('list'))
		<a href="{{ url($crud->route) }}" class="hidden-print"><em class="la la-angle-double-left"></em>back to all <span>{{ $crud->entity_name_plural }}</span></a><br><br>
	@endif

	<div>
		<div class="row">
			<div class="col-sm-3 col-md-3 pr-0">
				@component('backpack.user.user_info', compact('entry'))
				@endcomponent
			</div>

			<div class="col-sm-9 col-md-9">
				@component('backpack.user.info_details', compact('entry'))
				@endcomponent
			</div>
		</div>
	</div>

@endsection

@section('after_styles')
	<link href="{{ asset('packages/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
	<style>
		.box.box-primary {
			border-top-color: #41ba96;
		}
		.box {
			position: relative;
			border-radius: 3px;
			margin-bottom: 20px;
			width: 100%;
		}	
		.box, .mnb-custom .tab-content .tab-pane {
			background: #fff;
		}
		.box {
			border-top: 3px solid #d2d6de;
			box-shadow: 0 1px 1px rgba(0,0,0,.1);
			border-left: 1px solid #ddd;
			border-right: 1px solid #ddd;
		}
		.box-header {
			color: #444;
			display: block;
			padding: 10px;
			position: relative;
		}
		.box-header .box-title, .box-header>.fa, .box-header>.glyphicon, .box-header>.ion {
			display: inline-block;
			font-size: 18px;
			margin: 0;
			line-height: 1;
		}
		.box-body {
			border-top-left-radius: 0;
			border-top-right-radius: 0;
			border-bottom-right-radius: 3px;
			border-bottom-left-radius: 3px;
			padding: 10px;
		}
		.mnb-custom .nav-link.active {
			position: relative;
			/* border-bottom: none !important; */
			border-top: 3px solid #41ba96 !important;
		}
		.mnb-custom .nav-link {
			border-bottom: none !important;
		}
		.list-group-item:first-child {
			border-top-left-radius: 0;
			border-top-right-radius: 0;
		}
	</style>
@endsection



