<?php

namespace App\Http\Controllers;

use App\Http\Resources\LogSleepResource;
use App\Models\LogSleep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class LogSleepController extends Controller
{
    public $upload_location = 'assets/img/log/';

    public function indexByMonthlyUser($userId, $monthlyReportId){
        if(!empty($userId) && !empty($monthlyReportId)) {
            $data = LogSleep::where('userId', $userId)
                ->where('monthlyReportId', $monthlyReportId)
                ->paginate(20);
            return LogSleepResource::collection($data);
        }
        return response()->json([
            'data' => []
        ]);
    }

    public function indexByMonthly($monthlyReportId){
        if(!empty($monthlyReportId)) {
            $data = LogSleep::with(['user'])
                ->where('monthlyReportId', $monthlyReportId)
                ->paginate(20);
            return LogSleepResource::collection($data);
        }
        return response()->json([
            'data' => []
        ]);
    }

    public function indexAll(){
        $data = LogSleep::with(['user'])
                ->orderBy('updated_at', 'DESC')
                ->get();
        return LogSleepResource::collection($data);
    }

    public function indexByUser($id){
        $userId = Auth::user()->id ?? $id;
        if(!empty($userId)) {
            $data = LogSleep::with(['user'])
                ->where('userId', $userId)
                ->orderBy('updated_at', 'DESC')
                ->paginate(20);
            return LogSleepResource::collection($data);
        }
        return response()->json([
            'data' => []
        ]);
    }

    public function search($search){
        if(!empty($search)) {
            $data = LogSleep::with(['user'])
                ->where('details', 'LIKE', '%' . $search . '%')
                ->orderBy('updated_at', 'DESC')
                ->paginate(20);
            return LogSleepResource::collection($data);
        }
    }

    public function index(){
        $data = LogSleep::with(['user'])
            ->orderBy('updated_at', 'DESC')
            ->paginate(20);
        return LogSleepResource::collection($data);
    }

    public function store(Request $request){
        $userId = Auth::user()->id ?? null;
        $data = new LogSleep();
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
            $image_name = 'sleep_' . date('Ymd') . rand(0, 10000) . '.' . $image_extension;
            $image->move($this->upload_location, $image_name);
            $data->image = $this->upload_location . $image_name;                        
        }
        $data->save();
        return response()->json([
            'data' => new LogSleepResource($data),
            'message' => 'Data saved successfully.',
            'status' => 1,
        ]);
    }

    public function update(Request $request, $id){
        $userId = Auth::user()->id ?? null;
        $data = LogSleep::find($id);
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
            $image_name = 'sleep_' . date('Ymd') . rand(0, 10000) . '.' . $image_extension;
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
            'data' => new LogSleepResource($data),
            'message' => 'Data saved successfully.',
            'status' => 1,
        ]);
    }

    public function view($id){
        $data = LogSleep::with(['user'])
            ->find($id);
        return new LogSleepResource($data);
    }

    public function delete($id){
        $data = LogSleep::find($id);
        $data->delete();
        return response()->json([
            'message' => 'Data deleted successfully.',
            'status' => 1,
        ]);
    }
    
}
