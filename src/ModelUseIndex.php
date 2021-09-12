<?php

namespace VPominchuk;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

/**
 * @method Builder useIndex(string $index)
 * @method Builder forceIndex(string $index)
 *
 */
trait ModelUseIndex
{
    public function scopeUseIndex($query, string $index): Builder
    {
        $table = $this->getTable();
        return $query->from(DB::raw("`$table` USE INDEX(`$index`)"));
    }

    public function scopeForceIndex($query, string $index): Builder
    {
        $table = $this->getTable();
        return $query->from(DB::raw("`$table` FORCE INDEX(`$index`)"));
    }
}
