<?php
$isEditAndHasCompany = true;
?>
<div class="form-group col-md-12" id="company-container-repeatable-elements">
    @if (!empty($entry) && !empty($entry->companies))
        @if (count($entry->companies))
            @foreach ($entry->companies as $key => $company)
                <div class="row company-repeatable-element repeatable-element mt-3">
                    <button type="button" class="close company-delete-element delete-element"><span
                            aria-hidden="true">×</span></button>
                    <div class="col-sm-12 col-md-12 mt-2 mb-3 company-repeatable-element">
                        <div class="row">
                            <input type="hidden" name="company_in[]" value="{{ $company->id }}" />
                            <div class="form-group col-md-12 col-12" element="div">
                                <label class="navbar-brand custom-navbar-brand mb-0">Company Info</label>
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Name In English</label>
                                <input type="text" class="form-control" name="company_english_name[]"
                                    value="{{ $company->company_name }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Name In Khmer</label>
                                <input type="text" class="form-control" name="company_khmer_name[]"
                                    value="{{ $company->khmer_name }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Tax Identification Number (TIN)</label>
                                <input type="text" class="form-control" name="tax_identification_number[]"
                                    value="{{ $company->tax_identification_number }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Registered Date</label>
                                <input type="date" class="form-control" name="registered_date[]"
                                    value="{{ $company->registered_date }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Major of Business</label>
                                <select name="company_major_of_business[]" class="form-control major-of-business">
                                    <option value="" disabled selected>Select major of business</option>
                                    <?php
                                    $major = \App\Models\Option::find($company->major_of_business);
                                    ?>
                                    @if (!empty($major))
                                        <option value="{{ $company->major_of_business }}" selected>{{ $major->display }}
                                        </option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Position</label>
                                <input type="text" class="form-control" name="company_position[]"
                                    value="{{ $company->position }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Legal Status</label>
                                <select name="company_legal_status[]" class="form-control legal-status">
                                    <option disabled selected>Select legal status</option>
                                    <?php
                                    $legalStatus = \App\Models\Option::find($company->legal_status);
                                    ?>
                                    @if (!empty($legalStatus))
                                        <option value="{{ $company->legal_status }}" selected>
                                            {{ $legalStatus->display }}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Registered Business</label>
                                <select name="company_registered_business[]" class="form-control registered-business">
                                    <option disabled selected>Select registered business</option>
                                    <?php
                                    $registeredBusiness = \App\Models\Option::find($company->registered_business);
                                    ?>
                                    @if (!empty($registeredBusiness))
                                        <option value="{{ $company->registered_business }}" selected>
                                            {{ $registeredBusiness->display }}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Company Size</label>
                                <input type="text" class="form-control" name="company_size[]"
                                    value="{{ $company->company_size }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Number of Branche</label>
                                <input type="text" class="form-control" name="company_number_of_branch[]"
                                    value="{{ $company->number_of_branches }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Business Model</label>
                                <select name="company_business_model[]" class="form-control business-model">
                                    <option disabled selected>Select business model</option>
                                    <?php
                                    $businessModel = \App\Models\Option::find($company->business_model);
                                    ?>
                                    @if (!empty($businessModel))
                                        <option value="{{ $company->business_model }}" selected>
                                            {{ $businessModel->display }}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Capital Investment [Range]</label>
                                <input type="text" class="form-control" name="company_capital_investment[]"
                                    value="{{ $company->capital_investment }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Year Founded</label>
                                <input type="text" class="form-control" name="company_year_founded[]"
                                    value="{{ $company->year_founded }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label style="width: 100%;">is Primary?</label>
                                <select class="form-control" name="company_is_primary[]">
                                    <option value="1" @if ($company->is_primary == 1) selected @endif>Yes
                                    </option>
                                    <option value="0" @if ($company->is_primary == 0) selected @endif> No
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3 wrap-company-diagnostic-report">
                                <label>Company Diagnostic Report</label>
                                <div class="col-sm-4 col-md-4 mb-3 px-0 pt-3">
                                    @php $diagnostic = $company->company_diagnostic_report; @endphp
                                    @if ($diagnostic)
                                        <input type="hidden" name="hidden_company_diagnostic_report[]"
                                            value="{{ $diagnostic }}" />
                                        @if (Helper::checkImageExtension($diagnostic))
                                            <a href="{{ config('const.filePath.original') . $diagnostic }}"
                                                data-lightbox="lightbox">
                                                <img style="width: 200px;"
                                                    src="{{ asset('/uploads/files/medium/' . $diagnostic) }}"
                                                    alt="" />
                                            </a>
                                        @else
                                            <a href="{{ config('const.filePath.original') . $diagnostic }}"
                                                download>{{ $diagnostic }}</a>
                                        @endif
                                    @endif
                                </div>
                                <input type="file" class="form-control company-diagnostic-report"
                                    name="company_diagnostic_report[]" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3 wrap-company-milestone">
                                <label>Company's Milestones</label>
                                <div class="col-sm-4 col-md-4 mb-3 px-0 pt-3">
                                    @php $milestone = $company->company_milestones; @endphp
                                    @if ($milestone)
                                        <input type="hidden" name="hidden_company_milestones[]"
                                            value="{{ $milestone }}" />
                                        @if (Helper::checkImageExtension($milestone))
                                            <a href="{{ config('const.filePath.original') . $milestone }}"
                                                data-lightbox="lightbox">
                                                <img style="width: 200px;"
                                                    src="{{ asset('/uploads/files/medium/' . $milestone) }}"
                                                    alt="" />
                                            </a>
                                        @else
                                            <a href="{{ config('const.filePath.original') . $milestone }}"
                                                download>{{ $milestone }}</a>
                                        @endif
                                    @endif
                                </div>
                                <input type="file" class="form-control company-milestone"
                                    name="company_milestones[]" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3 wrap-company-logo">
                                <label style="width: 100%;">Company's Logo (size: 1396px * 667px)</label>
                                <input type="file" class="form-control company-logo mt-2" name="company_logo[]" />
                                @if ($company->company_logo)
                                    <input type="hidden" name="hidden_company_logo[]"
                                        value="{{ $company->company_logo }}" />
                                    <a href="{{ config('const.s3Path.large') . $company->company_logo }}"
                                        data-lightbox="lightbox">
                                        <img src="{{ config('const.s3Path.large') . $company->company_logo }}"
                                            style="margin-top: 10px; margin-right: 5px; border-radius: 5px; height: 70px; border: 3px solid #dce1ea;"
                                            alt="" />
                                    </a>
                                @endif
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3 wrap-service-image">
                                <label style="width: 100%;">Service images exist(size: 1396px * 667px)</label>
                                <input type="file" class="form-control service-image mt-2" multiple />
                                @if (!empty($company->service_images))
                                    <?php $serviceImages = json_decode($company->service_images, true); ?>
                                    @if (is_array($serviceImages))
                                        @foreach ($serviceImages as $serviceImage)
                                            <a href="{{ config('const.s3Path.large') . $serviceImage }}"
                                                data-lightbox="lightbox">
                                                <img src="{{ config('const.s3Path.large') . $serviceImage }}"
                                                    style="margin-top: 10px; margin-right: 5px; border-radius: 5px; height: 70px; border: 3px solid #dce1ea;"
                                                    alt="" />
                                            </a>
                                        @endforeach
                                    @endif
                                    <textarea name="hiddend_service_image[]" style="display: none;">{{ $company->service_images }}</textarea>
                                @endif
                                <textarea name="service_images[]" class="hiddend-textarea" style="display: none;"></textarea>
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Company Slogan</label>
                                <textarea class="form-control" rows="2" name="company_slogan[]">{{ $company->company_slogan }}</textarea>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label>Personal Interest</label>
                                <textarea class="form-control" rows="2" name="company_personal_interest[]">{{ $company->personal_interest }}</textarea>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label>Company Profile</label>
                                <textarea class="form-control" rows="2" name="company_profile[]">{{ $company->company_profile }}</textarea>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label>Company Product and Service</label>
                                <textarea class="form-control" rows="2" name="company_product_and_service[]">{{ $company->company_product_and_service }}</textarea>
                            </div>
                            <div class="col-sm-12 col-md-12 mb-3">
                                <label>Full Address</label>
                                <textarea class="form-control" rows="2" name="company_full_address[]">{{ $company->full_address }}</textarea>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label class="navbar-brand custom-navbar-brand mb-0">Contact Info</label>
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Phone Number </label>
                                <input type="text" class="form-control" name="company_phone_number[]"
                                    value="{{ $company->phone_number }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Email </label>
                                <input type="text" class="form-control" name="company_email[]"
                                    value="{{ $company->email }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>What App</label>
                                <input type="text" class="form-control" name="company_what_app[]"
                                    placeholder="855XXXXXXXXXX" value="{{ $company->what_app }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Telegram</label>
                                <input type="text" class="form-control" name="company_telegram[]"
                                    placeholder="username" value="{{ $company->telegram }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Messenger</label>
                                <input type="text" class="form-control" name="company_messenger[]"
                                    value="{{ $company->messenger }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Skype</label>
                                <input type="text" class="form-control" name="company_skype[]"
                                    value="{{ $company->skype }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>We Chat</label>
                                <input type="text" class="form-control" name="company_we_chat[]"
                                    value="{{ $company->we_chat }}" />
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label class="navbar-brand custom-navbar-brand mb-0">Social Link</label>
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Website</label>
                                <input type="text" class="form-control" name="company_website[]"
                                    placeholder="http://www.yourdomain.com" value="{{ $company->website }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Facebook</label>
                                <input type="text" class="form-control" name="company_facebook[]"
                                    placeholder="https://www.fb.com/username" value="{{ $company->facebook }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Linkedin</label>
                                <input type="text" class="form-control" name="company_linkedin[]"
                                    placeholder="https://www.linkedin.com/in/username"
                                    value="{{ $company->linkedin }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Twitter</label>
                                <input type="text" class="form-control" name="company_twitter[]"
                                    placeholder="https://twitter.com/username" value="{{ $company->twitter }}" />
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <?php
            $isEditAndHasCompany = false;
            ?>
        @endif
    @else
        @if (Session::getOldInput())
            @foreach (Session::get('company_english_name') as $key => $old)
                <div class="row company-repeatable-element repeatable-element mt-3">
                    <button type="button" class="close company-delete-element delete-element"><span
                            aria-hidden="true">×</span></button>
                    <div class="col-sm-12 col-md-12 mt-2 mb-3 company-repeatable-element">
                        <div class="row">
                            <input type="hidden" name="company_in[]"
                                value="{{ Session::get('company_in')[$key] }}" />
                            <div class="form-group col-md-12 col-12">
                                <label class="navbar-brand custom-navbar-brand mb-0">Company Info</label>
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Name In English</label>
                                <input type="text" class="form-control" name="company_english_name[]"
                                    value="{{ $old }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Name In Khmer</label>
                                <input type="text" class="form-control" name="company_khmer_name[]"
                                    value="{{ Session::get('company_khmer_name')[$key] }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Tax Identification Number (TIN)</label>
                                <input type="text" class="form-control" name="tax_identification_number[]"
                                    value="{{ Session::get('tax_identification_number')[$key] }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Registered Date</label>
                                <input type="date" class="form-control" name="registered_date[]"
                                    value="{{ Session::get('registered_date')[$key] }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Major of Business</label>
                                <select name="company_major_of_business[]" class="form-control major-of-business">
                                    <option disabled selected>Select major of business</option>
                                    <?php
                                    $major = \App\Models\Option::find(Session::get('company_major_of_business')[$key] ?? '');
                                    ?>
                                    @if (!empty($major))
                                        <option value="{{ $major->id }}" selected>{{ $major->display }}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Position</label>
                                <input type="text" class="form-control" name="company_position[]"
                                    value="{{ Session::get('company_position')[$key] }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Legal Status</label>
                                <select name="company_legal_status[]" class="form-control legal-status">
                                    <option disabled selected>Select legal status</option>
                                    <?php
                                    $legalStatus = \App\Models\Option::find(Session::get('company_legal_status')[$key] ?? '');
                                    ?>
                                    @if (!empty($legalStatus))
                                        <option value="{{ $legalStatus->id }}" selected>{{ $legalStatus->display }}
                                        </option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Registered Business</label>
                                <select name="company_registered_business[]" class="form-control registered-business">
                                    <option disabled selected>Select registered business</option>
                                    <?php
                                    $registeredBusiness = \App\Models\Option::find(Session::get('company_registered_business')[$key] ?? '');
                                    ?>
                                    @if (!empty($registeredBusiness))
                                        <option value="{{ $registeredBusiness->id }}" selected>
                                            {{ $registeredBusiness->display }}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Company Size</label>
                                <input type="text" class="form-control" name="company_size[]"
                                    value="{{ Session::get('company_size')[$key] }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Number of Branche</label>
                                <input type="text" class="form-control" name="company_number_of_branch[]"
                                    value="{{ Session::get('company_number_of_branch')[$key] }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Business Model</label>
                                <select name="company_business_model[]" class="form-control business-model">
                                    <option value="" disabled selected>Select business model</option>
                                    <?php
                                    $businessModel = \App\Models\Option::find(Session::get('company_business_model')[$key] ?? '');
                                    ?>
                                    @if (!empty($businessModel))
                                        <option value="{{ $businessModel->id }}" selected>
                                            {{ $businessModel->display }}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Capital Investment [Range]</label>
                                <input type="text" class="form-control" name="company_capital_investment[]"
                                    value="{{ Session::get('company_capital_investment')[$key] }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Year Founded</label>
                                <input type="text" class="form-control" name="company_year_founded[]"
                                    value="{{ Session::get('company_year_founded')[$key] }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label style="width: 100%;">is Primary?</label>
                                <select class="form-control" name="company_is_primary[]">
                                    <option value="0" @if (Session::get('company_is_primary')[$key] == 0) selected @endif> No
                                    </option>
                                    <option value="1" @if (Session::get('company_is_primary')[$key] == 1) selected @endif>Yes
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3 wrap-company-diagnostic-report">
                                <label>Company Diagnostic Report</label>
                                <img src="" alt="" style="width: 200px; margin-bottom: 10px;" />
                                <input type="file" class="form-control" name="company_diagnostic_report[]" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Company's Milestones</label>
                                <img src="" alt="" style="width: 200px; margin-bottom: 10px;" />
                                <input type="file" class="form-control" name="company_milestones[]" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3 wrap-company-logo">
                                <label style="width: 100%;">Company's Logo (size: 1396px * 667px)</label>
                                <input type="file" class="form-control company-logo" name="company_logo[]" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3 wrap-service-image">
                                <label style="width: 100%;">Service images (size: 1396px * 667px)</label>
                                <input type="file" class="form-control service-image" multiple />
                                <textarea name="service_images[]" class="hiddend-textarea" style="display: none;"></textarea>
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Company Slogan</label>
                                <textarea class="form-control" rows="2" name="company_slogan[]">{{ Session::get('company_slogan')[$key] }}</textarea>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label>Personal Interest</label>
                                <textarea class="form-control" rows="2" name="company_personal_interest[]">{{ Session::get('company_personal_interest')[$key] }}</textarea>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label>Company Profile</label>
                                <textarea class="form-control" rows="2" name="company_profile[]">{{ Session::get('company_profile')[$key] }}</textarea>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label>Company Product and Service</label>
                                <textarea class="form-control" rows="2" name="company_product_and_service[]">{{ Session::get('company_product_and_service')[$key] }}</textarea>
                            </div>
                            <div class="col-sm-12 col-md-12 mb-3">
                                <label>Full Address</label>
                                <textarea class="form-control" rows="2" name="company_full_address[]">{{ Session::get('company_full_address')[$key] }}</textarea>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label class="navbar-brand custom-navbar-brand mb-0">Contact Info</label>
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Phone Number </label>
                                <input type="text" class="form-control" name="company_phone_number[]"
                                    value="{{ Session::get('company_phone_number')[$key] }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Email </label>
                                <input type="text" class="form-control" name="company_email[]"
                                    value="{{ Session::get('company_email')[$key] }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>What App</label>
                                <input type="text" class="form-control" name="company_what_app[]"
                                    placeholder="855XXXXXXXXXX"
                                    value="{{ Session::get('company_what_app')[$key] }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Telegram</label>
                                <input type="text" class="form-control" name="company_telegram[]"
                                    placeholder="username" value="{{ Session::get('company_telegram')[$key] }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Messenger</label>
                                <input type="text" class="form-control" name="company_messenger[]"
                                    value="{{ Session::get('company_messenger')[$key] }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Skype</label>
                                <input type="text" class="form-control" name="company_skype[]"
                                    value="{{ Session::get('company_skype')[$key] }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>We Chat</label>
                                <input type="text" class="form-control" name="company_we_chat[]"
                                    value="{{ Session::get('company_we_chat')[$key] }}" />
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label class="navbar-brand custom-navbar-brand mb-0">Social Link</label>
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Website</label>
                                <input type="text" class="form-control" name="company_website[]"
                                    placeholder="http://www.yourdomain.com"
                                    value="{{ Session::get('company_website')[$key] }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Facebook</label>
                                <input type="text" class="form-control" name="company_facebook[]"
                                    placeholder="https://www.fb.com/username"
                                    value="{{ Session::get('company_facebook')[$key] }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Linkedin</label>
                                <input type="text" class="form-control" name="company_linkedin[]"
                                    placeholder="https://www.linkedin.com/in/username"
                                    value="{{ Session::get('company_linkedin')[$key] }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label>Twitter</label>
                                <input type="text" class="form-control" name="company_twitter[]"
                                    placeholder="https://twitter.com/username"
                                    value="{{ Session::get('company_twitter')[$key] }}" />
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endif
    @if ((!empty($entry) && empty($isEditAndHasCompany)) || (empty($entry) && empty(Session::getOldInput())))
        <div class="row company-repeatable-element repeatable-element mt-3">
            <button type="button" class="close company-delete-element delete-element"><span
                    aria-hidden="true">×</span></button>
            <div class="col-sm-12 col-md-12 mt-2 mb-3 company-repeatable-element">
                <div class="row">
                    <input type="hidden" name="company_in[]" />
                    <div class="form-group col-md-12 col-12">
                        <label class="navbar-brand custom-navbar-brand mb-0">Company Info</label>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Name In English</label>
                        <input type="text" class="form-control" name="company_english_name[]" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Name In Khmer</label>
                        <input type="text" class="form-control" name="company_khmer_name[]" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Tax Identification Number (TIN)</label>
                        <input type="text" class="form-control" name="tax_identification_number[]" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Registered Date</label>
                        <input type="date" class="form-control" name="registered_date[]" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Major of Business</label>
                        <select name="company_major_of_business[]" class="form-control major-of-business">
                            <option value="" disabled selected>Select major of business</option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Position</label>
                        <input type="text" class="form-control" name="company_position[]" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Legal Status</label>
                        <select name="company_legal_status[]" class="form-control legal-status">
                            <option value="" disabled selected>Select legal status</option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Registered Business</label>
                        <select name="company_registered_business[]" class="form-control registered-business">
                            <option value="" disabled selected>Select registered business</option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Company Size</label>
                        <input type="text" class="form-control" name="company_size[]" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Number of Branche</label>
                        <input type="text" class="form-control" name="company_number_of_branch[]" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Business Model</label>
                        <select name="company_business_model[]" class="form-control business-model">
                            <option value="" disabled selected>Select business model</option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Capital Investment [Range]</label>
                        <input type="text" class="form-control" name="company_capital_investment[]" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Year Founded</label>
                        <input type="text" class="form-control" name="company_year_founded[]" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label style="width: 100%;">is Primary?</label>
                        <select class="form-control" name="company_is_primary[]">
                            <option value="1" selected>Yes</option>
                            <option value="0"> No</option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3 wrap-company-diagnostic-report">
                        <label>Company Diagnostic Report</label>
                        <img src="" style="width: 200px; margin-bottom: 10px;" alt="" />
                        <input type="file" class="form-control company-diagnostic-report"
                            name="company_diagnostic_report[]" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3 wrap-company-milestone">
                        <label>Company's Milestones</label>
                        <img src="" style="width: 200px; margin-bottom: 10px;" alt="" />
                        <input type="file" class="form-control company-milestone" name="company_milestones[]" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3 wrap-company-logo">
                        <label style="width: 100%;">Company's Logo (size: 1396px * 667px)</label>
                        <input type="file" class="form-control company-logo" name="company_logo[]" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3 wrap-service-image">
                        <label style="width: 100%;">Service images (size: 1396px * 667px)</label>
                        <input type="file" class="form-control service-image" multiple />
                        <textarea name="service_images[]" class="hiddend-textarea" style="display: none;"></textarea>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Company Slogan</label>
                        <textarea class="form-control" rows="2" name="company_slogan[]"></textarea>
                    </div>
                    <div class="col-sm-12 col-md-6 mb-3">
                        <label>Personal Interest</label>
                        <textarea class="form-control" rows="2" name="company_personal_interest[]"></textarea>
                    </div>
                    <div class="col-sm-12 col-md-6 mb-3">
                        <label>Company Profile</label>
                        <textarea class="form-control" rows="2" name="company_profile[]"></textarea>
                    </div>
                    <div class="col-sm-12 col-md-6 mb-3">
                        <label>Company Product and Service</label>
                        <textarea class="form-control" rows="2" name="company_product_and_service[]"></textarea>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label>Full Address</label>
                        <textarea class="form-control" rows="2" name="company_full_address[]"></textarea>
                    </div>
                    <div class="form-group col-md-12 col-12">
                        <label class="navbar-brand custom-navbar-brand mb-0">Contact Info</label>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Phone Number </label>
                        <input type="text" class="form-control" name="company_phone_number[]" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Email </label>
                        <input type="text" class="form-control" name="company_email[]" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>What App</label>
                        <input type="text" class="form-control" name="company_what_app[]"
                            placeholder="855XXXXXXXXXX" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Telegram</label>
                        <input type="text" class="form-control" name="company_telegram[]"
                            placeholder="username" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Messenger</label>
                        <input type="text" class="form-control" name="company_messenger[]" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Skype</label>
                        <input type="text" class="form-control" name="company_skype[]" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>We Chat</label>
                        <input type="text" class="form-control" name="company_we_chat[]" />
                    </div>
                    <div class="form-group col-md-12 col-12">
                        <label class="navbar-brand custom-navbar-brand mb-0">Social Link</label>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Website</label>
                        <input type="text" class="form-control" name="company_website[]"
                            placeholder="http://www.yourdomain.com" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Facebook</label>
                        <input type="text" class="form-control" name="company_facebook[]"
                            placeholder="https://www.fb.com/username" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Linkedin</label>
                        <input type="text" class="form-control" name="company_linkedin[]"
                            placeholder="https://www.linkedin.com/in/username" />
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label>Twitter</label>
                        <input type="text" class="form-control" name="company_twitter[]"
                            placeholder="https://twitter.com/username" />
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
<div class="form-group col-md-12">
    <button type="button" class="btn btn-success btn-sm ml-1 add-repeatable-element-button"
        id="company-add-repeatable-element-button">+ Add New</button>
