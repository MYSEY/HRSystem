@extends('layouts.app')
@section('content-header')
    <section class="content-header">
        <h1>
            <span class="text-capitalize">{{ $crud->entity_name_plural }}</span>
            <small>{{ 'Preview' . ' ' . $crud->entity_name }}.</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">Admin</a>
            </li>
            <li>
                <a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
            <li class="active">Preview</li>
        </ol>
    </section>
@endsection
@section('content')
    @if ($crud->hasAccess('list'))
        <a href="{{ url($crud->route) }}" class="hidden-print"><em class="la la-angle-double-left"></em>back to all <span>{{ $crud->entity_name_plural }}</span></a><br><br>
    @endif
    @component('admins.employees.employee_tabs', compact('entry'))
    @endcomponent
@endsection

@push('after_styles')
    @include('inc.datatable_styles')
    <style>
        .self-card-header {
            padding: 0.25rem 0.25rem;
            margin-bottom: 0;
            background-color: #f9fbfd;
            border-bottom: 2px solid #d9e2ef;
        }

        .buttons-html5,
        .buttons-print {
            color: #1b2a4e !important;
            padding: 4px 12px !important;
            font-size: 12px !important;
            border-radius: 2px !important;
            border: 1px solid #dbdbde !important;
            font-weight: bold !important;
        }

        div.dt-buttons {
            margin-bottom: 20px;
        }

        .dataTables_length {
            position: absolute;
        }

        div.dataTables_wrapper div.dataTables_length select {
            min-width: 100px;
        }

        .input-group-addon {
            padding: 8px 10px;
            font-size: 22px;
            font-weight: 400;
            line-height: 1;
            color: #555;
            text-align: center;
            background-color: #eee;
            border: 0px;
            border-radius: 2px 0px 0 2px;
        }

        .input-group .form-control {
            margin-left: 0 !important;
        }

        /* FILTER POP UP  FORM */
        .sidenav {
            max-width: 400px;
            height: auto;
            width: 25%;
            position: absolute;
            z-index: 1021;
            top: 278px;
            right: 65px;
            background-color: #fff;
            overflow-x: hidden;
            transition: 0.5s;
        }

        .main_purpose {
            color: red;
        }

        .meet_main_purpose {
            color: red;
        }
    </style>
@endpush
