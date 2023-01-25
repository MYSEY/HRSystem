
@if (!empty($entry) && !empty($entry->experiences))
    @if (count($entry->experiences))
        @foreach ($entry->experiences as $key => $item)
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <label class="custom-navbar-brand mb-0">Experience</label>
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
