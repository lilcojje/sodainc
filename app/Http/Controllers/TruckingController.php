<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Trucking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class TruckingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index(Request $request)
    {
        $data = [
            'count_user' => Trucking::latest()->count(),
            'menu'       => 'menu.v_menu_admin',
            'content'    => 'content.view_trucking',
            'title'    => 'Trucking'
        ];

        if ($request->ajax()) {
            $q_trucking = Trucking::select('*')->orderBy('trucking_id','desc');
            return Datatables::of($q_trucking)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $btn = '<div data-toggle="tooltip"  data-id="'.$row->trucking_id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 edit editTrucking"><i class=" fi-rr-edit"></i></div>';
                        $btn = $btn.' <div data-toggle="tooltip"  data-id="'.$row->trucking_id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 deleteTrucking"><i class="fi-rr-trash"></i></div>';
 
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
        Trucking::updateOrCreate(['trucking_id' => $request->trucking_id],
                [
                 'trucking_name' => $request->trucking_name,
                 'vehicle_plate' => $request->vehicle_plate,
                 'contact_person' => $request->contact_person,
                 'contact_number' => $request->contact_number,
                ]);        

        return response()->json(['success'=>'User saved successfully!']);
    }
	
	
	public function listSearch(Request $request)
    {
		$customer_data = DB::table('trucking')->where('trucking_name','like','%'.$request->keyword.'%')->limit(10)->get()->toArray();
	
		echo '<ul class="search-list">';
				foreach($customer_data as $customer){
					echo "<li onClick=\"selectTrucking('".$customer->trucking_name."','".$customer->trucking_id."');\">".$customer->trucking_name."</li>";
				}
		echo '</ul>';
		
        // $Customer = Customer::find($keyword);
        // return response()->json($Customer);

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $Trucking = Trucking::find($id);
        return response()->json($Trucking);

    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Trucking::find($id)->delete();

        return response()->json(['success'=>'Trucking deleted!']);
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
        $totalRecords = Trucking::select('*')->count();
        $totalRecordswithFilter = Trucking::select('*')->where('trucking.trucking_name', 'like', '%' . $searchValue . '%')->count();

		
        // Get records, also we have included search filter as well
        $query = Trucking::select('*');
       
	    if (!empty($searchValue)) {
			$query->where('trucking.trucking_name', 'like', '%'.$searchValue.'%');
		}
		
		
		
   	    $query->orderBy($columnName, $columnIndex_arr[0]['dir']) ->skip($start)
            ->take($rowperpage);   

        $data_arr = array();
		
		$records = $query->get();

        foreach ($records as $record) {
			$btn = '<div data-toggle="tooltip"  data-id="'.$record->trucking_id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 edit editTrucking"><i class=" fi-rr-edit"></i></div>';
            $btn .= ' <div data-toggle="tooltip"  data-id="'.$record->trucking_id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 deletTrucking"><i class="fi-rr-trash"></i></div>';
				
			
            $data_arr[] = array(
				"trucking_id" => $record->trucking_id,
				"trucking_name" => $record->trucking_name,
                "vehicle_plate" => $record->vehicle_plate,
                "contact_person" => $record->contact_person,
				"contact_number" => $record->contact_number,
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
