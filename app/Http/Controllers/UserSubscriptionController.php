<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserSubscriptionResource;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSubscriptionController extends Controller
{

    public function indexAll(){
        $data = UserSubscription::with(['user', 'subscription'])
                ->orderBy('updated_at', 'DESC')
                ->get();
        return UserSubscriptionResource::collection($data);
    }

    public function search($search){
        if(!empty($search)) {
            $data = UserSubscription::with(['user', 'subscription'])
                ->where('name', 'LIKE', '%' . $search . '%')
                ->orderBy('updated_at', 'DESC')
                ->paginate(20);
            return UserSubscriptionResource::collection($data);
        }
    }

    public function index(){
        $data = UserSubscription::with(['user', 'subscription'])
            ->orderBy('updated_at', 'DESC')
            ->paginate(20);
        return UserSubscriptionResource::collection($data);
    }

    public function store(Request $request){
        $userId = Auth::user()->id ?? null;
        $data = new UserSubscription();
        $data->userId = $userId ?? $request->userId;
        $data->subscriptionId = $request->subscriptionId;
        $data->startDate = $request->startDate;
        $data->endDate = $request->endDate;
        $data->updated_at = now();
        $data->created_at = now();
        $data->save();
        return response()->json([
            'data' => new UserSubscriptionResource($data),
            'message' => 'Data saved successfully.',
            'status' => 1,
        ]);
    }

    public function update(Request $request, $id){
        $userId = Auth::user()->id ?? null;
        $data = UserSubscription::find($id);
        $data->userId = $userId ?? $request->userId;
        $data->subscriptionId = $request->subscriptionId;
        $data->startDate = $request->startDate;
        $data->endDate = $request->endDate;
        $data->updated_at = now();
        $data->save();
        return response()->json([
            'data' => new UserSubscriptionResource($data),
            'message' => 'Data saved successfully.',
            'status' => 1,
        ]);
    }

    public function view($id){
        $data = UserSubscription::with(['user', 'subscription'])
            ->find($id);
        return new UserSubscriptionResource($data);
    }

    public function delete($id){
        $data = UserSubscription::find($id);
        $data->delete();
        return response()->json([
            'message' => 'Data deleted successfully.',
            'status' => 1,
        ]);
    }
    
}
