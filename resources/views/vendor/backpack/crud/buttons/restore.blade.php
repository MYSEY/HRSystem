<a href="javascript:void(0)" onclick="restoreEntry(this)" data-route="{{ url($crud->route.'/'.$entry->getKey().'/restore') }}" class="btn btn-sm btn-warning" data-button-type="restore" data-toggle="tooltip" title="{{__('flexi_crud.restore')}}"><i class="la la-undo-alt"></i></a>

{{-- Button Javascript --}}
{{-- - used right away in AJAX operations (ex: List) --}}
{{-- - pushed to the end of the page, after jQuery is loaded, for non-AJAX operations (ex: Show) --}}
@push('after_scripts') @if (request()->ajax()) @endpush @endif
<script>

	if (typeof restoreEntry != 'function') {
	  $("[data-button-type=restore]").unbind('click'); 

	  function restoreEntry(button) {
		// ask for confirmation before deleting an item
		// e.preventDefault();
		var button = $(button);
		var route = button.attr('data-route');
		var row = $("#crudTable a[data-route='"+route+"']").closest('tr');

		swal({
		  title: "{!! trans('flexi_crud.restore_warning') !!}",
		  text: "{!! trans('flexi_crud.restore_confirm') !!}",
		  icon: "warning",
		  buttons: {
		  	cancel: {
			  text: "{!! trans('flexi_crud.cancel') !!}",
			  value: null,
			  visible: true,
			  className: "bg-secondary",
			  closeModal: true,
			},
		  	restore: {
			  text: "{!! trans('flexi_crud.restore') !!}",
			  value: true,
			  visible: true,
			  className: "bg-success",
			}
		  },
		})
        .then((value) => {
			if (value) {
				$.ajax({
			        url: route,
			        type: 'GET',
			        success: function(result) {
			            if (result == 1) {
			          	    // Show a success notification bubble
			                new Noty({
		                        type: "success",
		                        text: "{!! trans('flexi_crud.restore_confirmation_message') !!}"
		                    }).show();
			                // Hide the modal, if any
			                $('.modal').modal('hide');
                            // RELOAD DATA 
                            crud.table.ajax.reload();
			            }
			        },
			        error: function(result) {
			            // Show an alert with the result
			            swal({
		              	    title: "{!! trans('flexi_crud.restore_confirmation_not_title') !!}",
                            text: "{!! trans('flexi_crud.restore_confirmation_not_message') !!}",
		              	    icon: "error",
		              	    timer: 4000,
		              	    buttons: false,
		                });
			        }
			    });
			}
		});

      }
	}

	// make it so that the function above is run after each DataTable draw event
	// crud.addFunctionToDataTablesDrawEventQueue('deleteEntry');
</script>
@if (!request()->ajax()) @endpush @endif
