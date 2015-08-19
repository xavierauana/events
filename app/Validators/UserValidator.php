<?php
    /**
     * Author: Xavier Au
     * Date: 10/8/15
     * Time: 2:04 PM
     */

    namespace App\Validators;


    use App\User;
    use Illuminate\Support\Facades\App;
    use Xavierau\RoleBaseAuthentication\Contracts\RoleInterface;

    class UserValidator extends Validator
    {
        private $rules=[
            'name' => "required|max:255",
            "password" => "sometimes|confirmed",
            "status" => "required|in:active,pending,suspend"
        ];

        public function getBasicRules(array $roles=null, User $user=null )
        {
            $rules = $this->rules;
            $roleIds = implode(",", App::make(RoleInterface::class)->lists("id")->toArray());
            if($roles){
                foreach( $roles as $key => $val ){
                    $rules["role.".$key] = "required|in:".$roleIds;
                }
            }else{
                $rules["role"] = "required|in:".$roleIds;
            }

            if($user){
                $rules['email'] = "required|email|unique:users,email,".$user->id;
            }else{
                $rules['email'] = "required|email|unique:users,email";
            }
            return $rules;
        }
    }