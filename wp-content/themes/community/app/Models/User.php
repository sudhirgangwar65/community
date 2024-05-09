<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'ID';
	public $timestamps = false;
	protected $fillable = [
        'user_login',
        'user_pass',
        'user_nicename',
		'user_email',
		'user_registered',
		'display_name'
		
    ];
	public function addRole($user_id,$role){
		$my_user = new \WP_User($user_id);
		$my_user->set_role($role);
	}

	
}
