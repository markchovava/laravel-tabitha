<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
        return [
            'id' => $this->id,
            'userId' => $this->userId,
            'monthlyReportId' => $this->monthlyReportId,
            'date' => $this->date,
            'month' => $this->month,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'monthlyReport' => new MonthlyReportResource($this->whenLoaded('monthlyReport')),
            'logBathHygienes' => LogBathHygieneResource::collection($this->whenLoaded('logBathHygienes')),
            'logBloodGlucoses' => LogBloodGlucoseResource::collection($this->whenLoaded('logBloodGlucoses')),
            'logBloodPressures' => LogBloodPressureResource::collection($this->whenLoaded('logBloodPressures')),
            'logExerciseActivities' => LogExerciseActivityResource::collection($this->whenLoaded('logExerciseActivities')),
            'logHomeTests' => LogHomeTestResource::collection($this->whenLoaded('logHomeTests')),
            'logMedications' => LogMedicationResource::collection($this->whenLoaded('logBathHygienes')),
            'logNutritions' => LogNutritionResource::collection($this->whenLoaded('logNutritions')),
            'logSleeps' => LogSleepResource::collection($this->whenLoaded('logSleeps')),
            'logSorePreventions' => LogSorePreventionResource::collection($this->whenLoaded('logSorePreventions')),
            'logTemperatures' => LogTemperatureResource::collection($this->whenLoaded('logTemperatures')),
            'logUrinationDefecations' => LogUrinationDefecationResource::collection($this->whenLoaded('logUrinationDefecations')),
            'logVisitors' => LogVisitorResource::collection($this->whenLoaded('logVisitors')),
            'logWakes' => LogWakeResource::collection($this->whenLoaded('logWakes')),
        ];

    }
}
