<?php

namespace App\Models\Scopes;

use App\Services\OrganizationContext;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OrganizationScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $organizationId = app(OrganizationContext::class)->id();

        if ($organizationId) {
            $builder->where($model->getTable().'.organization_id', $organizationId);
        }
    }
}
