@if (config('backpack.base.show_powered_by') || config('backpack.base.developer_link'))
    <div class="text-muted">
      @if (config('backpack.base.show_powered_by'))
      {{ trans('backpack::base.powered_by') }} <a target="_blank" rel="noopener" href="">CAMMA</a>.
      @endif
    </div>
@endif