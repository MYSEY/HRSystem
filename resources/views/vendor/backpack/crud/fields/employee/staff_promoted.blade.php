<?php 
    $dataPosition = App\Models\Position::all();
    $dataDepartment = App\Models\Department::all();
?>
<div class="form-group col-md-12" id="bank-container-repeatable-elements">
    <div class="row bank-repeatable-element repeatable-element mt-3">
        <input type="hidden" name="employee_id">
        <div class="col-sm-4 col-md-4 mb-3">
            <label>Posistion</label>
            <select name="position_id" class="form-control">
                <option value="" disabled selected>select position</option>
                @foreach ($dataPosition as $item)
                    <option value="{{$item->id}}" @if ($entry->position_id == $item->id) selected @endif>{{ $item->name_khmer }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-4 col-md-4 mb-3">
            <label>Department</label>
            <select name="department_id" class="form-control">
                <option value="" disabled selected>select position f</option>
                @foreach ($dataDepartment as $item)
                    <option value="{{$item->id}}" @if ($entry->position_id == $item->id) selected @endif>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>


@push('after_styles')
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
