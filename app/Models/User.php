<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'email', 'password', 'country'])]
#[Hidden(['password', 'remember_token'])]


class User extends Authenticatable {
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    
    /**
     * Get the attributes that should be cast.
    *
    * @return array<string, string>
    */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            ];
    }
            
            // Required fields for the User model
            public function requiredProfileFields(): array
            {
                return [
                    'country' => [
                        'required' => true,
                        'type' => 'select',
                        'label' => 'Country',
                        'rules' => 'required|string|max:255',
                        'options' => [
                            'US' => 'United States',
                            'CY' => 'Cyprus',
                            'CA' => 'Canada',
                            'AU' => 'Australia',
                            'DE' => 'Germany',
                            'FR' => 'France',
                            'JP' => 'Japan',
                            'CN' => 'China',
                            'IN' => 'India',
                            'BR' => 'Brazil',
                            'Other' => 'Other',
                        ],
                    ]
                    // Future fields:
                    // 'phone' => [
                    //     'required' => false,
                    //     'type' => 'text',
                    //     'label' => 'Phone Number',
                    //     'rules' => 'nullable|string|max:20'
                    // ],            

        ];
    }

    // Defining the relationship with the Role model
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


    // Helper method to check if the user has a specific role
    public function hasRole(string $role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    
    // Defining the relationship with the Vote model
    public function votes()
    {
        return $this->hasMany(Vote::class);
    } 
    
    
    // Defining the relationship with the Ninja model    
    public function ninjas()
    {
        return $this->hasMany(Ninja::class);
    }        



}
