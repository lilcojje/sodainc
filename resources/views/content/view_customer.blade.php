<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>{{$title}}</h2>
                <div class="d-flex flex-row-reverse"><button
                        class="btn btn-sm btn-pill btn-outline-primary font-weight-bolder" id="createNewCustomer"><i
                            class="fas fa-plus"></i>add data </button></div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id="tableCustomer">
                            <thead class="font-weight-bold text-center">
                                <tr>
                                    {{-- <th>No.</th> --}}
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Contact Number</th>
									<th>Address</th>
                                    <th style="width:150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                {{-- @foreach ($customer as $r_customers)
                                    <tr>
                                <td>{{$r_customers->customer_id}}</td>
                                <td>{{$r_customers->customer_name}}</td>
                                <td>{{$r_customers->contact_number}}</td>
                                <td>{{$r_customers->address}}</td>
                                <td>
                                    <div class="btn btn-success editCustomer" data-id="{{$r_customers->id}}">Edit</div>
                                    <div class="btn btn-danger deleteCustomer" data-id="{{$r_customers->id}}">Delete</div>
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
<div class="modal fade" id="modal-customer" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCustomer" name="formCustomer">
                    <div class="form-group">
						<label>Customer Name</label>
                        <input type="text" name="customer_name" class="form-control" id="customer_name" required><br>
						<label>Contact Number</label>
						<input type="text" name="contact_number" class="form-control" id="contact_number" required><br>
						<label>Address</label>
						<input type="text" name="address" class="form-control" id="address" required><br>
						<input type="hidden" name="customer_id" id="customer_id" value="">
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


<!-- Modal-->
<div class="modal fade" id="modal-view-customer" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
				
				<div class="card card-custom gutter-b">
						 <div class="card-header">
						  <div class="card-title">
						   <h3 class="card-label">
							Information
						   </h3>
						  </div>
						 </div>
						 <div class="card-body">
							<strong>Customer ID:</strong> <span id="info_id"></span></br>
							<strong>Name:</strong> <span id="info_name"></span></br>
							<strong>Address:</strong> <span id="info_address"></span></br>
							<strong>Contact #:</strong> <span id="info_contact"></span></br>
						 </div>
						</div>
              
				
				<div class="card card-custom gutter-b">
						 <div class="card-header">
						  <div class="card-title">
						   <h3 class="card-label">
							Orders
						   </h3>
						  </div>
						 </div>
						 <div class="card-body">
							<table class="table">
								<thead>
									<tr>
										<th scope="col">Batch #</th>
										<th scope="col">DR #</th>
										<th scope="col">Date</th>
										<th scope="col">Total</th>
										<th scope="col"></th>
									</tr>
								</thead>
								<tbody id="order-data">
									
								
								</tbody>
							</table>
						 </div>
						</div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal-->
