<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\User;
use App\Models\Result;
use App\Traits\Helper;
use Illuminate\Http\Request;
use App\Exports\ResultsExport;
use Maatwebsite\Excel\Facades\Excel;

class ResultController extends Controller
{
    use Helper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {


            $data = Result::get();

            return DataTables::of($data)

                ->addIndexColumn()
                ->addColumn('name',function($row){
                    return User::find($row->user_id)->name;
                })

                ->addColumn('action', function($row){

                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm delete"> <i class="fa fa-trash"></i> </a>';
                    return $btn;

                })

                ->rawColumns(['action','name'])

                ->make(true);

            return;
        }


        return view('pages.admin.result');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return Excel::download(new ResultsExport, 'result.xlsx');


        return back()->with('success', 'Result Exported Successfully.');
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //
        return $this->destroyController(Result::class,$id);
    }
}
