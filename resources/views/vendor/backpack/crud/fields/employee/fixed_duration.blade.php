<div class="col-sm-12">
    <div class="row">
        <div class="col-md-6">
            <form action="" method="post" class="form-restructure">
                <h1 class="navbar-brand custom-navbar-brand mb-0 text-uppercase rounded-top">
                    <strong>fixed duration contract</strong>
                </h1>
                <div class="shadow-sm border p-3">
                    <div class="row">
                        <div class="form-group col-12 col-sm-6 col-md-6">
                            <label for="employee_status">Type</label>
                            <div class="input-group">
                                <select name="fixed_dura_con_type" class="form-control">
                                    <option value="1" selected>FDC</option>
                                    <option value="2">UDC</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-12 col-sm-6 col-md-6">
                            <label for="">Start Date</label>
                            <div class="input-group">
                                <input type="date" name="fdc_date" class="form-control" value="{{$entry->date_of_commencement ?? ''}}">
                            </div>
                        </div>

                        <div class="form-group col-12 col-sm-6 col-md-12">
                            <label for="">End Date</label>
                            <div class="input-group"> 
                                <div class="input-group">
                                    <input type="date" name="fdc_end" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6">
            <form action="" method="post" class="form-restructure">
                <h1 class="navbar-brand custom-navbar-brand mb-0 text-uppercase rounded-top">
                    <strong>Employment Status</strong>
                </h1>
                <div class="shadow-sm border p-3">
                    <div class="row">
                        <div class="form-group col-12 col-sm-6 col-md-6">
                            <label for="employee_status">Status</label>
                            <div class="input-group">
                                <select name="employee_status" class="form-control">
                                    <option value="" disabled selected>select status</option>
                                    <option value="" selected>{{$entry->status}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-12 col-sm-6 col-md-6">
                            <label for="">Start Date</label>
                            <div class="input-group">
                                <input type="date" name="status_date" class="form-control">
                            </div>
                        </div>

                        <div class="form-group col-12 col-sm-6 col-md-12">
                            <label for="">Reason</label>
                            <div class="input-group">
                                <textarea class="form-control" rows="2"  placeholder="Reason"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('after_styles')
    <style>
        .label-required { color:#ff0000; }
        .no-error-border { border-color: #d2d6de !important; }
        .no-error-label { color: #333 !important; }
        .repeatable-element{padding: 10px;border: 1px solid rgba(0,40,100,.12);border-radius: 5px;background-color: #f0f3f94f;margin-right: 0px;margin-left: 0;}
        .delete-element{z-index: 2; position: absolute !important; margin-left: -25px; margin-top: 0px; height: 30px; width: 30px; border-radius: 15px; text-align: center; background-color: #e8ebf0 !important;}
    </style>
@endpush


@push('after_scripts')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $(function(){
            $('body').on('click', '#training-add-repeatable-element-button', function(){
                $('.training-repeatable-element:first').clone().appendTo('#training-container-repeatable-elements');
                var lastRepeatableElement = $('.training-repeatable-element:last');
                var input = lastRepeatableElement.find('input');
                var textarea = lastRepeatableElement.find('textarea');
                var select = lastRepeatableElement.find('select');
                input.val('');
                textarea.val('');
                select.prop('selectedIndex',0)
            });
            $('body').on('click', '.training-delete-element', function(){
                if($('.training-repeatable-element').length > 1){
                    $(this).closest('.training-repeatable-element').remove();
                }
            });
        });
    </script>
@endpush