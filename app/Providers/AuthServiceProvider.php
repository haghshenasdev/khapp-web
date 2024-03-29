<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\charity;
use App\Models\Darkhast;
use App\Models\DarkhastType;
use App\Models\Faktoor;
use App\Models\HomeItem;
use App\Models\Pooyesh;
use App\Models\Project;
use App\Models\Slider;
use App\Models\Type;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use function PHPUnit\Framework\matches;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //admins
        Gate::define('super-admin',function (User $user){
            return $user->access_level === 0;
        });

        Gate::define('charity-admin',function (User $user){
            return $user->access_level === 1;
        });

        Gate::define('employee-admin',function (User $user){
            return $user->access_level === 2;
        });

        Gate::define('admin',function (){
            return Gate::allows('super-admin')
                or Gate::allows('charity-admin')
                or Gate::allows('employee-admin');
        });

        Gate::define('user',function (User $user){
            return !Gate::allows('admin');
        });

        //file_manager
        Gate::define('file_manager',function (User $user){
            return Gate::allows('admin');
        });

        //users
        Gate::define('see-all-users',function (){
            return Gate::allows('super-admin');
        });

        Gate::define('see-charity-users',function (){
            return Gate::allows('charity-admin');
        });

        Gate::define('see-users',function (){
            return Gate::allows('see-all-users') or Gate::allows('see-charity-users');
        });

        Gate::define('update-user',function (User $user,User $user2){
            if (Gate::allows('super-admin')){
                return  true;
            }
            if (Gate::allows('charity-admin')){
                return $user2->charity === $user->charity;
            }
            return false;
        });

        Gate::define('delete-user',function (User $user,User $user2){
            return $user->id != $user2->id and Gate::allows('update-user',$user2);
        });

        //darkhasts
        Gate::define('see-all-darkhasts',function (){
            return Gate::allows('super-admin');
        });

        Gate::define('see-charity-darkhasts',function (){
            return Gate::allows('charity-admin');
        });

        Gate::define('update-darkhasts',function (User $user,Darkhast $darkhast = null){
            //آپدیت کردن همه ی درخواست ها حتی خیریه های دیگر
            if (is_null($darkhast)){
                return Gate::allows('super-admin');
            }
            // آپدیت کردن یک درخواست بخصوص
            if (Gate::allows('super-admin')){
                return  true;
            }
            if (Gate::allows('charity-admin') or Gate::allows('employee-admin')){
                return $darkhast->charity === $user->charity;
            }
            return $darkhast->user === $user->id;
        });

        Gate::define('delete-darkhasts',function (User $user,Darkhast $darkhast){
            return Gate::allows('update-darkhasts',$darkhast);
        });

        //faktoors
        Gate::define('see-all-faktoors',function (){
            return Gate::allows('super-admin');
        });

        Gate::define('see-charity-faktoors',function (){
            return Gate::allows('charity-admin') or Gate::allows('employee-admin');
        });

        Gate::define('update-faktoors',function (User $user,Faktoor $faktoor){
            if (Gate::allows('super-admin')){
                return  true;
            }
            if (Gate::allows('charity-admin') or Gate::allows('employee-admin')){
                return $faktoor->charity === $user->charity;
            }
            return $faktoor->user === $user->id;
        });

        Gate::define('delete-faktoors',function (User $user,Faktoor $faktoor){
            return Gate::allows('update-faktoors',$faktoor);
        });

        //charities
        Gate::define('see-charities',function (){
            return Gate::allows('super-admin');
        });

        Gate::define('update-charity',function (User $user,charity $charity){
            return Gate::allows('super-admin')
                or (Gate::allows('charity-admin') and $user->charity === $charity->id);
        });

        Gate::define('delete-charity',function (User $user,charity $charity){
            return Gate::allows('super-admin')
                or (Gate::allows('charity-admin') and $user->charity === $charity->id);
        });

        //pooyesh
        Gate::define('see-pooyesh',function (){
            return Gate::allows('admin');
        });

        Gate::define('see-all-pooyesh',function (){
            return Gate::allows('super-admin');
        });

        Gate::define('see-charity-pooyesh',function (){
            return Gate::allows('charity-admin') or Gate::allows('employee-admin');
        });

        Gate::define('update-pooyesh',function (User $user,Pooyesh $pooyesh){
            if (Gate::allows('super-admin')){
                return  true;
            }
            if (Gate::allows('charity-admin') or Gate::allows('employee-admin')){
                return $pooyesh->charity === $user->charity;
            }
            return false;
        });

        Gate::define('delete-pooyesh',function (User $user,Pooyesh $pooyesh){
            return Gate::allows('update-pooyesh',$pooyesh);
        });

        //projects
        Gate::define('see-projects',function (){
            return Gate::allows('admin');
        });

        Gate::define('see-all-projects',function (){
            return Gate::allows('super-admin');
        });

        Gate::define('see-charity-projects',function (){
            return Gate::allows('charity-admin') or Gate::allows('employee-admin');
        });

        Gate::define('update-projects',function (User $user,Project $project){
            if (Gate::allows('super-admin')){
                return  true;
            }
            if (Gate::allows('charity-admin') or Gate::allows('employee-admin')){
                return $project->charity === $user->charity;
            }
            return false;
        });

        Gate::define('delete-projects',function (User $user,Project $project){
            return Gate::allows('update-projects',$project);
        });

        //types
        Gate::define('see-types',function (){
            return Gate::allows('super-admin') or Gate::allows('charity-admin');
        });

        Gate::define('see-all-types',function (){
            return Gate::allows('super-admin');
        });

        Gate::define('see-charity-types',function (){
            return Gate::allows('charity-admin') or Gate::allows('employee-admin');
        });

        Gate::define('update-types',function (User $user,Type $type){
            if (Gate::allows('super-admin')){
                return  true;
            }
            if (Gate::allows('charity-admin') or Gate::allows('employee-admin')){
                return $type->charity === $user->charity;
            }
            return false;
        });

        Gate::define('delete-types',function (User $user,Type $type){
            return Gate::allows('update-types',$type);
        });

        //darkhastType
        Gate::define('see-darkhastType',function (){
            return Gate::allows('super-admin') or Gate::allows('charity-admin');
        });

        Gate::define('see-all-darkhastType',function (){
            return Gate::allows('super-admin');
        });

        Gate::define('see-charity-darkhastType',function (){
            return Gate::allows('charity-admin') or Gate::allows('employee-admin');
        });

        Gate::define('update-darkhastType',function (User $user,DarkhastType $type){
            if (Gate::allows('super-admin')){
                return  true;
            }
            if (Gate::allows('charity-admin') or Gate::allows('employee-admin')){
                return $type->charity === $user->charity;
            }
            return false;
        });

        Gate::define('delete-darkhastType',function (User $user,DarkhastType $type){
            return Gate::allows('update-darkhastType',$type);
        });

        //homeItems
        Gate::define('see-homeItems',function (){
            return Gate::allows('super-admin') or Gate::allows('charity-admin');
        });

        Gate::define('see-all-homeItems',function (){
            return Gate::allows('super-admin');
        });

        Gate::define('update-homeItems',function (User $user,HomeItem $HomeItem){
            if (Gate::allows('super-admin')){
                return  true;
            }
            if (Gate::allows('charity-admin') or Gate::allows('employee-admin')){
                return $HomeItem->charity === $user->charity;
            }
            return false;
        });

        Gate::define('delete-homeItems',function (User $user,HomeItem $HomeItem){
            return Gate::allows('update-homeItems',$HomeItem);
        });

        //Sliders
        Gate::define('see-sliders',function (){
            return Gate::allows('super-admin') or Gate::allows('charity-admin');
        });

        Gate::define('see-all-sliders',function (){
            return Gate::allows('super-admin');
        });

        Gate::define('update-sliders',function (User $user,Slider $Slider){
            if (Gate::allows('super-admin')){
                return  true;
            }
            if (Gate::allows('charity-admin') or Gate::allows('employee-admin')){
                return $Slider->charity === $user->charity;
            }
            return false;
        });

        Gate::define('delete-sliders',function (User $user,Slider $Slider){
            return Gate::allows('update-sliders',$Slider);
        });

        //charity
        Gate::define('update-charity',function (User $user,Charity $charity){
            if (Gate::allows('super-admin')){
                return  true;
            }
            if (Gate::allows('charity-admin')){
                return $charity->id === $user->charity;
            }
            return false;
        });

        Gate::define('delete-charity',function (User $user,Charity $charity){
            return Gate::allows('super-admin');
        });
    }
}
