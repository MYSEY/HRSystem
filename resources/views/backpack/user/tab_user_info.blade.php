<div class="user-content">
  <div class="row pl-0">
    <div class="col-md-12">
      <table class="table table-striped">
        <tbody>
            <tr>
              <th scope="row" class="border-0 bg-transparent" width="200">Name</th>
              <td class="border-0">:&nbsp;&nbsp;{{ $entry->FullName ?? '' }}</td>
            </tr>
            <tr>
              <th scope="row" class="border-0 bg-transparent" width="200">Phone</th>
              <td class="border-0">:&nbsp;&nbsp;<a href="mailto:{{ $entry->phone ?? ''}}">{{ $entry->phone ?? ''}}</a></td>
            </tr>
            <tr>
              <th scope="row" class="border-0 bg-transparent" width="200">Email</th>
              <td class="border-0">:&nbsp;&nbsp;<a href="mailto:{{ $entry->email ?? ''}}">{{ $entry->email ?? ''}}</a></td>
            </tr>
            <tr>
              <th scope="row" class="border-0 bg-transparent" width="200">Date Of Birth</th>
              <td class="border-0">:&nbsp;&nbsp;{{\Carbon\Carbon::parse($entry->date_of_birth)->format('d-M-Y') }}</td>
            </tr>
            <tr>
              <th scope="row" class="border-0 bg-transparent" width="200">Position</th>
              <td class="border-0">:&nbsp;&nbsp;{{ optional($entry->position)->name_khmer ? : '' }}</td>
            </tr>
            <tr>
              <th scope="row" class="border-0 bg-transparent" width="200">Department</th>
              <td class="border-0">:&nbsp;&nbsp;{{ optional($entry->department)->name }}</td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>