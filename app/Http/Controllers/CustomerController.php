<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index(Request $request)
    {
        $data = [
            'count_user' => Customer::latest()->count(),
            'menu'       => 'menu.v_menu_admin',
            'content'    => 'content.view_customer',
            'title'    => 'Customer'
        ];

        if ($request->ajax()) {
            $q_customer = Customer::select('*')->orderBy('customer_id','desc');
            return Datatables::of($q_customer)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
						
						$btn = '<div data-toggle="tooltip"  data-id="'.$row->customer_id.'" data-original-title="View" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 view viewCustomer"><i class=" fi-rr-eye"></i></div>';
                        $btn = $btn.' <div data-toggle="tooltip"  data-id="'.$row->customer_id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 edit editCustomer"><i class=" fi-rr-edit"></i></div>';
                        $btn = $btn.' <div data-toggle="tooltip"  data-id="'.$row->customer_id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 deleteCustomer"><i class="fi-rr-trash"></i></div>';
 
                         return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('layouts.v_template',$data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Customer::updateOrCreate(['customer_id' => $request->customer_id],
                [
                 'customer_name' => $request->customer_name,
                 'contact_number' => $request->contact_number,
                 'address' => $request->address,
                ]);        

        return response()->json(['success'=>'Customer saved successfully!']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $Customer = Customer::find($id);
        return response()->json($Customer);

    }
	
	public function listSearch(Request $request)
    {
		$customer_data = DB::table('customer')->where('customer_name','like','%'.$request->keyword.'%')->limit(10)->get()->toArray();
	
		echo '<ul class="search-list">';
				foreach($customer_data as $customer){
					echo "<li onClick=\"selectCustomer('".$customer->customer_name."','".$customer->customer_id."');\"  data-id=\"".$customer->customer_id."\">".$customer->customer_name."</li>";
				}
		echo '</ul>';
		
        // $Customer = Customer::find($keyword);
        // return response()->json($Customer);

    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Customer::find($id)->delete();

        return response()->json(['success'=>'Customer deleted!']);
    }
	
	public function getData(Request $request){
	
		$draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value
		
        // Total records
        $totalRecords = Customer::select('*')->count();
        $totalRecordswithFilter = Customer::select('*')->where('customer.customer_name', 'like', '%' . $searchValue . '%')->count();

		
        // Get records, also we have included search filter as well
        $query = Customer::select('*');
       
	    if (!empty($searchValue)) {
			$query->where('customer.customer_name', 'like', '%'.$searchValue.'%');
		}
		
		
		
   	    $query->orderBy($columnName, $columnIndex_arr[0]['dir']) ->skip($start)
            ->take($rowperpage);   

        $data_arr = array();
		
		$records = $query->get();

        foreach ($records as $record) {
			$btn = '<div data-toggle="tooltip"  data-id="'.$record->customer_id.'" data-original-title="View" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 view viewCustomer"><i class=" fi-rr-eye"></i></div>';
			$btn .= '<div data-toggle="tooltip"  data-id="'.$record->customer_id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 edit editCustomer"><i class=" fi-rr-edit"></i></div>';
            $btn .= ' <div data-toggle="tooltip"  data-id="'.$record->customer_id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 deletCustomer"><i class="fi-rr-trash"></i></div>';
				
			
            $data_arr[] = array(
				"customer_id" => $record->customer_id,
                "customer_name" => $record->customer_name,
                "contact_number" => $record->contact_number,
				"address" => $record->address,
				"action" => $btn
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        echo json_encode($response);
	}
}
