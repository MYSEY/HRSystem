<div class="box box-primary">
    <div class="box-header border-bottom">
        <h3 class="box-title">
            User Info
        </h3>
    </div>
    
    <div class="box-body p-0">
        <div class="box-body box-profile p-0">
            <div class="border-box text-center p-4">
                <img  src="{{ asset($entry->MediumProfile) }}" class="img-responsive img-fluid d-block mx-auto rounded-circle img-thumbnail " height="100px" alt="User profile">
            </div>
            <div class="text-center p-2">
                <h4 class="profile-username text-center text-capitalize">{{ $entry->FullName }}</h4>
            </div>
            <ul class="list-group pb-2">
                <li class="list-group-item border border-left-0 border-right-0">
                    <em class="nav-icon la la-phone mr-1"></em>
                    <a href="tel:{{ $entry->phone ?? '' }}">{{ $entry->phone ?? '' }}</a>
                </li>
                <li class="list-group-item border border-left-0 border-right-0 border-bottom-0 border-top-0">
                    <em class="nav-icon la la-envelope mr-1"></em><a href="mailto:{{ $entry->email ?? ''}}" class="text-break">{{ $entry->email ?? ''}}</a>
                </li>
                <li class="list-group-item border border-left-0 border-right-0 border-bottom-0">
                    <a href="{{ URL('admin/user/'.$entry->id.'/edit') }}" class="btn btn-primary btn-block"><em class="nav-icon la la-edit mr-1"></em>Edit</a>
                </li>
            </ul>
        </div>
    </div>
</div>




