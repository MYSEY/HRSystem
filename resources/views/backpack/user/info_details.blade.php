<div class="mnb-custom d-flex flex-wrap w-100 mb-3 bg-white">
    <div class="d-flex justify-content-between flex-wrap w-100">
        <ul class="nav" role="tabTitle">
            <li class="nav-item">
                <a class="nav-link">
                    <em class="la la-home"></em>
                    Information
                </a>
            </li>
        </ul>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="tablist">
                <a class="nav-link btn-tab-change active" data-toggle="tab" href="#user-info" role="tab" data-type="User Info" aria-selected="true">
                    User Info
                </a>
            </li>
            <li class="nav-item" role="tablist">
                <a class="nav-link btn-tab-change" data-toggle="tab" href="#user-role" role="tab" data-type="User Role" aria-selected="false">
                    User Role
                </a>
            </li>
        </ul>
    </div>
    <div class="tab-content w-100">
        <div class="tab-pane fade active show" id="user-info" role="tabpanel" aria-labelledby="User Info">
            <div class="container-fluid px-3">
                <div class="row">
                    <div class="col-md-12">
                        @include('backpack.user.tab_user_info')
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="user-role" role="tabpanel" aria-labelledby="User Role">
            <div class="content-right-wrapper">
                <div class="container pl-0">
                    <div class="row">
                        <div class="col-md-12 pr-0">
                            @include('backpack.user.tab_user_role')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

