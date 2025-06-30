<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function indexAll(){
        $data = Subscription::with(['user'])
                ->orderBy('updated_at', 'DESC')
                ->get();
        return SubscriptionResource::collection($data);
    }

    public function search($search){
        if(!empty($search)) {
            $data = Subscription::with(['user'])
                ->where('name', 'LIKE', '%' . $search . '%')
                ->orderBy('updated_at', 'DESC')
                ->paginate(20);
            return SubscriptionResource::collection($data);
        }
    }

    public function index(){
        $data = Subscription::with(['user'])
            ->orderBy('updated_at', 'DESC')
            ->paginate(20);
        return SubscriptionResource::collection($data);
    }

    public function store(Request $request){
        $data = new Subscription();
        $data->name = $request->name;
        $data->description = $request->name;
        $data->fee = $request->fee;
        $data->created_at = now();
        $data->updated_at = now();
        $data->save();
        return response()->json([
            'data' => new SubscriptionResource($data),
            'message' => 'Data saved successfully.',
            'status' => 1,
        ]);
    }

    public function update(Request $request, $id){
        $data = Subscription::find($id);
        $data->name = $request->name;
        $data->description = $request->name;
        $data->fee = $request->fee;
        $data->created_at = now();
        $data->updated_at = now();
        $data->save();
        return response()->json([
            'data' => new SubscriptionResource($data),
            'message' => 'Data saved successfully.',
            'status' => 1,
        ]);
    }

    public function view($id){
        $data = Subscription::with(['user'])
            ->find($id);
        return new SubscriptionResource($data);
    }

    public function delete($id){
        $data = Subscription::find($id);
        $data->delete();
        return response()->json([
            'message' => 'Data deleted successfully.',
            'status' => 1,
        ]);
    }
    
}
