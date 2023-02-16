<?php

namespace App\queries;

use App\Models\CharitiesMeta;
use App\Models\Darkhast;
use App\Models\DarkhastStatus;
use App\Models\HomeItem;
use App\Models\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Queries
{

    public function charityFilter(Builder $query,$charityId = null,$column = 'charity',$globalData = true) : Builder
    {
        return $query->where(function ($qur) use ($globalData, $charityId, $column) {
            $qur->where($column,(is_null($charityId)) ? Auth::user()->charity : $charityId);
            if ($globalData) $qur->orWhere($column,0);
        });
    }

    public static function getCharityTerminalid() : int|null
    {
        return CharitiesMeta::query()->where('charity',Auth::user()->charity)->get('terminal_id')->first()->terminal_id;
    }

    /**
     * @return Builder
     */
    public static function getDrakhasts(): Builder
    {
        $query = Darkhast::query()
            ->join('darkhast_types', 'darkhasts.type', '=', 'darkhast_types.id')
            ->join('darkhast_statuses', 'darkhasts.status', '=', 'darkhast_statuses.id')
            ->select(['darkhasts.id', 'darkhasts.type', 'darkhasts.charity', 'darkhasts.description', 'darkhasts.created_at', 'darkhasts.updated_at', 'darkhasts.status', 'darkhast_types.title', 'darkhast_statuses.status_title','darkhasts.user']);

        if (Gate::allows('admin')) {
            $adminQuery = $query
                ->join('users', 'darkhasts.user', '=', 'users.id')
                ->addSelect(['users.name','users.phone']);

            if (Gate::allows('see-all-darkhasts')) {
                return $adminQuery
                    ->join('charities', 'darkhasts.charity', '=', 'charities.id')
                    ->addSelect(['charities.shortname']);
            }

            if (Gate::allows('see-charity-darkhasts')) {
                return $adminQuery->where('darkhasts.charity', Auth::user()->charity);
            }
        }

        return $query->where('user', Auth::id());
    }

    /**
     * @return Builder
     */
    public static function getCharities(): Builder
    {
        return \App\Models\charity::query();
    }

    public static function getCharityAndMetas(): Builder
    {
        return self::getCharities()
            ->join('charities_metas','charities.id','=','charities_metas.charity')
            ->select(['charities.id','charities_metas.*','charities.*']);
    }

    /**
     * @return Builder
     */
    public static function getFaktoors(): Builder
    {
        $query = \App\Models\Faktoor::query()
            ->join('types', 'faktoors.type', '=', 'types.id')
            ->select(['faktoors.*', 'types.title']);

        if (Gate::allows('admin')) {
            $queryAdmin = $query
                ->join('users', 'faktoors.userid', '=', 'users.id')
                ->addSelect(['users.name','users.phone']);

            if (Gate::allows('see-all-faktoors')) {
                return $queryAdmin
                    ->join('charities', 'faktoors.charity', '=', 'charities.id')
                    ->addSelect('charities.shortname');
            }

            if (Gate::allows('see-charity-faktoors')) {
                return $queryAdmin
                    ->where('faktoors.charity', Auth::user()->charity);
            }
        }

        return $query->where('userid', Auth::id());
    }

    public static function getFaktoorsSum()
    {
        $faktoors = \App\Models\Faktoor::query()
            ->select('amount')
            ->where('is_pardakht', true);

        if (Gate::allows('see-charity-faktoors')) {
            $faktoors->where('charity', Auth::user()->charity);
        } elseif(!Gate::allows('see-all-faktoors')) {
            $faktoors->where('userid', Auth::id());
        }

        return $faktoors->sum('amount');
    }

    /**
     * @return Builder
     */
    public static function getPooyeshes(): Builder
    {
        if (Gate::allows('see-charity-pooyesh')) {
            return (new Queries)->charityFilter(\App\Models\Pooyesh::query());
        }
        return \App\Models\Pooyesh::query()
            ->join('charities', 'pooyeshes.charity', '=', 'charities.id')
            ->select(['pooyeshes.*', 'charities.shortname']);
    }

    /**
     * @return Builder
     */
    public static function getProjects(): Builder
    {
        if (Gate::allows('see-charity-projects')) {
            return (new Queries())->charityFilter(\App\Models\Project::query());
        }
        return \App\Models\Project::query()
            ->join('charities', 'projects.charity', '=', 'charities.id')
            ->select(['projects.*', 'charities.shortname']);
    }

    /**
     * @return Builder
     */
    public static function getUsers(): Builder
    {
        if (Gate::allows('see-charity-users')) {
            return \App\Models\User::query()->where('charity', Auth::user()->charity);
        }
        return \App\Models\User::query()
            ->join('charities', 'users.charity', '=', 'charities.id')
            ->select(['users.id', 'users.name', 'users.email', 'users.phone', 'users.created_at', 'charities.shortname', 'users.access_level']);
    }

    public static function getAllDarkhastsTypes(bool $activeFilter = true,$charityId = null)
    {
        $query = \App\Models\DarkhastType::query();

        if ($activeFilter){
            $query->where('is_active',1);
        }

        if (Gate::allows('super-admin')) {
            return $query;
        }

        return (new Queries())->charityFilter($query,$charityId);
    }

    public static function getDarkhastsTypes(int $sub = null,bool $activeFilter = true,$charityId = null)
    {
        $query = \App\Models\DarkhastType::query()
            ->where('sub',$sub);

        if ($activeFilter){
            $query->where('is_active',1);
        }

        if (Gate::allows('super-admin')) {
            return $query;
        }

        return (new Queries())->charityFilter($query,$charityId);
    }

    public static function getDarkhastsTypesFind(int $id,bool $activeFilter = true,$charityId = null)
    {
        $query = \App\Models\DarkhastType::query();

        if ($activeFilter){
            $query->where('is_active',1);
        }

        if (Gate::allows('super-admin')) {
            return $query->findOrFail($id);
        }

        return (new Queries())->charityFilter($query,$charityId)->findOrFail($id);
    }

    public static function getDarkhastStatuses()
    {
            return \App\Models\DarkhastStatus::query();
    }

    public static function getAllTypes(bool $activeFilter = true,$charityId = null)
    {
        $query = \App\Models\Type::query();

        if ($activeFilter){
            $query->where('is_active',1);
        }

        if (Gate::allows('super-admin')) {
            return $query;
        }

        return (new Queries())->charityFilter($query,$charityId);
    }

    public static function getTypes(int $sub = null,bool $activeFilter = true,$charityId = null)
    {
        $query = \App\Models\Type::query()
            ->where('sub',$sub);

        if ($activeFilter){
            $query->where('is_active',1);
        }

        if (Gate::allows('super-admin')) {
            return $query;
        }

        return (new Queries())->charityFilter($query,$charityId);
    }

    public static function getTypesFind(int $id,bool $activeFilter = true,$charityId = null)
    {
        $query = \App\Models\Type::query();

        if ($activeFilter){
            $query->where('is_active',1);
        }

        if (Gate::allows('super-admin')) {
            return $query->findOrFail($id);
        }

        return (new Queries())->charityFilter($query,$charityId)->findOrFail($id);
    }

    public static function getHomeItems(bool $activeFilter = true,$charityId = null)
    {
        $query = HomeItem::query();

        if ($activeFilter){
            $query->where('is_active',1);
        }

        if (Gate::allows('super-admin')) {
            return $query;
        }

        return (new Queries())->charityFilter($query,$charityId);
    }
}
