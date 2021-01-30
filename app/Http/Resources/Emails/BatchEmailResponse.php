<?php


namespace App\Http\Resources\Emails;

use Illuminate\Http\Resources\Json\JsonResource;

class BatchEmailResponse extends JsonResource
{
    public function toArray($request)
    {
        return [
            'status' => true,
            'batch_id' => $this->id,
            'total_jobs' => $this->totalJobs
        ];
    }

}