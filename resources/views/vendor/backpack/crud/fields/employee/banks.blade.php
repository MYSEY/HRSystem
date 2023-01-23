<!-- field_type_name -->
<div class="form-group col-md-12" id="bank-container-repeatable-elements">
    @if (!empty($entry) && !empty($entry->banks))
        @if (count($entry->banks))
            @foreach ($entry->banks as $key => $item)
                <div class="row bank-repeatable-element repeatable-element mt-3">
                    <button type="button" data-id="{{ $item->id }}" class="close bank-delete-element delete-element"><span aria-hidden="true">x</span></button>
                    <input type="hidden" name="bank_id[]" value="{{ $item->id }}" />
                    <div class="col-sm-4 col-md-4 mb-3">
                        <label>Bank Name</label>
                        <input type="text" class="form-control" name="bank_name[]" value="{{$item->bank_name}}">   
                    </div>
                    <div class="col-sm-4 col-md-4 mb-3">
                        <label>Account Name</label>
                        <input type="text" class="form-control" name="account_name[]" value="{{ $item->account_name }}">
                    </div>
                    <div class="col-sm-4 col-md-4 mb-3">
                        <label>Account Number</label>
                        <label>Account Number</label>
                        <input type="number" class="form-control" name="account_number[]" value="{{ $item->account_number }}">
                    </div>
                </div>
            @endforeach
        @else
            <div class="row bank-repeatable-element repeatable-element mt-3">
                <button type="button" class="close bank-delete-element delete-element"><span aria-hidden="true">×</span></button>
                <input type="hidden" name="bank_id[]" />
                <div class="col-sm-4 col-md-4 mb-3">
                    <label>Bank Name</label>
                    <input type="text" class="form-control" name="bank_name[]">
                </div>
                <div class="col-sm-4 col-md-4 mb-3">
                    <label>Account Name</label>
                    <input type="text" class="form-control" name="account_name[]">
                </div>
                <div class="col-sm-4 col-md-4 mb-3">
                    <label>Account Number</label>
                    <input type="number" class="form-control" name="account_number[]">
                </div>
            </div>
        @endif
    @else
        <div class="row bank-repeatable-element repeatable-element mt-3">
            <button type="button" class="close bank-delete-element delete-element"><span aria-hidden="true">x</span></button>
            <input type="hidden" name="bank_id[]" />
            <div class="col-sm-4 col-md-4 mb-3">
                <label>Bank Name</label>
                <input type="text" class="form-control" name="bank_name[]">
            </div>
            <div class="col-sm-4 col-md-4 mb-3">
                <label>Account Name</label>
                <input type="text" class="form-control" name="account_name[]">
            </div>
            <div class="col-sm-4 col-md-4 mb-3">
                <label>Account Number</label>
                <input type="number" class="form-control" name="account_number[]">
            </div>
        </div>
    @endif

</div>
<div class="form-group col-md-12">
    <button type="button" class="btn btn-success btn-sm ml-1 add-repeatable-element-button" id="addBank">+ Add New</button>
</div>


@push('after_styles')
    {{-- Remove style and class when enable all field show error --}}
    <style>
        .label-required {
            color: #ff0000;
        }

        .no-error-border {
            border-color: #d2d6de !important;
        }

        .no-error-label {
            color: #333 !important;
        }

        .repeatable-element {
            padding: 10px;
            border: 1px solid rgba(0, 40, 100, .12);
            border-radius: 5px;
            background-color: #f0f3f94f;
            margin-right: 0px;
            margin-left: 0;
        }

        .delete-element {
            z-index: 2;
            position: absolute !important;
            margin-left: -25px;
            margin-top: 0px;
            height: 30px;
            width: 30px;
            border-radius: 15px;
            text-align: center;
            background-color: #e8ebf0 !important;
        }

    </style>
@endpush


@push('after_scripts')
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script>
        $(function() {
            $('body').on('click', '#addBank', function() {
                $('.bank-repeatable-element:first').clone().appendTo('#bank-container-repeatable-elements');
                var lastRepeatableElement = $('.bank-repeatable-element:last');
                var input = lastRepeatableElement.find('input');
                input.val('');
            });
            $('body').on('click', '.bank-delete-element', function() {
                $(this).closest('.bank-repeatable-element').remove();
            });
            if (jQuery.ui) {
                var datepicker = $.fn.datepicker.noConflict();
                $.fn.bootstrapDP = datepicker;
            } else {
                $.fn.bootstrapDP = $.fn.datepicker;
            }

        });
    </script>
@endpush