</div>

{{-- push things in the after_styles section --}}

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

{{-- FIELD EXTRA JS --}}
{{-- push things in the after_scripts section --}}

@push('after_scripts')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        function readURL(input, wrap) {
            var imgs = wrap.find('img');
            console.log(wrap.find('img'));
            imgs.remove();
            myObj = input.files;
            var array = $.map(myObj, function(value, index) {
                return [value];
            });
            if ($.isArray(array)) {
                $.each(array, function(index, file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        wrap.append('<img src="' + e.target.result +
                            '" style="margin-top: 10px; margin-right: 5px; border-radius: 5px; height: 70px; border: 3px solid #dce1ea;" alt=""/>'
                        );
                    }
                    reader.readAsDataURL(input.files[index]); // convert to base64 string
                });
            }
        }
        $(function() {
            var fetchMajorOfBusiness = function() {
                axios.get('{{ URL('admin/fetch-company-option') }}', {
                    params: {
                        major_of_business: 'major-of-business'
                    }
                }).then(function(response) {
                    var object = response.data;
                    $('.major-of-business').each(function(index) {
                        $.each(object, function(ind, row) {
                            if ($('.major-of-business:eq(' + index +
                                    ') option[value="' + row.id + '"]').length == 0) {
                                var option = '<option value="' + row.id + '">' + row
                                    .display + '</option>';
                                $('.major-of-business').eq(index).append(option);
                            }
                        });
                    });
                })
            };
            var fetchLegalStatus = function() {
                axios.get('{{ URL('admin/fetch-company-option') }}', {
                    params: {
                        legal_status: 'legal-status'
                    }
                }).then(function(response) {
                    var object = response.data;
                    $('.legal-status').each(function(index) {
                        $.each(object, function(ind, row) {
                            if ($('.legal-status:eq(' + index + ') option[value="' + row
                                    .id + '"]').length == 0) {
                                var option = '<option value="' + row.id + '">' + row
                                    .display + '</option>';
                                $('.legal-status').eq(index).append(option);
                            }
                        });
                    });
                })
            };
            var fetchRegisteredBusiness = function() {
                axios.get('{{ URL('admin/fetch-company-option') }}', {
                    params: {
                        registered_business: 'registered-business'
                    }
                }).then(function(response) {
                    var object = response.data;
                    $('.registered-business').each(function(index) {
                        $.each(object, function(ind, row) {
                            if ($('.registered-business:eq(' + index +
                                    ') option[value="' + row.id + '"]').length == 0) {
                                var option = '<option value="' + row.id + '">' + row
                                    .display + '</option>';
                                $('.registered-business').eq(index).append(option);
                            }
                        });
                    });
                })
            };
            var fetchBusinessModel = function() {
                axios.get('{{ URL('admin/fetch-company-option') }}', {
                    params: {
                        business_model: 'business-model'
                    }
                }).then(function(response) {
                    var object = response.data;
                    $('.business-model').each(function(index) {
                        $.each(object, function(ind, row) {
                            if ($('.business-model:eq(' + index + ') option[value="' +
                                    row.id + '"]').length == 0) {
                                var option = '<option value="' + row.id + '">' + row
                                    .display + '</option>';
                                $('.business-model').eq(index).append(option);
                            }
                        });
                    });
                })
            };

            fetchMajorOfBusiness();
            fetchLegalStatus();
            fetchRegisteredBusiness();
            fetchBusinessModel();

            $('body').on('click', '.company-delete-element', function() {
                if ($('.company-repeatable-element').length > 2) {
                    $(this).closest('.company-repeatable-element').remove();
                }
            });
            $('body').on('change', '.company-logo', function() {
                var wrap = $(this).closest('.wrap-company-logo');
                readURL(this, wrap);
            });
            $('body').on('change', '.company-milestone', function() {
                var image = $(this).closest('.wrap-company-milestone').find('img');
                readURL(this, image);
            });
            $('body').on('change', '.company-diagnostic-report', function() {
                var image = $(this).closest('.wrap-company-diagnostic-report').find('img');
                readURL(this, image);
            });
            $('body').on('change', '.service-image', function(e) {
                var images = new Array();
                const files = e.target.files;
                var index = $(".service-image").index($(this));
                $.each(files, function(idx, file) {
                    var reader = new FileReader();
                    reader.onloadend = () => {
                        images.push(reader.result);
                        document.getElementsByClassName('hiddend-textarea')[index].value = JSON
                            .stringify(images);
                    };
                    reader.readAsDataURL(file);
                });

                var wrap = $(this).closest('.wrap-service-image');
                readURL(this, wrap);

            });

            $('body').on('click', '#company-add-repeatable-element-button', function() {
                $('.company-repeatable-element:first').clone().appendTo(
                    '#company-container-repeatable-elements');
                var lastRepeatableElement = $('.company-repeatable-element:last');
                var input = lastRepeatableElement.find('input');
                var textarea = lastRepeatableElement.find('textarea');
                var select = lastRepeatableElement.find('select');
                var image = lastRepeatableElement.find('img');
                var compoanyDistric = lastRepeatableElement.find('.compoany-distric');
                var companyCommune = lastRepeatableElement.find('.company-commune');
                var companyVillage = lastRepeatableElement.find('.company-village');
                input.val('');
                textarea.val('');
                image.attr('src', '');
                compoanyDistric.html('');
                companyCommune.html('');
                companyVillage.html('');
                select.prop('selectedIndex', 0);
            });
            $('body').on('click', 'input[type="checkbox"]', function() {
                if ($(this).is(':checked')) {
                    $(this).val('on');
                } else {
                    $(this).val('off');
                }
            });
        });
    </script>
@endpush

{{-- Note: most of the times you'll want to use @if ($crud->checkIfFieldIsFirstOfItsType($field, $fields)) to only load CSS/JS once, even though there are multiple instances of it. --}}