<div class="modal fade" id="modal-view-order" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
				<h5>Order Number: <span id="order-number"></span></h5>
				<div class="card card-custom gutter-b">
						 <div class="card-header">
						  <div class="card-title">
						   <h3 class="card-label">
							Variety
						   </h3>
						  </div>
						 </div>
						 <div class="card-body">
							<ul class="variety-list">
							</ul>
						 </div>
				</div>
				<div class="card card-custom gutter-b">
						 <div class="card-header">
						  <div class="card-title">
						   <h3 class="card-label">
							KG
						   </h3>
						  </div>
						 </div>
						 <div class="card-body">
							<ul class="kg-list">
							</ul>
						 </div>
				</div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
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
        var table = $('#tableCustomer').DataTable({
            processing: false,
            serverSide: true,
            dom: 'Bfrtip',
			"bSort" : true,
			order: [[1, 'asc']],
            buttons: [
             
            ],
            ajax:"{{ route('get.customer') }}",
            columns: [{
                    data: 'customer_id',
					orderable: false,
                    name: 'customer_id'
                },
                {
                    data: 'customer_name',
                    name: 'customer_name'
                },
                {
                    data: 'contact_number',
					orderable: false,
                    name: 'contact_number'
                },
				 {
                    data: 'address',
					orderable: false,
                    name: 'address'
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
        $('#createNewCustomer').click(function () {
            $('#saveBtn').val("create customer");
            $('#customer_id').val('');
            $('#formUser').trigger("reset");
            $('#modal-customer').modal('show');
        });
		
		// initialize btn view
        $('body').on('click', '.viewCustomer', function () {
			
			jQuery('#order-data').html('');
			
            var customer_id = $(this).data('id');
            $.get("{{route('customer.index')}}" + '/' + customer_id + '/edit', function (data) {
                $('#saveBtn').val("edit-customer");
                $('#modal-view-customer').modal('show');
				$('#info_id').text(data.customer_id);
                $('#info_name').text(data.customer_name);
                $('#info_address').text(data.address);
                $('#info_contact').text(data.contact_number);
            });
			
			$.ajax({
				type: 'POST',
				url: "{{route('customer.order')}}",
				data: 'customer_id=' + customer_id,
				success: function(data) {
					
					
					
					$.each(data, function(index) {
						var order_data = '' + 
									'<tr>' + 
									'										<th scope="row">'+data[index].batch_order+'</th>' + 
									'										<td>'+data[index].dr_number+'</td>' + 
									'										<td>'+data[index].order_date+'</td>' + 
									'										<td>PHP '+parseInt(data[index].total).toLocaleString()+'</td>' + 
									'										<td>' + 
									'											<span class="label label-inline label-light-primary font-weight-bold view-order" data-id="'+data[index].order_id+'">' + 
									'												VIew Order' + 
									'											</span>' + 
									'										</td>' + 
									'									</tr>' + 
									'';
									
							jQuery('#order-data').append(order_data);

					});
				}
			});
        });
		
        // initialize btn edit
        $('body').on('click', '.editCustomer', function () {
            var customer_id = $(this).data('id');
            $.get("{{route('customer.index')}}" + '/' + customer_id + '/edit', function (data) {
                $('#saveBtn').val("edit-user");
                $('#modal-customer').modal('show');
                $('#customer_id').val(data.customer_id);
                $('#customer_name').val(data.customer_name);
				$('#contact_number').val(data.contact_number);
				$('#address').val(data.address);
				$('#customer_id').val(data.customer_id);
				
            })
        });
		
		
        // initialize btn save
        $('#saveBtn').click(function (e) {
			
            e.preventDefault();
            $(this).html('Save');

            if($('#formCustomer').valid()){
				$.ajax({
					data: $('#formCustomer').serialize(),
					url: "{{ route('customer.store') }}",
					type: "POST",
					dataType: 'json',
					success: function (data) {

						$('#formCustomer').trigger("reset");
						$('#modal-customer').modal('hide');
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
        $('body').on('click', '.deleteCustomer', function () {
            var customer_id = $(this).data("id");

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
                        url: "{{route('customer.store')}}" + '/' + customer_id,
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
		
		// initialize btn view order
        $('body').on('click', '.view-order', function () {
            var id = $(this).data("id");
			$('#modal-view-customer').modal('hide');
			
			jQuery('.variety-list').html('');
			jQuery('.kg-list').html('');
			
			$.ajax({
				type: 'POST',
				url: "{{route('view.order')}}",
				data: 'order_id=' + id,
				success: function(data) {
					
					$('#modal-view-order').modal('show');
					$('#order-number').text(id);
					var variety_data = JSON.parse(data.variety);
					var kg_data = JSON.parse(data.kg);
					
					$.each( variety_data, function(index) {
						var order_variety = '<li>' + variety_data[index] + '</li>';
							jQuery('.variety-list').append(order_variety);

					});
					
					$.each( kg_data, function(index) {
						var order_kg = '<li>' + kg_data[index] + '</li>';
							jQuery('.kg-list').append(order_kg);

					});
					
					
				}
			});
			
			
			
        });
		

    });
	
	
	
	

</script>
@endpush
