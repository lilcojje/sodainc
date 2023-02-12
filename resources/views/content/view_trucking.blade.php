<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>{{$title}}</h2>
                <div class="d-flex flex-row-reverse"><button
                        class="btn btn-sm btn-pill btn-outline-primary font-weight-bolder" id="createNewTrucking"><i
                            class="fas fa-plus"></i>add data </button></div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id="tableUser">
                            <thead class="font-weight-bold text-center">
                                <tr>
                                    {{-- <th>No.</th> --}}
                                    <th>Trucking ID</th>
                                    <th>Trucking Name</th>
                                    <th>Vehicle Plate</th>
									<th>Contact Person</th>
									<th>Contact Number</th>
                                    <th style="width:90px;">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                {{-- @foreach ($trucking as $r_truckings)
                                    <tr>
                                <td>{{$r_truckings->trucking_id}}</td>
                                <td>{{$r_truckings->trucking_name}}</td>
                                <td>{{$r_truckings->vehicle_plate}}</td>
                                <td>{{$r_truckings->contact_person}}</td>
								<td>{{$r_truckings->contact_number}}</td>
                                <td>
                                    <div class="btn btn-success editTrucking" data-id="{{$r_truckings->id}}">Edit</div>
                                    <div class="btn btn-danger deleteTrucking" data-id="{{$r_truckings->id}}">Delete</div>
                                </td>
                                </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal-->
<div class="modal fade" id="modal-trucking" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Trucking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTrucking" name="formTrucking">
                    <div class="form-group">
						<label>Trucking Name</label>
                        <input type="text" name="trucking_name" class="form-control" id="trucking_name" required><br>
						<label>Vehicle Plate</label>
						<input type="text" name="vehicle_plate" class="form-control" id="vehicle_plate" required><br>
						<label>Contact Person</label>
						<input type="text" name="contact_person" class="form-control" id="contact_person" required><br>
						<label>Contact Number</label>
						<input type="text" name="contact_number" class="form-control" id="contact_number" required><br>
                        <input type="hidden" name="trucking_id" id="trucking_id" value="">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="saveBtn">Save changes</button>
            </div>
        </div>
    </div>
</div>



@push('scripts')
<script>
    $('document').ready(function () {
        // success alert
        function swal_success() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1000
            })
        }
        // error alert
        function swal_error() {
            Swal.fire({
                position: 'centered',
                icon: 'error',
                title: 'Something goes wrong !',
                showConfirmButton: true,
            })
        }
        // table serverside
        var table = $('#tableUser').DataTable({
            processing: false,
            serverSide: true,
			"bSort" : true,
            dom: 'Bfrtip',
			order: [[1, 'asc']],
            buttons: [
             
            ],
            ajax: "{{ route('get.trucking') }}",
            columns: [{
                    data: 'trucking_id',
					orderable: false,
                    name: 'trucking_id'
                },
                {
                    data: 'trucking_name',
                    name: 'trucking_name'
                },
                {
                    data: 'vehicle_plate',
					orderable: false,
                    name: 'vehicle_plate'
                },
				 {
                    data: 'contact_person',
					orderable: false,
                    name: 'contact_person'
                },
				{
                    data: 'contact_number',
					orderable: false,
                    name: 'contact_number'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        
        // csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // initialize btn add
        $('#createNewTrucking').click(function () {
            $('#saveBtn').val("create Trucking");
            $('#trucking_id').val('');
            $('#formTrucking').trigger("reset");
            $('#modal-trucking').modal('show');
        });
        // initialize btn edit
        $('body').on('click', '.editTrucking', function () {
            var trucking_id = $(this).data('id');
            $.get("{{route('trucking.index')}}" + '/' + trucking_id + '/edit', function (data) {
                $('#saveBtn').val("edit-Trucking");
                $('#modal-trucking').modal('show');
                $('#trucking_id').val(data.trucking_id);
                $('#trucking_name').val(data.trucking_name);
                $('#vehicle_plate').val(data.vehicle_plate);
                $('#contact_person').val(data.contact_person);
				$('#contact_number').val(data.contact_number);
            })
        });
        // initialize btn save
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Save');
			
			if($('#formTrucking').valid()){
				$.ajax({
					data: $('#formTrucking').serialize(),
					url: "{{ route('trucking.store') }}",
					type: "POST",
					dataType: 'json',
					success: function (data) {

						$('#formTrucking').trigger("reset");
						$('#modal-trucking').modal('hide');
						swal_success();
						table.draw();

					},
					error: function (data) {
						swal_error();
						$('#saveBtn').html('Save Changes');
					}
				});
			}

        });
        // initialize btn delete
        $('body').on('click', '.deleteTrucking', function () {
            var trucking_id = $(this).data("id");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{route('trucking.store')}}" + '/' + trucking_id,
                        success: function (data) {
                            swal_success();
                            table.draw();
                        },
                        error: function (data) {
                            swal_error();
                        }
                    });
                }
            })
        });

        // statusing
		
		


    });
	
	
	FormValidation.formValidation(
			 document.getElementById('formTrucking'),
			 {
			  fields: {

			   vehicle_plate: {
				validators: {
				 notEmpty: {
				  message: 'Please enter trucking name'
				 }
				}
			   },

			  
			  },

			  plugins: {
			   trigger: new FormValidation.plugins.Trigger(),
			   // Bootstrap Framework Integration
			   bootstrap: new FormValidation.plugins.Bootstrap(),
			   // Validate fields when clicking the Submit button
			   submitButton: new FormValidation.plugins.SubmitButton(),
						// Submit the form when all fields are valid
			   defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
			  }
			 }
			);

</script>
@endpush
