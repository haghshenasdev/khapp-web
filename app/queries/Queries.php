<?php

namespace App\queries;

use App\Models\Darkhast;
use App\Models\DarkhastStatus;
use App\Models\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Queries
{
    /**
     * @return Builder
     */
    public static function getDrakhasts(): Builder
    {
        $query = Darkhast::query()
            ->join('darkhast_types', 'darkhasts.type', '=', 'darkhast_types.id')
            ->join('darkhast_statuses', 'darkhasts.status', '=', 'darkhast_statuses.id')
            ->select(['darkhasts.id', 'darkhasts.charity', 'darkhasts.description', 'darkhasts.created_at', 'darkhasts.updated_at', 'darkhasts.status', 'darkhast_types.title', 'darkhast_statuses.status_title']);

        if (Gate::allows('admin')) {
            $adminQuery = $query
                ->join('users', 'darkhasts.user', '=', 'users.id');

            if (Gate::allows('see-all-darkhasts')) {
                return $adminQuery
                    ->join('charities', 'darkhasts.charity', '=', 'charities.id')->addSelect(['charities.shortname'])
                    ->addSelect(['users.name']);
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

    /**
     * @return Builder
     */
    public static function getFaktoors(): Builder
    {
        if (Gate::allows('admin')) {
            $queryAdmin = \App\Models\Faktoor::query()
                ->join('users', 'faktoors.userid', '=', 'users.id')
                ->select(['faktoors.*', 'users.name']);

            if (Gate::allows('see-all-faktoors')) {
                return $queryAdmin
                    ->join('charities', 'faktoors.charity', '=', 'charities.id')
                    ->addSelect('charities.shortname');
            }

            if (Gate::allows('see-charity-faktoors')) {
                return $queryAdmin
                    ->where('charity', Auth::user()->charity);
            }
        }

        return \App\Models\Faktoor::query()->where('userid', Auth::id());
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
            return \App\Models\Pooyesh::query()->where('charity', Auth::user()->charity);
        }
        return \App\Models\Pooyesh::query()
            ->join('charities', 'pooyeshes.charity', '=', 'charities.id')
            ->select(['pooyeshes.id', 'pooyeshes.title', 'pooyeshes.amount', 'pooyeshes.charity', 'pooyeshes.start', 'pooyeshes.end', 'charities.shortname']);
    }

    /**
     * @return Builder
     */
    public static function getProjects(): Builder
    {
        if (Gate::allows('see-charity-projects')) {
            return \App\Models\Project::query()->where('charity', Auth::user()->charity);
        }
        return \App\Models\Project::query()
            ->join('charities', 'projects.charity', '=', 'charities.id')
            ->select(['projects.id', 'projects.title', 'projects.pishraft', 'projects.charity', 'charities.shortname']);
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

    public static function getDarkhastsTypes()
    {
        if (Gate::allows('super-admin')) {
            return \App\Models\DarkhastType::query();
        }

        return \App\Models\DarkhastType::query()->where('charity', Auth::user()->charity);
    }

    public static function getDarkhastStatuses()
    {
        if (Gate::allows('super-admin')) {
            return \App\Models\DarkhastStatus::query();
        }

        return \App\Models\DarkhastStatus::query()->where('charity', Auth::user()->charity);
    }
}