<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index(Request $request)
    {
        $data = [
            'count_customer' => Order::latest()->count(),
            'menu'       => 'menu.v_menu_admin',
            'content'    => 'content.view_order',
            'title'    => 'Order'
        ];
		
		
		

        if ($request->ajax()) {
			
			

            $q_customer = Order::join('customer','customer.customer_id','=','order.customer_id')->join('trucking','trucking.trucking_id','=','order.customer_trucking_id')->select('customer.customer_name','order.*','trucking.trucking_name')->orderBy('order_id','desc');
            return Datatables::of($q_customer)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $btn = '<div data-toggle="tooltip"  data-id="'.$row->order_id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 edit editOrder"><i class=" fi-rr-edit"></i></div>';
                        $btn = $btn.' <div data-toggle="tooltip"  data-id="'.$row->order_id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 deleteOrder"><i class="fi-rr-trash"></i></div>';
 
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
		$unique_id = floor(time()-999999999);

		$variety = json_encode($request->variety);
		$kg = json_encode($request->kg);
		
		$totalRecords = Order::select('*')->count();
		
		if($totalRecords>0){
			$order_last = Order::orderBy('order_id', 'desc')->take(1)->first()->toArray();
			$batch_order = $order_last['batch_order']+1;
		}else{
			$batch_order = '00001';
		}
		
	
        Order::updateOrCreate(['order_id' => $request->order_id],
                [
                 'dr_number' => $request->dr_number,
                 'customer_id' => $request->customer_id,
				 'batch_order' => $batch_order,
                 'destination' => $request->destination,
                 'customer_trucking_id' => $request->trucking_id,
				 'order_date' => $request->order_date,
				 'variety' => $variety,
				 'kg' => $kg,
				 'price' => $request->price,
				 'quantity' => $request->quantity,
				 'deductions' => $request->deductions,
				 'total' => $request->total,
				 'served_status' => $request->served_status,
				 'deposit' => $request->deposit,
				 'banks' => $request->banks,
				 'delivered' => $request->delivered,
				 'status' => $request->status,
                ]);        

        return response()->json(['success'=>'User saved successfully!']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $User = Order::join('customer','customer.customer_id','=','order.customer_id')->join('trucking','trucking.trucking_id','=','order.customer_trucking_id')->find($id);
        return response()->json($User);

    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Order::find($id)->delete();

        return response()->json(['success'=>'Order deleted!']);
    }
	
	public function customerOrder(Request $request)
    {
		$customer_order = DB::table('order')->where('customer_id','=',$request->customer_id)->get();
	
        return response()->json($customer_order);

    }
	
	
	public function viewOrder(Request $request)
    {
		$customer_order = Order::where('order_id','=',$request->order_id)->find($request->order_id);
        return response()->json($customer_order);

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
		$searchByBanks = $request->get('searchByBanks');
		$searchByStatus = $request->get('searchByStatus');
		$searchBySearch = $request->get('searchBySearch');
		
        // Total records
        $totalRecords = Order::join('customer','customer.customer_id','=','order.customer_id')->join('trucking','trucking.trucking_id','=','order.customer_trucking_id')->select('customer.customer_name','order.*','trucking.trucking_name')->count();
        $totalRecordswithFilter = Order::join('customer','customer.customer_id','=','order.customer_id')->join('trucking','trucking.trucking_id','=','order.customer_trucking_id')->select('customer.customer_name','order.*','trucking.trucking_name','count(*) as allcount')->where('customer.customer_name', 'like', '%' . $searchValue . '%')->count();

		
        // Get records, also we have included search filter as well
        $query = Order::join('customer','customer.customer_id','=','order.customer_id')->join('trucking','trucking.trucking_id','=','order.customer_trucking_id')->select('customer.customer_name','order.*','trucking.trucking_name');
       
	    if (!empty($searchValue) && $searchBySearch =="customer") {
			$query->where('customer.customer_name', 'like', '%'.$searchValue.'%');
		}
		
		if (!empty($searchValue) && $searchBySearch =="drnumber") {
			$query->where('order.dr_number', 'like', '%'.$searchValue.'%');
		}
		
		if (!empty($searchValue) && $searchBySearch =="batchnumber") {
			$query->where('order.batch_order', 'like', '%'.$searchValue.'%');
		}
		
		if (!empty($searchValue) && $searchBySearch =="trucking") {
			$query->where('trucking.trucking_name', 'like', '%'.$searchValue.'%');
		}
		
		if (!empty($searchValue) && $searchBySearch =="serve_status") {
			$query->where('order.served_status', 'like', '%'.$searchValue.'%');
		}
		
		if (!empty($searchValue) && $searchBySearch =="deposit") {
			$query->where('order.deposit', 'like', '%'.$searchValue.'%');
		}
		
		if (!empty($searchValue) && $searchBySearch =="delivered") {
			$query->where('order.delivered', 'like', '%'.$searchValue.'%');
		}
		
		if (!empty($searchByBanks)) {
			$query->where('order.banks', '=', $searchByBanks);
		}
		
		if (!empty($searchByStatus )) {
			$query->where('order.status', '=', $searchByStatus);
		}
		
   	    $query->orderBy($columnName, $columnIndex_arr[0]['dir']) ->skip($start)
            ->take($rowperpage);   

        $data_arr = array();
		
		$records = $query->get();

        foreach ($records as $record) {
			
			$btn = '<div data-toggle="tooltip"  data-id="'.$record->order_id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 edit editOrder"><i class=" fi-rr-edit"></i></div>';
            $btn = $btn.' <div data-toggle="tooltip"  data-id="'.$record->order_id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 deleteOrder"><i class="fi-rr-trash"></i></div>';
			
			$variety = implode(', ', json_decode($record->variety));			
			
            $data_arr[] = array(
				"order_id" => $record->order_id,
                "dr_number" => $record->dr_number,
                "customer_id" => $record->customer_id,
				"customer_name" => $record->customer_name,
                "batch_order" => $record->batch_order,
                "destination" => $record->destination,
                "trucking_name" => $record->trucking_name,
				"order_date" => $record->order_date,
				"variety" => $variety,
				"kg" => $record->kg,
				"price" => $record->price,
				"quantity" => $record->quantity,
				"deductions" => $record->deductions,
				"total" => "PHP ".number_format($record->total),
				"served_status" => $record->served_status,
				"deposit" => $record->deposit,
				"banks" => $record->banks,
				"delivered" => $record->delivered,
				"status" => ucfirst($record->status),
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
