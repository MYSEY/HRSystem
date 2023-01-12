@extends('layouts.blank')

@section('content')
{{-- Content --}}
<form 
    method="post"
    id="create-form-{{ Request::get('ajax') ?? ''}}"
    class="bold-labels"
    enctype="multipart/form-data"
>
    
    @if(view()->exists('vendor.backpack.crud.form_content'))
        @include('vendor.backpack.crud.form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
    @else
        @include('crud::form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
    @endif
</form>   
@endsection