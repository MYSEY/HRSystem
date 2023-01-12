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
              <td class="border-0">:&nbsp;&nbsp;{{ $entry->date_of_birth ? date('d-m-Y', strtotime($entry->date_of_birth)) : '' }}</td>
            </tr>
            <tr>
              <th scope="row" class="border-0 bg-transparent" width="200">Position</th>
              <td class="border-0">:&nbsp;&nbsp;{{ $entry->position ? : '' }}</td>
            </tr>
            <tr>
              <th scope="row" class="border-0 bg-transparent" width="200">Department</th>
              <td class="border-0">:&nbsp;&nbsp;{{ optional($entry->department)->name }}</td>
            </tr>
            <tr>
              <th scope="row" class="border-0 bg-transparent" width="200">Identity Type</th>
              <td class="border-0">:&nbsp;&nbsp;{{ $entry->identity_type}} </td>
            </tr>
            <tr>
              <th scope="row" class="border-0 bg-transparent" width="200">Identity Number</th>
              <td class="border-0">:&nbsp;&nbsp;{{ $entry->identity_number ? : '' }}</td>
          </tr>
          <tr>
              <th scope="row" class="border-0 bg-transparent" width="200">Issue Date</th>
              <td class="border-0">:&nbsp;&nbsp;{{ $entry->issue_date ? date('d-m-Y', strtotime($entry->issue_date)) : '' }}</td>
          </tr>
          <tr>
            <th scope="row" class="border-0 bg-transparent" width="200">Address</th>
            <td class="border-0">:&nbsp;&nbsp;{{$entry->FullAddressKh}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>