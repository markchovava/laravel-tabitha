<?php

namespace App\Http\Controllers;

use App\Http\Resources\LogUrinationDefecationResource;
use App\Models\LogUrinationDefecation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class LogUrinationDefecationController extends Controller
{
    
    public $upload_location = 'assets/img/log/';


    public function indexByMonthlyUser($userId, $monthlyReportId){
        if(!empty($userId) && !empty($monthlyReportId)) {
            $data = LogUrinationDefecation::where('userId', $userId)
                ->where('monthlyReportId', $monthlyReportId)
                ->paginate(20);
            return LogUrinationDefecationResource::collection($data);
        }
        return response()->json([
            'data' => []
        ]);
    }

    public function indexByMonthly($monthlyReportId){
        if(!empty($monthlyReportId)) {
            $data = LogUrinationDefecation::with(['user'])
                ->where('monthlyReportId', $monthlyReportId)
                ->paginate(20);
            return LogUrinationDefecationResource::collection($data);
        }
        return response()->json([
            'data' => []
        ]);
    }

    public function indexAll(){
        $data = LogUrinationDefecation::with(['user'])
                ->orderBy('updated_at', 'DESC')
                ->get();
        return LogUrinationDefecationResource::collection($data);
    }

    public function indexByUser($id){
        $userId = Auth::user()->id ?? $id;
        if(!empty($userId)) {
            $data = LogUrinationDefecation::with(['user'])
                ->where('userId', $userId)
                ->orderBy('updated_at', 'DESC')
                ->paginate(20);
            return LogUrinationDefecationResource::collection($data);
        }
        return response()->json([
            'data' => []
        ]);
    }

    public function search($search){
        if(!empty($search)) {
            $data = LogUrinationDefecation::with(['user'])
                ->where('details', 'LIKE', '%' . $search . '%')
                ->orderBy('updated_at', 'DESC')
                ->paginate(20);
            return LogUrinationDefecationResource::collection($data);
        }
    }

    public function index(){
        $data = LogUrinationDefecation::with(['user'])
            ->orderBy('updated_at', 'DESC')
            ->paginate(20);
        return LogUrinationDefecationResource::collection($data);
    }

    public function store(Request $request){
        $userId = Auth::user()->id ?? null;
        $data = new LogUrinationDefecation();
        $data->userId = $userId ?? $request->userId;
        $data->details = $request->details;
        $data->patient = $request->patient;
        $data->assistant = $request->assistant;
        $data->date = $request->date;
        $data->time = $request->time;
        $data->updated_at = now();
        $data->created_at = now();
        if( !empty($request->hasFile('image')) ) {
            $image = $request->file('image');
            $image_extension = strtolower($image->getClientOriginalExtension());
            $image_name = 'urination_defecation_' . date('Ymd') . rand(0, 10000) . '.' . $image_extension;
            $image->move($this->upload_location, $image_name);
            $data->image = $this->upload_location . $image_name;                        
        }
        $data->save();
        return response()->json([
            'data' => new LogUrinationDefecationResource($data),
            'message' => 'Data saved successfully.',
            'status' => 1,
        ]);
    }

    public function update(Request $request, $id){
        $userId = Auth::user()->id ?? null;
        $data = LogUrinationDefecation::find($id);
        $data->userId = $userId ?? $request->userId;
        $data->details = $request->details;
        $data->patient = $request->patient;
        $data->assistant = $request->assistant;
        $data->date = $request->date;
        $data->time = $request->time;
        $data->updated_at = now();
        if( $request->hasFile('image') ){
            $image = $request->file('image');
            $image_extension = strtolower($image->getClientOriginalExtension());
            $image_name = 'urination_defecation_' . date('Ymd') . rand(0, 10000) . '.' . $image_extension;
            if(!empty($data->image)){
                if(file_exists( public_path($data->image) )){
                    unlink($data->image);
                }
                $image->move($this->upload_location, $image_name);
                $data->image = $this->upload_location . $image_name;                    
            }else{
                $image->move($this->upload_location, $image_name);
                $data->image = $this->upload_location . $image_name;
            }              
        }
        $data->save();
        return response()->json([
            'data' => new LogUrinationDefecationResource($data),
            'message' => 'Data saved successfully.',
            'status' => 1,
        ]);
    }

    public function view($id){
        $data = LogUrinationDefecation::with(['user'])
            ->find($id);
        return new LogUrinationDefecationResource($data);
    }

    public function delete($id){
        $data = LogUrinationDefecation::find($id);
        $data->delete();
        return response()->json([
            'message' => 'Data deleted successfully.',
            'status' => 1,
        ]);
    }
    
}
