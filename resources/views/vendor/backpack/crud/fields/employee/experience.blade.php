<div class="form-group col-md-12" id="experience-container-repeatable-elements">
    @if(!empty($entry->experiences) && !empty($entry->experiences))
        @if(count($entry->experiences))
            @foreach($entry->experiences as $key => $experience)
                <div class="row experience-repeatable-element repeatable-element mt-3">
                    <button type="button" class="close experience-delete-element delete-element"><span aria-hidden="true">×</span></button>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title[]" value="{{$experience->title}}"/>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Employment Type</label>
                        <select name="employment_type[]" class="form-control employment-type">
                            <option value="" disabled selected>select employment type</option>
                            <?php 
                                $employmentType = \App\Models\Option::find($experience->employment_type);
                            ?>
                            @if(!empty($employmentType))
                                <option value="{{ $experience->employment_type }}" selected>{{ $employmentType->name_khmer }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Company Name</label>
                        <input type="text" class="form-control" name="company_name[]" value="{{$experience->company_name}}"/>
                    </div>
                    <div class="form-group col-md-6 col-12">    
                        <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">Start Date</span></label>
                        <input type="date" name="start_date[]" class="form-control" value="{{$experience->start_date}}">
                    </div>
                    <div class="form-group col-md-6 col-12">    
                        <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">End Date</span></label>
                        <input type="date" name="end_date[]" class="form-control" value="{{$experience->end_date}}">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Location</label>
                        <input type="text" class="form-control" name="location[]" value="{{$experience->location}}"/>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" name="description[]">{{$experience->description}}</textarea>
                    </div>
                </div>
            @endforeach
        @else 
            <div class="row experience-repeatable-element repeatable-element mt-3">
                <button type="button" class="close experience-delete-element delete-element"><span aria-hidden="true">×</span></button>
                <div class="col-sm-6 col-md-6 mb-3">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title[]"/>
                </div>
                <div class="col-sm-6 col-md-6 mb-3">
                    <label>Employment Type</label>
                    <select name="employment_type[]" class="form-control employment-type">
                        <option value="" disabled selected>select employment type</option>
                    </select>
                </div>
                <div class="col-sm-6 col-md-6 mb-3">
                    <label>Company Name</label>
                    <input type="text" class="form-control" name="company_name[]"/>
                </div>
                <div class="form-group col-md-6 col-12">    
                    <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">Start Date</span></label>
                    <input type="date" name="start_date[]" class="form-control">
                </div>
                <div class="form-group col-md-6 col-12">    
                    <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">End Date</span></label>
                    <input type="date" name="end_date[]" class="form-control">
                </div>
                <div class="col-sm-6 col-md-6 mb-3">
                    <label>Location</label>
                    <input type="text" class="form-control" name="location[]"/>
                </div>
                <div class="col-sm-12 col-md-12 mb-3">
                    <label>Description</label>
                    <textarea class="form-control" rows="3" name="description[]"></textarea>
                </div>
            </div>
        @endif
    @else 
        {{-- @if(Session::getOldInput())
            @foreach(Session::get('title') as $key => $old)
                <div class="row experience-repeatable-element repeatable-element mt-3">
                    <button type="button" class="close experience-delete-element delete-element"><span aria-hidden="true">×</span></button>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title[]" value="{{$old}}"/>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>employment type</label>
                        <select name="employment_type[]" class="form-control employment-type">
                            <option value="" disabled selected>select employment type</option>
                            <?php 
                                $employmentType = \App\Models\Option::find(Session::get('employment_type')[$key] ?? '');
                            ?>
                            @if(!empty($employmentType))
                                <option value="{{$employmentType->id}}" selected>{{$employmentType->name_khmer}}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Company Name</label>
                        <input type="text" class="form-control" name="company_name[]" value="{{Session::get('company_name')[$key]}}"/>
                    </div>
                    <div class="form-group col-md-6 col-12">    
                        <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">Start Date</span></label>
                        <input type="date" name="start_date[]" class="form-control" value="{{Session::get('start_date')[$key]}}">
                    </div>
                    <div class="form-group col-md-6 col-12">    
                        <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">End Date</span></label>
                        <input type="date" name="end_date[]" class="form-control" value="{{Session::get('end_date')[$key]}}">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Location</label>
                        <input type="text" class="form-control" name="location[]" value="{{Session::get('location')[$key]}}"/>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" name="description[]">{{Session::get('description')[$key]}}</textarea>
                    </div>
                </div>
            @endforeach
        @else
            <div class="row experience-repeatable-element repeatable-element mt-3">
                <button type="button" class="close experience-delete-element delete-element"><span aria-hidden="true">×</span></button>
                <div class="col-sm-6 col-md-6 mb-3">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title[]"/>
                </div>
                <div class="col-sm-6 col-md-6 mb-3">
                    <label>Employment Type</label>
                    <select name="employment_type[]" class="form-control employment-type">
                        <option value="" disabled selected>select employment type</option>
                    </select>
                </div>
                <div class="col-sm-6 col-md-6 mb-3">
                    <label>Company Name</label>
                    <input type="text" class="form-control" name="company_name[]"/>
                </div>
                <div class="form-group col-md-6 col-12">    
                    <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">Start Date</span></label>
                    <input type="date" name="start_date[]" class="form-control">
                </div>
                <div class="form-group col-md-6 col-12">    
                    <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">End Date</span></label>
                    <input type="date" name="end_date[]" class="form-control">
                </div>
                <div class="col-sm-6 col-md-6 mb-3">
                    <label>Location</label>
                    <input type="text" class="form-control" name="location[]"/>
                </div>
                <div class="col-sm-12 col-md-12 mb-3">
                    <label>Description</label>
                    <textarea class="form-control" rows="3" name="description[]"></textarea>
                </div>
            </div>
        @endif --}}
        <div class="row experience-repeatable-element repeatable-element mt-3">
            <button type="button" class="close experience-delete-element delete-element"><span aria-hidden="true">×</span></button>
            <div class="col-sm-6 col-md-6 mb-3">
                <label>Title</label>
                <input type="text" class="form-control" name="title[]"/>
            </div>
            <div class="col-sm-6 col-md-6 mb-3">
                <label>Employment Type</label>
                <select name="employment_type[]" class="form-control employment-type">
                    <option value="" disabled selected>select employment type</option>
                </select>
            </div>
            <div class="col-sm-6 col-md-6 mb-3">
                <label>Company Name</label>
                <input type="text" class="form-control" name="company_name[]"/>
            </div>
            <div class="form-group col-md-6 col-12">    
                <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">Start Date</span></label>
                <input type="date" name="start_date[]" class="form-control">
            </div>
            <div class="form-group col-md-6 col-12">    
                <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">End Date</span></label>
                <input type="date" name="end_date[]" class="form-control">
            </div>
            <div class="col-sm-6 col-md-6 mb-3">
                <label>Location</label>
                <input type="text" class="form-control" name="location[]"/>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label>Description</label>
                <textarea class="form-control" rows="3" name="description[]"></textarea>
            </div>
        </div>
    @endif
</div>
<div class="form-group col-md-12">
    <button type="button" class="btn btn-success btn-sm ml-1 add-repeatable-element-button" id="experience-add-repeatable-element-button">+ Add New</button>
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
            var fetchEmploymentType = function(){
                axios.get('{{ URL("experience") }}', {
                    params: { 
                        employment_type : 'experience'
                    }
                }).then(function (response) {
                    var object = response.data;
                    $('.employment-type').each(function(index){
                        $.each(object, function(ind, row){
                            if ($('.employment-type:eq('+index+') option[value="'+row.id+'"]').length == 0 ){
                                var option = '<option value="'+row.id+'">'+row.name_khmer+'</option>';
                                $('.employment-type').eq(index).append(option);
                            }
                        });
                    });
                })
            };
            $('body').on('click', '#experience-add-repeatable-element-button', function(){
                $('.experience-repeatable-element:first').clone().appendTo('#experience-container-repeatable-elements');
                var lastRepeatableElement = $('.experience-repeatable-element:last');
                var input = lastRepeatableElement.find('input');
                var textarea = lastRepeatableElement.find('textarea');
                var select = lastRepeatableElement.find('select');
                input.val('');
                textarea.val('');
                select.prop('selectedIndex',0)
            });
            $('body').on('click', '.experience-delete-element', function(){
                if($('.experience-repeatable-element').length > 1){
                    $(this).closest('.experience-repeatable-element').remove();
                }
            });
            fetchEmploymentType();
        });
    </script>
@endpush