<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>{{$title}}</h2>
                <div class="d-flex flex-row-reverse"><button
                        class="btn btn-sm btn-pill btn-outline-primary font-weight-bolder" id="createOrder"><i
                            class="fas fa-plus"></i>add data </button></div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id="tableOrder">
                            <thead class="font-weight-bold text-center">
                                <tr>
                                    {{-- <th>No.</th> --}}
                                    <th>Order ID</th>
                                    <th>DR #</th>
                                    <th>Customer Name</th>
									<th>Batch #</th>
									<th>Date</th>
									<th>Variety</th>
									<th>Quantity</th>
									<th>Total</th>
									<th>Trucking</th>
									<th>Served Status</th>
									<th>Deposit</th>
									<th>Banks</th>
									<th>Delivered</th>
									<th>Status</th>
                                    <th style="width:150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                {{-- @foreach ($order as $r_orders)
                                    <tr>
                                <td>{{$r_orders->order_id}}</td>
                                <td>{{$r_orders->dr_number}}</td>
                                <td>{{$r_orders->customer_name}}</td>
                                <td>{{$r_orders->batch_order}}</td>
								<td>{{$r_orders->order_date}}</td>
								<td>{{$r_orders->variety}}</td>
								<td>{{$r_orders->quantity}}</td>
								<td>{{$r_orders->total}}</td>
								<td>{{$r_orders->trucking_name}}</td>
								<td>{{$r_orders->served_status}}</td>
								<td>{{$r_orders->deposit}}</td>
								<td>{{$r_orders->banks}}</td>
								<td>{{$r_orders->delivered}}</td>
								<td>{{$r_orders->status}}</td>
                                <td>
                                    <div class="btn btn-success editUser" data-id="{{$r_truckings->id}}">Edit</div>
                                    <div class="btn btn-danger deleteOrder" data-id="{{$r_truckings->id}}">Delete</div>
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
<div class="modal fade" id="modal-order" data-backdrop="static" tabindex="-1" role="dialog"
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
                <form id="formOrder" name="formOrder">
                    <div class="form-group">
						<label>DR #</label>
                        <input type="text" name="dr_number" class="form-control" id="dr_number" required><br>
						<label>Customer Name</label>
						<input type="text" name="customer_name" class="form-control" id="customer_name" required>
						<small>Search Customer Name</small>
						<div id="suggesstion-customer"></div>

						<br>
						<label>Destination</label>
						<input type="text" name="destination" class="form-control" id="destination" required><br>
						<label>Trucking</label>
						<input type="text" name="trucking" class="form-control" id="trucking" required>
						<small>Search Trucking Name</small>
						<div id="suggesstion-trucking"></div>
						<br>
						<label>Order Date</label>
						<input type="date" name="order_date" class="form-control" id="order_date" required><br>
						<label for="variety">Variety</label>
						<select multiple="multiple" class="form-control" name="variety[]" id="variety" required>
							<option value="Bugas 1">Bugas 1</option>
							<option value="Bugas 2">Bugas 2</option>
							<option value="Bugas 3">Bugas 3</option>
							<option value="Bugas 4">Bugas 4</option>
							<option value="Bugas 4">Bugas 5</option>
						</select><br>
						<label for="kg">KG</label>
						<select multiple="multiple" class="form-control" name="kg[]"  id="kg" required>
							<option value="50kg">50kg</option>
							<option value="25kg">25kg</option>
							<option  value="5kg">5kg</option>
						</select><br>
						<label>Price</label>
						<input type="text" name="price" class="form-control" id="price" required><br>
						<label>Quantity</label>
						<input type="number" name="quantity" class="form-control" id="quantity" required><br>
						<label>Deduction</label>
						<input type="text" name="deductions" class="form-control" id="deductions"><br>
						<label>Served Status</label>
						<input type="text" name="served_status" class="form-control" id="served_status"><br>
						<label>Deposit</label>
						<input type="text" name="deposit" class="form-control" id="deposit"><br>
						<label>Banks</label>
						<select id="banks" name="banks" class="form-control">
							<option value="Asia United Bank" title="Asia United Bank">Asia United Bank</option>
							<option value="BDO Unibank, Inc." title="BDO Unibank, Inc.">BDO Unibank, Inc.</option>
							<option value="Bank of Commerce" title="Bank of Commerce">Bank of Commerce</option>
							<option value="Bank of the Philippine Islands" title="Bank of the Philippine Islands">Bank of the Philippine Islands</option>
							<option value="China Banking Corporation" title="China Banking Corporation">China Banking Corporation</option>
							<option value="Citibank Philippines" title="Citibank Philippines">Citibank Philippines</option>
							<option value="Development Bank of the Philippines" title="Development Bank of the Philippines">Development Bank of the Philippines</option>
							<option value="EastWest Bank" title="EastWest Bank">EastWest Bank</option>
							<option value="Land Bank of the Philippines" title="Land Bank of the Philippines">Land Bank of the Philippines</option>
							<option value="Maybank" title="Maybank">Maybank</option>
							<option value="Metro Bank" title="Metro Bank">Metro Bank</option>
							<option value="Philippine National Bank" title="Philippine National Bank">Philippine National Bank</option>
							<option value="Philippine Veterans Bank" title="Philippine Veterans Bank">Philippine Veterans Bank</option>
							<option value="Philtrust Bank" title="Philtrust Bank">Philtrust Bank</option>
							<option value="Rizal Commercial Banking Corporation" title="Rizal Commercial Banking Corporation">Rizal Commercial Banking Corporation</option>
							<option value="Robinsons Bank" title="Robinsons Bank">Robinsons Bank</option>
							<option value="Security Bank" title="Security Bank">Security Bank</option>
							<option value="Union Bank of the Philippines" title="Union Bank of the Philippines">Union Bank of the Philippines</option>
							<option value="United Coconut Planters Bank" title="United Coconut Planters Bank">United Coconut Planters Bank</option>
						</select><br>
						<label>Delivered</label>
						<input type="text" name="delivered" class="form-control" id="delivered"><br>
						<select class="form-control" name="status"  id="status" required>
							<option value="paid">Paid</option>
							<option value="unpaid">Unpaid</option>
						</select><br>
						
						<p class="bg-info text-white py-2 px-4">Total: <span id="total_txt">0</span></p>
						<input type="hidden" name="customer_id" id="customer_id" value="">
						<input type="hidden" name="trucking_id" id="trucking_id" value="">
						<input type="hidden" name="total" id="total" value="">
                        <input type="hidden" name="order_id" id="order_id" value="">
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
        var table = $('#tableOrder').DataTable({
            processing: false,
            serverSide: true,
            dom: 'Bfrtip',
			"bSort" : true,
            buttons: [
             
            ],
			ajax: {
			   'url':"{{ route('get.order') }}",
			   'data': function(data){
				  // Read values
				  var filter_banks = $('#filter_banks').val();
				  var filter_status = $('#filter_status').val();
				  var filter_search_by = $('#filter_search_by').val();
					
				  // Append to data
				  data.searchByBanks = filter_banks;
				  data.searchByStatus = filter_status;
				  data.searchBySearch = filter_search_by;
			   }
			},
            columns: [{
                    data: 'order_id',
                    name: 'order_id'
                },
                {
                    data: 'dr_number',
                    name: 'dr_number'
                },
                {
                    data: 'customer_name',
                    name: 'customer.customer_name',
					orderable: true,
                },
				 {
                    data: 'batch_order',
                    name: 'batch_order'
                },
				{
                    data: 'order_date',
                    name: 'order_date'
                },
				{
                    data: 'variety',
                    name: 'variety'
                },
				{
                    data: 'quantity',
                    name: 'quantity'
                },
					{
                    data: 'total',
                    name: 'total'
                },
					{
                    data: 'trucking_name',
                    name: 'trucking.trucking_name'
                },
					{
                    data: 'served_status',
                    name: 'served_status'
                },
					{
                    data: 'deposit',
                    name: 'deposit'
                },
					{
                    data: 'banks',
                    name: 'banks'
                },
					{
                    data: 'delivered',
                    name: 'delivered'
                },
					{
                    data: 'status',
                    name: 'status'
                }
				,{
                    data: 'action',
                    name: 'action'
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
        $('#createOrder').click(function () {
            $('#saveBtn').val("create order");
            $('#order_id').val('');
            $('#formOrder').trigger("reset");
            $('#modal-order').modal('show');
			$("#variety").val("");
			$("#kg").val("");
        });
        // initialize btn edit
        $('body').on('click', '.editOrder', function () {
            var order_id = $(this).data('id');
			$('#variety').val('');
			$('#kg').val('');
            $.get("{{route('order.index')}}" + '/' + order_id + '/edit', function (data) {
				var total = parseInt(data.total);
                $('#saveBtn').val("edit-order");
                $('#modal-order').modal('show');
                $('#order_id').val(data.order_id);
                $('#dr_number').val(data.dr_number);
                $('#customer_name').val(data.customer_name);
				$('#customer_id').val(data.customer_id);
				$('#trucking_id').val(data.customer_trucking_id);
                $('#batch_order').val(data.batch_order);
				$('#destination').val(data.destination);
				$('#trucking').val(data.trucking_name);
				$('#order_date').val(data.order_date);
				$('#price').val(data.price);
				$('#quantity').val(data.quantity);
				$('#deductions').val(data.deductions);
				$('#served_status').val(data.served_status);
				$('#deposit').val(data.deposit);
				$('#banks').val(data.banks);
				$('#delivered').val(data.delivered);
				$('#status').val(data.status);
				$('#total_txt').text('PHP ' + total.toLocaleString());

				const variety = JSON.parse(data.variety);
				const kg = JSON.parse(data.kg);
				
				
				 
					 $.each(variety, function(index, element){
						 $('#variety').find('option[value="'+ element +'"]').prop("selected", "selected");
					});
			
				
					$.each(kg, function(index, element){
						 $('#kg').find('option[value="'+ element +'"]').prop("selected", "selected");
					}); 
				
				 
				
            })
        });
        // initialize btn save
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Save');
			if($('#formOrder').valid()){
				$.ajax({
					data: $('#formOrder').serialize(),
					url: "{{ route('order.store') }}",
					type: "POST",
					dataType: 'json',
					success: function (data) {

						$('#formOrder').trigger("reset");
						$('#modal-order').modal('hide');
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
        $('body').on('click', '.deleteOrder', function () {
            var order_id = $(this).data("id");

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
                        url: "{{route('order.store')}}" + '/' + order_id,
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
		
		
		$("#customer_name").keyup(function() {
			$.ajax({
				type: 'POST',
				url: "{{route('customer.search')}}",
				data: 'keyword=' + $(this).val(),
				beforeSend: function() {
					$("#customer_name").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
				},
				success: function(data) {
					$("#suggesstion-customer").show();
					$("#suggesstion-customer").html(data);
					$("#customer_name").css("background", "#FFF");
				}
			});
		});
		
		$("#trucking").keyup(function() {
			$.ajax({
				type: 'POST',
				url: "{{route('trucking.search')}}",
				data: 'keyword=' + $(this).val(),
				beforeSend: function() {
					$("#trucking").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
				},
				success: function(data) {
					$("#suggesstion-trucking").show();
					$("#suggesstion-trucking").html(data);
					$("#trucking").css("background", "#FFF");
				}
			});
		});
		
		$('#deductions,#price,#quantity').focusout(function() {

			var price = parseInt($('#price').val());
			var quantity = parseInt($('#quantity').val());
			var deductions = parseInt($('#deductions').val());

			
			if(price && quantity && deductions){
				var total = (price*quantity) - deductions;
			}else if(price && quantity){
				var total = price*quantity;
			}else if(price){
				var total = price;
			}else{
				var total = 0;
			}
			
			$('#total').val(total);
			$('#total_txt').text("PHP " + total.toLocaleString("en"));
		 });
			
			var filter_banks_select = "<label class=\"filter_label\"><strong>Banks:</strong></label>" + 
						"<select id=\"filter_banks\" name=\"filter_banks\" class=\"filter_select\">" + 
						"<option value=\"\" title=\"Please Select\">Please Select</option><option value=\"Asia United Bank\" title=\"Asia United Bank\">Asia United Bank</option>" + 
						"							<option value=\"BDO Unibank, Inc.\" title=\"BDO Unibank, Inc.\">BDO Unibank, Inc.</option>" + 
						"							<option value=\"Bank of Commerce\" title=\"Bank of Commerce\">Bank of Commerce</option>" + 
						"							<option value=\"Bank of the Philippine Islands\" title=\"Bank of the Philippine Islands\">Bank of the Philippine Islands</option>" + 
						"							<option value=\"China Banking Corporation\" title=\"China Banking Corporation\">China Banking Corporation</option>" + 
						"							<option value=\"Citibank Philippines\" title=\"Citibank Philippines\">Citibank Philippines</option>" + 
						"							<option value=\"Development Bank of the Philippines\" title=\"Development Bank of the Philippines\">Development Bank of the Philippines</option>" + 
						"							<option value=\"EastWest Bank\" title=\"EastWest Bank\">EastWest Bank</option>" + 
						"							<option value=\"Land Bank of the Philippines\" title=\"Land Bank of the Philippines\">Land Bank of the Philippines</option>" + 
						"							<option value=\"Maybank\" title=\"Maybank\">Maybank</option>" + 
						"							<option value=\"Metro Bank\" title=\"Metro Bank\">Metro Bank</option>" + 
						"							<option value=\"Philippine National Bank\" title=\"Philippine National Bank\">Philippine National Bank</option>" + 
						"							<option value=\"Philippine Veterans Bank\" title=\"Philippine Veterans Bank\">Philippine Veterans Bank</option>" + 
						"							<option value=\"Philtrust Bank\" title=\"Philtrust Bank\">Philtrust Bank</option>" + 
						"							<option value=\"Rizal Commercial Banking Corporation\" title=\"Rizal Commercial Banking Corporation\">Rizal Commercial Banking Corporation</option>" + 
						"							<option value=\"Robinsons Bank\" title=\"Robinsons Bank\">Robinsons Bank</option>" + 
						"							<option value=\"Security Bank\" title=\"Security Bank\">Security Bank</option>" + 
						"							<option value=\"Union Bank of the Philippines\" title=\"Union Bank of the Philippines\">Union Bank of the Philippines</option>" + 
						"							<option value=\"United Coconut Planters Bank\" title=\"United Coconut Planters Bank\">United Coconut Planters Bank</option>" + 
						"						</select>" + 
						"";
						
			
			var filter_status_select = '<label class="filter_label"><strong>Status:</strong></label>';
			filter_status_select += '<select id="filter_status" class="filter_select">';
			filter_status_select  += '<option value="">Please Select</option>';
			filter_status_select  += '<option value="paid">Paid</option>';
			filter_status_select  += '<option value="unpaid">Unpaid</option>';
			filter_status_select  += '</select>';
			
			
			
			var filter_search_by = '<label class="filter_label"><strong>Search By:</strong></label>';
			filter_search_by += '<select id="filter_search_by" class="filter_select">';
			filter_search_by  += '<option value="">Please Select</option>';
			filter_search_by  += '<option value="customer">Customer Name</option>';
			filter_search_by  += '<option value="drnumber">DR #</option>';
			filter_search_by  += '<option value="batchnumber">Batch #</option>';
			filter_search_by  += '<option value="trucking">Trucking</option>';
			filter_search_by  += '<option value="serve_status">Served Status</option>';
			filter_search_by  += '<option value="deposit">Deposit</option>';
			filter_search_by  += '<option value="delivered">Delivered</option>';
			filter_search_by  += '</select>';
			
			$('#tableOrder_filter').prepend(filter_banks_select + filter_status_select + filter_search_by);	
			$('#filter_status,#filter_banks').change(function(){ table.draw(); });

    });
	
	function selectCustomer(name,id) {
		$("#customer_name").val(name);
		$("#customer_id").val(id);
		$("#suggesstion-customer").hide();
	}
	
	function selectTrucking(name,id) {
		$("#trucking").val(name);
		$("#trucking_id").val(id);
		$("#suggesstion-trucking").hide();
	}
	


</script>
@endpush
