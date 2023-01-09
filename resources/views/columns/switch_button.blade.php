<div class="switches">
	<input onclick="toggleUser(this)" data-button-type="toggle-user" type="checkbox" @if($entry->active) checked @endif id="{{ $entry->id }}" class="switche{{ $entry->id }}">
	<label for="{{ $entry->id }}"><span></span></label>
</div>

<style>
	:root {
	--white: #e8e9ed;
	--gray: #434257;
	--blue: #18172c;
	--green: #00d084;
	--pink: #ff4b77;
	}
	.switches label {
		cursor: pointer;
	}
	.switches [type="checkbox"] {
		position: absolute;
		left: -9999px;
	}
	.switches label {
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 0px;
	}
	.switches span:last-child {
		position: relative;
		width: 55px;
		height: 27px;
		border-radius: 15px;
		box-shadow: inset 0 0 5px rgb(0 0 0 / 6%);
		background: #0000003b;
		transition: all 0.3s;
	}
	.switches span:last-child::before,
	.switches span:last-child::after {
		content: "";
		position: absolute;
	}
	.switches span:last-child::before {
		left: 4px;
		top: 2px;
		width: 22px;
		height: 22px;
		background: var(--white);
		border-radius: 50%;
		z-index: 1;
		transition: transform 0.3s;
	}
	.switches span:last-child::after {
		top: 50%;
		right: 8px;
		width: 12px;
		height: 12px;
		transform: translateY(-50%);
		background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/uncheck-switcher.svg);
		background-size: 12px 12px;
	}
	.switches [type="checkbox"]:checked + label span:last-child {
		background: var(--green);
	}
	.switches [type="checkbox"]:checked + label span:last-child::before {
		transform: translateX(24px);
	}
	.switches [type="checkbox"]:checked + label span:last-child::after {
		width: 14px;
		height: 14px;
		/*right: auto;*/
		left: 8px;
		background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/checkmark-switcher.svg);
		background-size: 14px 14px;
	}
</style>

@push('after_scripts') @if (request()->ajax()) @endpush @endif
<script>

	if (typeof toggleUser != 'function') {
	  	$("[data-button-type=toggle-user]").unbind('click'); 

	  	function toggleUser(button) {
			var button = $(button);
			var userId = button.attr('id');

			if ($('.switche'+userId).is(':checked')) {
				var textMessage = "Confirm Activate User";
			} else {
				var textMessage = "Confirm Inactive User";
			}

			swal({
				title: "Confirmation",
				text: textMessage,
				icon: "warning",
				buttons: {
					cancel: {
						text: "cancel",
						value: null,
						visible: true,
						className: "bg-secondary",
						closeModal: true,
					},
					restore: {
						text: "Yes",
						value: true,
						visible: true,
						className: "bg-success",
					}
				},
			})
			.then((value) => {
				if (value) {
					$.ajax({
						url: "{{ URL('admin/user/fetch/toggle') }}",
						type: 'POST',
						data: {
							id: userId
						},
						success: function(result) {
							new Noty({
								type: "success",
								text: "Message Succeeded"
							}).show();
						},
						error: function(result) {
							swal({
								title: "Error",
								text: "Message Failed",
								icon: "error",
								timer: 4000,
								buttons: false,
							});
						}
					});
				}else{
					if ($('.switche'+userId).is(':checked')) {
						$('.switche'+userId).prop('checked', false)
					} else {
						$('.switche'+userId).prop('checked', true)
					}
				}
			});
      	}
	}
</script>
@if (!request()->ajax()) @endpush @endif