@section('paScript')
	<script>
		$(document).ready(function() {
			$('#projects-approval').DataTable({
				pageLength: 5,
				lengthMenu: [
					[5, 10, 20],
					[5, 10, 20]
				],
				ordering: false,
			});

		});

		// Reject Project
		function rejectProj(id) {
			let idx = id.getAttribute("data-id");
			Swal.fire({
				title: 'Reject this project',
				text: "Are you sure about this?",
				icon: 'error',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: "rejectProjet/" + idx,
						method: "POST",
						data: {
							idx: idx
						},
						headers: {
							'X-CSRF-TOKEN': '{{ csrf_token() }}'
						},
						success: function(data) {
							swal.fire(
								'Rejected!',
								'Project has been rejected!',
								'success'
							).then(function() {
								var newlabel = document.createElement("Label");
								newlabel.setAttribute("class", "badge badge-danger");
								newlabel.innerHTML = "Rejected";
								// Append new label
								document.querySelector('#tdApprovalId' + idx).appendChild(
									newlabel);
								// Remove Elements
								document.querySelector('#approvalStatus' + idx).remove();
								document.querySelector('#reject' + idx).remove();
								document.querySelector('#approved' + idx).remove();
								document.querySelector('#buyOut' + idx).remove();


							});
						}
					})
				} else if (
					result.dismiss === Swal.DismissReason.cancel
				) {
					swal.fire(
						'Cancelled',
						'Project is safe',
						'error'
					)
				}
			})
		}
		$(document).on("click", ".approveBtn", function() {
			var idx = $(this).data('id');
			console.log(idx);
			$(".modal-footer data-id").val(idx.id);

		});

		function getRow(idx) {
			let rowId = idx.getAttribute("data-id");

			let inputHidden = document.getElementById('row').value = rowId;

			//   modalBtn.onclick = function() {
			//    let x = document.getElementById('appBtn');
			//    x.setAttribute('data-id', rowId);
			//    let y = document.getElementById('remarks').value;
			//    if (y === null || y === "") {
			//     alert('Remarks is Required');
			//    } else {
			//     approveProj(x, y);
			//    }
			//   }
		}

		function forBuyOut(id) {

			let idx = id.getAttribute("data-id");
			console.log(idx);
			Swal.fire({
				title: 'Buyout this project',
				text: "Are you sure about this?",
				icon: 'success',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: "buyOutProject/" + idx,
						method: "POST",
						data: {
							idx: idx
						},
						headers: {
							'X-CSRF-TOKEN': '{{ csrf_token() }}'
						},
						success: function(data) {
							swal.fire(
								'For Buyout!',
								'Status Successfully Changed to "Buyout"',
								'success'
							).then(function() {
								var newlabel = document.createElement("Label");
								newlabel.setAttribute("class", "badge badge-primary");
								newlabel.innerHTML = "Buyout";

								// Append new label
								document.querySelector('#tdApprovalId' + idx).appendChild(
									newlabel);
								// document.querySelector('#project' + idx).remove();

								// Remove Elements
								console.log("IDIDIDID: " + idx);
								document.querySelector('#approvalStatus' + idx).remove();
								// document.querySelector('#approved' + idx).remove();
								document.getElementById('reject' + idx).remove();
								document.getElementById('buyOut' + idx).remove();
								// document.querySelecxtor('#buyOut' + idx).remove();


							});
						}
					})
				} else if (
					result.dismiss === Swal.DismissReason.cancel
				) {
					swal.fire(
						'Cancelled',
						'Project is safe',
						'error'
					)
				}
			})
		}
	</script>
@endsection
