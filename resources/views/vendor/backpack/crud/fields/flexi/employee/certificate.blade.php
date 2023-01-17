<!-- field_type_name -->
<div class="form-group col-md-12" id="certificate-container-repeatable-elements">
    @if(isset($entry))
        @if(count($entry->certificates))
            @foreach($entry->certificates as $key => $item)
                <div class="row certificate-repeatable-element repeatable-element mt-3">
                    <button type="button" data-id="{{$item->id}}" class="close certificate-delete-element delete-element"><span aria-hidden="true">×</span></button>
                    <input type="hidden" name="certificate_id[]" value="{{$item->id}}"/>
                    <div class="col-sm-4 col-md-4 mb-3">
                        <label>{{ __('flexi.title') }}</label>
                        <input type="text" class="form-control" name="title_certi[]" value="{{$item->title}}">
                    </div>
                    <div class="col-sm-4 col-md-4 mb-3">
                        <label>{{ __('flexi.description') }}</label>
                        <input type="text" class="form-control" name="description_certi[]" value="{{$item->description}}">
                    </div>
                    <div class="col-sm-4 col-md-4 mb-3 wrap-attachment-certi">
                        <label>{{ __('flexi.attachment') }}</label>
                        <div class="col-sm-4 col-md-4">
                            @php $diagnostic = $item->attachment; @endphp
                            @if($diagnostic)
                                <input type="hidden" name="hidden_attachment_certi[]" value="{{ $diagnostic }}"/>
                                @if(Helper::checkImageExtension($diagnostic))
                                    <a href="{{ config('const.filePath.original'). $diagnostic }}" data-lightbox="lightbox">
                                        <img style="width: 200px;" src="{{$diagnostic }}" alt="" />
                                    </a>
                                @else
                                    <a href="{{ config('const.filePath.original'). $diagnostic }}">{{ $diagnostic }}</a>
                                @endif
                            @endif
                        </div>
                        <input type="file" class="form-control customer_certificate" name="attachment_certi[]"/>
                    </div>
                </div>
            @endforeach
        @else
            <div class="row certificate-repeatable-element repeatable-element mt-3">
                <button type="button" class="close certificate-delete-element delete-element"><span aria-hidden="true">×</span></button>
                <input type="hidden" name="certificate_id[]"/>
                <div class="col-sm-4 col-md-4 mb-3">
                    <label>{{ __('flexi.title') }}</label>
                    <input type="text" class="form-control" name="title_certi[]">
                </div>
                <div class="col-sm-4 col-md-4 mb-3">
                    <label>{{ __('flexi.description') }}</label>
                    <input type="text" class="form-control" name="description_certi[]">
                </div>
                <div class="col-sm-4 col-md-4 mb-3">
                    <label>{{ __('flexi.attachment') }}</label>
                    <input type="file" class="form-control" name="attachment_certi[]">
                </div>
            </div>
        @endif
    @else 
        <div class="row certificate-repeatable-element repeatable-element mt-3">
            <button type="button" class="close certificate-delete-element delete-element"><span aria-hidden="true">×</span></button>
            <input type="hidden" name="certificate_id[]"/>
            <div class="col-sm-4 col-md-4 mb-3">
                <label>{{ __('flexi.title') }}</label>
                <input type="text" class="form-control" name="title_certi[]">
            </div>
            <div class="col-sm-4 col-md-4 mb-3">
                <label>{{ __('flexi.description') }}</label>
                <input type="text" class="form-control" name="description_certi[]">
            </div>
            <div class="col-sm-4 col-md-4 mb-3">
                <label>{{ __('flexi.attachment') }}</label>
                <input type="file" class="form-control" name="attachment_certi[]">
            </div>
        </div>
    @endif

</div>
<div class="form-group col-md-12">
    <button type="button" class="btn btn-success btn-sm ml-1 add-repeatable-element-button" id="addCertificate">+ {{ __('flexi.add_new') }}</button>
</div>


@push('after_styles')
    {{-- Remove style and class when enable all field show error --}}
    <style>
        .label-required { color:#ff0000; }
        .no-error-border { border-color: #d2d6de !important; }
        .no-error-label { color: #333 !important; }
        .repeatable-element{padding: 10px;border: 1px solid rgba(0,40,100,.12);border-radius: 5px;background-color: #f0f3f94f;margin-right: 0px;margin-left: 0;}
        .delete-element{z-index: 2; position: absolute !important; margin-left: -25px; margin-top: 0px; height: 30px; width: 30px; border-radius: 15px; text-align: center; background-color: #e8ebf0 !important;}
    </style>
@endpush


@push('after_scripts')
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script>
        $(function(){
            $('body').on('click', '#addCertificate', function(){
                $('.certificate-repeatable-element:first').clone().appendTo('#certificate-container-repeatable-elements');
                var lastRepeatableElement = $('.certificate-repeatable-element:last');
                var input = lastRepeatableElement.find('input');
                input.val('');
            });
            $('body').on('click', '.certificate-delete-element', function(){
                $(this).closest('.certificate-repeatable-element').remove();
            });
        });

        $('body').on('change', '.customer_certificate', function(){
            var image = $(this).closest('.wrap-attachment-certi').find('img');
            readURL(this, image);
        }); 
</script>
@endpush