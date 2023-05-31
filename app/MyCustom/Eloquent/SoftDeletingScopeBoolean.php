<?php

namespace App\MyCustom\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SoftDeletingScopeBoolean extends SoftDeletingScope
{

    public function apply(Builder $builder, Model $model)
    {
        $builder->where($this->getDeletedAtColumn( $builder ),'=',0);
    }

    protected function addWithoutTrashed(Builder $builder)
    {
        $builder->macro('withoutTrashed', function (Builder $builder) {

            $builder->withoutGlobalScope($this)->where( $this->getDeletedAtColumn( $builder ),'=',0 );

            return $builder;
        });
    }

    protected function addOnlyTrashed(Builder $builder)
    {
        $builder->macro('onlyTrashed', function (Builder $builder) {

            $builder->withoutGlobalScope($this)->where( $this->getDeletedAtColumn( $builder ),'=',1 );

            return $builder;
        });
    }
}
