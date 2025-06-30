<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogUrinationDefecationResource extends JsonResource
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
            'dailyReportId' => $this->dailyReportId,
            'monthlyReportId' => $this->monthlyReportId,
            'details' => $this->details,
            'patient' => $this->patient,
            'assistant' => $this->assistant,
            'date' => $this->date,
            'time' => $this->time,
            'image' => $this->image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'dailyReport' => new DailyReportResource($this->whenLoaded('dailyReport')),
            'monthlyReport' => new MonthlyReportResource($this->whenLoaded('monthlyReport')),
        ];
    }
}
