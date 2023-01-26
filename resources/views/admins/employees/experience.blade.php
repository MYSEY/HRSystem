
@if (!empty($entry) && !empty($entry->experiences))
    @if (count($entry->experiences))
        @foreach ($entry->experiences as $key => $item)
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <label class="custom-navbar-brand mb-0">Experience</label>
                        </tr>
                        <tr> 
                            <td class="border-0 font-weight-bold">Title</td>
                            <td class="border-0">:</td>
                            <td class="border-0">
                                {{ $item->title ?? '' }}
                            </td>
                            <td class="border-0 font-weight-bold">Employment Type</td>
                            <td class="border-0">:</td>
                            <td class="border-0">
                                {{ $item->EmpEmploymentType ?? ''}}
                            </td>
                        </tr>
                        <tr> 
                            <td class="border-0 font-weight-bold">Company Name</td>
                            <td class="border-0">:</td>
                            <td class="border-0">
                                {{ $item->company_name ?? '' }}
                            </td>
                            <td class="border-0 font-weight-bold">Start Date</td>
                            <td class="border-0">:</td>
                            <td class="border-0">
                                {{ \Carbon\Carbon::parse($item->start_date)->format('d-M-Y') ?? ''}}
                            </td>
                        </tr>
                        <tr> 
                            <td class="border-0 font-weight-bold">End Date</td>
                            <td class="border-0">:</td>
                            <td class="border-0">
                                {{\Carbon\Carbon::parse($item->end_date)->format('d-M-Y') ?? '' }}
                            </td>
                            <td class="border-0 font-weight-bold">Location</td>
                            <td class="border-0">:</td>
                            <td class="border-0">
                                {{ $item->location ?? ''}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
    @else
        <tr>
            <td colspan="6" class="border-0 font-weight-bold">Not data to display</td>
        </tr>
    @endif
@endif
