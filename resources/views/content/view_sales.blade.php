<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>{{$title}}</h2>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id="tableOrder">
                            <thead class="font-weight-bold text-center">
                                <tr>
                                    {{-- <th>No.</th> --}}
                                    <th>Month</th>
                                    <th>Total Sales</th>
                                  
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                {{-- @foreach ($order as $r_orders)
                                    <tr>
                                <td>{{$r_orders->order_id}}</td>
                                <td>{{$r_orders->dr_number}}</td>
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
			"searching": false,
			order: [[0, 'desc']],
            buttons: [
             
            ],
			ajax: {
			   'url':"{{ route('get.sales') }}",
			   'data': function(data){
				  // Read values
				  var filter_year = $('#filter_year').val();
					
				  // Append to data
				  data.searchByYear = filter_year;
			   }
			},
            columns: [{
                    data: 'month',
                    name: 'month'
                },
                {
                    data: 'total',
                    name: 'total'
                }
				
            ]
        });
        
        // csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        
			// Generate years
			
			 var years = generateArrayOfYears();
			  		
			var filter_year = '<label class="filter_label"><strong>Year:</strong></label>';
			filter_year += '<select id="filter_year" class="filter_year">';
			
		
			jQuery.each(years, (index, item) => {
				filter_year  += '<option value="'+item+'">'+item+'</option>';
			});
				
			
			filter_year  += '</select>';
			
			
			
			$('#tableOrder_wrapper').prepend(filter_year);	
			$('#filter_year').change(function(){ table.draw(); });

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
	
	function generateArrayOfYears() {
		  var max = new Date().getFullYear()
		  var min = max - 5
		  var years = []

		  for (var i = max; i >= min; i--) {
			years.push(i)
		  }
		  return years
		}
	


</script>
@endpush
