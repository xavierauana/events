<?php

namespace App;

use App\Contracts\Repositories\UserInterface;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Hash;
use Xavierau\RoleBaseAuthentication\Traits\RoleBaseAuthenticationUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, RoleBaseAuthenticationUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    /**
     * @param array $data
     *
     * @return UserInterface
     */
    public function updateUser(array $data)
    {
        if(array_has($data, "password")){
            $data["password"] = bcrypt($data["password"]);
        }
        return $this->update($data);
    }

    /**
     * This create new user with Hashed password
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createNewUser(array $data)
    {
        $data["password"] = bcrypt($data["password"]);
        return $this->create($data);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

}
