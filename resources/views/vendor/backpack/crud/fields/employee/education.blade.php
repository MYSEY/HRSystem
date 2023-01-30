<!-- field_type_name -->
<div class="form-group col-md-12" id="education-container-repeatable-elements">
    @if(!empty($entry) && !empty($entry->educations))
        @if(count($entry->educations))
            @foreach($entry->educations as $key => $education)
                <div class="row education-repeatable-element repeatable-element mt-3">
                    <button type="button" class="close education-delete-element delete-element"><span aria-hidden="true">×</span></button>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>School</label>
                        <input type="text" class="form-control" name="school[]" value="{{ $education->school }}"/>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Degree</label>
                        <select name="degree[]" class="form-control degree">
                            <option value="" disabled selected>select degree</option>
                            <?php 
                                $degree = \App\Models\Option::find($education->degree);
                            ?>
                            @if(!empty($degree))
                                <option value="{{ $education->degree }}" selected>{{ $degree->name_khmer }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Field Of Study</label>
                        <select name="field_of_study[]" class="form-control field-of-study">
                            <option value="" disabled selected>select field of study</option>
                            <?php 
                                $fieldOfStudy = \App\Models\Option::find($education->field_of_study);
                            ?>
                            @if(!empty($fieldOfStudy))
                                <option value="{{ $education->field_of_study }}" selected>{{ $fieldOfStudy->name_khmer }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12">    
                        <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">Start Date</span></label>
                        <input type="date" name="education_start_date[]" class="form-control" value="{{$education->start_date}}">
                    </div>
                    <div class="form-group col-md-6 col-12">    
                        <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">End Date</span></label>
                        <input type="date" name="education_end_date[]" class="form-control" value="{{$education->end_date}}">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Grade</label>
                        <input type="text" class="form-control" name="grade[]" value="{{$education->grade}}"/>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" name="education_description[]">{{$education->description}}</textarea>
                    </div>
                </div>
            @endforeach
        @else 
            <div class="row education-repeatable-element repeatable-element mt-3">
                <button type="button" class="close education-delete-element delete-element"><span aria-hidden="true">×</span></button>
                <div class="col-sm-6 col-md-6 mb-3">
                    <label>School</label>
                    <input type="text" class="form-control" name="school[]"/>
                </div>
                <div class="col-sm-6 col-md-6 mb-3">
                    <label>Degree</label>
                    <select name="degree[]" class="form-control degree">
                        <option value="" disabled selected>select degree</option>
                    </select>
                </div>
                <div class="col-sm-6 col-md-6 mb-3">
                    <label>Field Of Study</label>
                    <select name="field_of_study[]" class="form-control field-of-study">
                        <option value="" disabled selected>select field of study</option>
                    </select>
                </div>
                <div class="form-group col-md-6 col-12">    
                    <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">Start Date</span></label>
                    <input type="date" name="education_start_date[]" class="form-control">
                </div>
                <div class="form-group col-md-6 col-12">    
                    <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">End Date</span></label>
                    <input type="date" name="education_end_date[]" class="form-control">
                </div>
                <div class="col-sm-6 col-md-6 mb-3">
                    <label>Grade</label>
                    <input type="text" class="form-control" name="grade[]"/>
                </div>
                <div class="col-sm-12 col-md-12 mb-3">
                    <label>Description</label>
                    <textarea class="form-control" rows="3" name="education_description[]"></textarea>
                </div>
            </div>
        @endif
    @else 
        {{-- @if(Session::getOldInput())
            @foreach(Session::get('school') as $key => $old)
                <div class="row education-repeatable-element repeatable-element mt-3">
                    <button type="button" class="close education-delete-element delete-element"><span aria-hidden="true">×</span></button>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>School</label>
                        <input type="text" class="form-control" name="school[]" value="{{$old}}"/>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Degree</label>
                        <select name="degree[]" class="form-control degree">
                            <option value="" disabled selected>{{ __('flexi.select_degree') }}</option>
                            <?php 
                                $degree = \App\Models\Option::find(Session::get('degree')[$key] ?? '');
                            ?>
                            @if(!empty($degree))
                                <option value="{{ $degree->id }}" selected>{{ $degree->name_khmer }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Degree</label>
                        <select name="field_of_study[]" class="form-control field-of-study">
                            <option value="" disabled selected>{{ __('flexi.select_degree') }}</option>
                            <?php 
                                $fieldOfStudy = \App\Models\Option::find(Session::get('field_of_study')[$key] ?? '');
                            ?>
                            @if(!empty($fieldOfStudy))
                                <option value="{{ $fieldOfStudy->id }}" selected>{{ $fieldOfStudy->name_khmer }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12">    
                        <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">Start Date</span></label>
                        <input type="date" name="education_start_date[]" class="form-control" value="{{Session::get('education_start_date')[$key]}}">
                    </div>
                    <div class="form-group col-md-6 col-12">    
                        <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">End Date</span></label>
                        <input type="date" name="education_end_date[]" class="form-control" value="{{Session::get('education_end_date')[$key]}}">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Grade</label>
                        <input type="text" class="form-control" name="grade[]" value="{{ Session::get('grade')[$key] }}"/>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" name="education_description[]">{{Session::get('education_description')[$key]}}</textarea>
                    </div>
                </div>
            @endforeach
        @else
            <div class="row education-repeatable-element repeatable-element mt-3">
                <button type="button" class="close education-delete-element delete-element"><span aria-hidden="true">×</span></button>
                <div class="col-sm-6 col-md-6 mb-3">
                    <label>School</label>
                    <input type="text" class="form-control" name="school[]"/>
                </div>
                <div class="col-sm-6 col-md-6 mb-3">
                    <label>Degree</label>
                    <select name="degree[]" class="form-control degree">
                        <option value="" disabled selected>select degree</option>
                    </select>
                </div>
                <div class="col-sm-6 col-md-6 mb-3">
                    <label>Field Of Study</label>
                    <select name="field_of_study[]" class="form-control field-of-study">
                        <option value="" disabled selected>select field of study</option>
                    </select>
                </div>
                <div class="form-group col-md-6 col-12">    
                    <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">Start Date</span></label>
                    <input type="date" name="education_start_date[]" class="form-control">
                </div>
                <div class="form-group col-md-6 col-12">    
                    <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">End Date</span></label>
                    <input type="date" name="education_end_date[]" class="form-control">
                </div>
                <div class="col-sm-6 col-md-6 mb-3">
                    <label>Grade</label>
                    <input type="text" class="form-control" name="grade[]"/>
                </div>
                <div class="col-sm-12 col-md-12 mb-3">
                    <label>Description</label>
                    <textarea class="form-control" rows="3" name="education_description[]"></textarea>
                </div>
            </div>
        @endif --}}
        <div class="row education-repeatable-element repeatable-element mt-3">
            <button type="button" class="close education-delete-element delete-element"><span aria-hidden="true">×</span></button>
            <div class="col-sm-6 col-md-6 mb-3">
                <label>School</label>
                <input type="text" class="form-control" name="school[]"/>
            </div>
            <div class="col-sm-6 col-md-6 mb-3">
                <label>Degree</label>
                <select name="degree[]" class="form-control degree">
                    <option value="" disabled selected>select degree</option>
                </select>
            </div>
            <div class="col-sm-6 col-md-6 mb-3">
                <label>Field Of Study</label>
                <select name="field_of_study[]" class="form-control field-of-study">
                    <option value="" disabled selected>select field of study</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">    
                <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">Start Date</span></label>
                <input type="date" name="education_start_date[]" class="form-control">
            </div>
            <div class="form-group col-md-6 col-12">    
                <label><span data-toggle="tooltip" data-placement="top" title="Tooltip on top">End Date</span></label>
                <input type="date" name="education_end_date[]" class="form-control">
            </div>
            <div class="col-sm-6 col-md-6 mb-3">
                <label>Grade</label>
                <input type="text" class="form-control" name="grade[]"/>
            </div>
            <div class="col-sm-12 col-md-12 mb-3">
                <label>Description</label>
                <textarea class="form-control" rows="3" name="education_description[]"></textarea>
            </div>
        </div>
    @endif
</div>
<div class="form-group col-md-12">
    <button type="button" class="btn btn-success btn-sm ml-1 add-repeatable-element-button" id="education-add-repeatable-element-button">+ Add New</button>
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
            var fetchDegree = function(){
                axios.get('{{ URL("education") }}', {
                    params: { 
                        degree : 'degree'
                    }
                }).then(function (response) {
                    var object = response.data;
                    $('.degree').each(function(index){
                        $.each(object, function(ind, row){
                            if ($('.degree:eq('+index+') option[value="'+row.id+'"]').length == 0 ){
                                var option = '<option value="'+row.id+'">'+row.name_khmer+'</option>';
                                $('.degree').eq(index).append(option);
                            }
                        });
                    });
                })
            };
            var fetchFieldOfStudy = function(){
                axios.get('{{ URL("education") }}', {
                    params: { 
                        field_of_study : 'field_of_study'
                    }
                }).then(function (response) {
                    var object = response.data;
                    $('.field-of-study').each(function(index){
                        $.each(object, function(ind, row){
                            if ($('.field-of-study:eq('+index+') option[value="'+row.id+'"]').length == 0 ){
                                var option = '<option value="'+row.id+'">'+row.name_khmer+'</option>';
                                $('.field-of-study').eq(index).append(option);
                            }
                        });
                    });
                })
            };
            $('body').on('click', '#education-add-repeatable-element-button', function(){
                $('.education-repeatable-element:first').clone().appendTo('#education-container-repeatable-elements');
                var lastRepeatableElement = $('.education-repeatable-element:last');
                var input = lastRepeatableElement.find('input');
                var textarea = lastRepeatableElement.find('textarea');
                var select = lastRepeatableElement.find('select');
                input.val('');
                textarea.val('');
                select.prop('selectedIndex',0)
            });
            $('body').on('click', '.education-delete-element', function(){
                if($('.education-repeatable-element').length > 1){
                    $(this).closest('.education-repeatable-element').remove();
                }
            });
            fetchDegree();
            fetchFieldOfStudy();
        });
    </script>
@endpush