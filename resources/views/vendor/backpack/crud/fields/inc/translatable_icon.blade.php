@php
    $translatable = false;
@endphp
@if ($translatable && config('backpack.crud.show_translatable_field_icon'))
    <em class="la la-flag-checkered pull-{{ config('backpack.crud.translatable_field_icon_position') }}" style="margin-top: 3px;" title="This field is translatable."></em>
@endif
