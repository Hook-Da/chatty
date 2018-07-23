<?php

namespace Chatty;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Chatty\Status;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 
        'email',
        'password',
        'first_name',
        'last_name',
        'location',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function getName()
    {
        if($this->first_name && $this->last_name){
            return "{$this->first_name} {$this->last_name}";
        }
        if($this->first_name){
            return $this->first_name;
        }
        return null;
    }
    public function getNameOrUsername(){
        return $this->getName() ?: $this->username;
    }
    public function getFirstNameOrUsername(){
        return $this->first_name ?: $this->username;
    }
    public function getAvatarUrl(){
        return "https://www.gravatar.com/avatar/".md5($this->email)."?s=40&d=mm";
    }
    public function friendsOfMine(){
        return $this->belongsToMany('Chatty\User','friendz','user_id','friend_id');
    }
    public function friendsOf(){
        return $this->belongsToMany('Chatty\User','friendz','friend_id','user_id');
    }



    
    public function statuses(){
        return $this->hasMany('Chatty\Status','user_id');
    }



    public function likes(){
        return $this->hasMany('Chatty\Like','user_id');
    }



    public function friends(){
        return $this->friendsOfMine()->wherePivot('accepted','=',1)->get()->merge($this->friendsOf()->wherePivot('accepted','=',1)->get());
    }
    public function friendRequests(){
        return $this->friendsOfMine()->wherePivot('accepted','=',0)->get();
    }
    public function friendRequestsPending()
    {
        return $this->friendsOf()->wherePivot('accepted','=',0)->get();
    }
    public function hasFriendRequestPending(User $user){
        return (bool) $this->friendRequestsPending()->where('id',$user->id)->count();
    }
    public function hasFriendRequestReceived(User $user){
        return (bool) $this->friendRequests()->where('id',$user->id)->count();
    }
    public function addFriend(User $user){
        $this->friendsOf()->attach($user->id);
    }
    public function acceptFriendRequest(User $user){
        $this->friendRequests()->where('id',$user->id)->first()->pivot->update([
            'accepted'=>1,
        ]);
    }
    public function isFriendsWith(User $user){
        return (bool) $this->friends()->where('id',$user->id)->count();
    }
    public function hasLikedStatus(Status $status){
        return (bool) $status->likes
        ->where('likeable_id',$status->id)
        ->where('likeable_type',get_class($status))
        ->where('user_id',$this->id)
        ->count();
    }
    /*public function friends(){
        return $this->hasMany('Chatty\Friend')->where('accepted',true)->get();
    }
    /*public function friends(){
        $this->belongsToMany('Chatty\Friend');
    }
    /*public function friendOf(){
        $this->belongsToMany('Chatty\Friend','friend_id','user_id');
    }
    public function friends(){
        return $this->friendsOfMine()->wherePivot('accepted','=',1)->get()->merge($this->friendOf()->wherePivot('accepted','=',1)->get());
    }*/
}
