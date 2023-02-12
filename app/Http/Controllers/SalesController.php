<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DateTime;


class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index(Request $request)
    {
        $data = [
            'count_user' => Order::latest()->count(),
            'menu'       => 'menu.v_menu_admin',
            'content'    => 'content.view_sales',
            'title'    => 'Monthly Sales'
        ];

        if ($request->ajax()) {
            $q_customer = Order::select('*')->orderBy('customer_id','desc');
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
		$searchByYear = $request->get('searchByYear');
		
        // Total records
        $totalRecords = Order::select(
			DB::raw('year(order_date) as year'),
			DB::raw('month(order_date) as month'),
			DB::raw('sum(total) as total'),
		)->groupBy('year')
			->groupBy('month')->get()->count();
			
        $totalRecordswithFilter = Order::select(
			DB::raw('year(order_date) as year'),
			DB::raw('month(order_date) as month'),
			DB::raw('sum(total) as total'),
		)->where('order_date', '=', $searchValue);

		
        // Get records, also we have included search filter as well
        $query = Order::select(
			DB::raw('year(order_date) as year'),
			DB::raw('month(order_date) as month'),
			DB::raw('sum(total) as total'),
		)->groupBy('year')
			->groupBy('month');
			
		if (!empty($searchByYear)) {
			$query->whereYear('order_date', '=', $searchByYear);
		}	
       
		$query->orderBy($columnName, $columnIndex_arr[0]['dir']) ->skip($start)
            ->take($rowperpage);  
			
        $data_arr = array();
		
		$records = $query->get();

        foreach ($records as $record) {
	
			$dateObj   = DateTime::createFromFormat('!m', $record->month);
			$monthName = $dateObj->format('F'); // March
			
            $data_arr[] = array(
				"month" => $monthName.' - '.$record->year,
                "total" => 'PHP ' . number_format((float) $record->total, 2)
				);
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => 0,
            "aaData" => $data_arr,
        );

        echo json_encode($response);
	}
}
