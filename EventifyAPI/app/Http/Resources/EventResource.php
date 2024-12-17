<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'organized_id' => $this->organized_id,  
            'title' => $this->title,               
            'description' => $this->description,   
            'category_id' => $this->category_id,   
            'start_time' => $this->start_time->format('d/m/Y H:i:s'), 
            'end_time' => $this->end_time->format('d/m/Y H:i:s'),     
            'location' => $this->location,          
            'latitude' => $this->latitude,          
            'longitude' => $this->longitude,        
            'max_attendees' => $this->max_attendees,
            'price' => $this->price,                
            'image_url' => $this->image_url,        
            'deleted' => $this->deleted,            
            'created_at' => $this->created_at->format('d/m/Y H:i:s'), 
            'updated_at' => $this->updated_at->format('d/m/Y H:i:s'), 
        ];
    }
    
}
