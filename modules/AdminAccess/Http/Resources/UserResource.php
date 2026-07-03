<?php

namespace Modules\AdminAccess\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\AdminAccess\Models\User;
/**
 * @property User $resource
 */
class UserResource extends JsonResource
{

  
    public function toArray(Request $request) : array
    {
     
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'avatar' => $this->avatar_url,
            'bio' => $this->bio,
            'is_active' => $this->is_active,
            'profile' => new ProfileResource($this->whenLoaded('profile')),
            'last_login' => $this->last_login_at,
            'created_at' => $this->created_at,
            
        ];
    }

   

}