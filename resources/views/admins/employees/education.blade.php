
@if (!empty($entry) && !empty($entry->educations))
    @if (count($entry->educations))
        @foreach ($entry->educations as $key => $education)
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <label class="custom-navbar-brand mb-0">Education</label>
                        </tr>
                        <tr>
                            <td scope="row" class="border-0 font-weight-bold" width="20%">School</td>
                            <td class="border-0" width="5%">:</td>
                            <td class="border-0" width="25%">{{ $education->school }}</td>
                            <td scope="row" class="border-0 font-weight-bold" width="20%">Degree</td>
                            <td class="border-0" width="5%">:</td>
                            <td class="border-0" width="25%">{{ $education->Edcutiondegree ?? '' }}</td>
                        </tr>
                        <tr>
                            <td scope="row" class="border-0 font-weight-bold">Field Of Study</td>
                            <td class="border-0">:</td>
                            <td class="border-0">
                                {{ $education->EdcutionFieldOfStudy ?? '' }}</td>
                            <td scope="row" class="border-0 font-weight-bold">Start Date</td>
                            <td class="border-0">:</td>
                            <td class="border-0">
                                {{ \Carbon\Carbon::parse($education->start_date)->format('d-M-Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" class="border-0 font-weight-bold">End Date</td>
                            <td class="border-0">:</td>
                            <td class="border-0">
                                {{ \Carbon\Carbon::parse($education->ent_date)->format('d-M-Y') }}
                            </td>
                            <td scope="row" class="border-0 font-weight-bold">Grade</td>
                            <td class="border-0">:</td>
                            <td class="border-0">{{ $education->grade }}</td>
                        </tr>
                        <tr>
                            <td scope="row" class="border-0 font-weight-bold">Description</td>
                            <td class="border-0">:</td>
                            <td class="border-0">{{ $education->description ?? '' }}</td>
                            <td class="border-0"></td>
                            <td class="border-0"></td>
                            <td class="border-0"></td>
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
