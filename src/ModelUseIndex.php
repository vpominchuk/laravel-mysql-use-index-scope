<?php

namespace VPominchuk;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

/**
 * @method Builder useIndex(string|string[] $index)
 * @method Builder forceIndex(string|string[] $index)
 * @method Builder ignoreIndex(string|string[] $index)
 *
 */
trait ModelUseIndex
{
    private $from = [];

    /**
     * @param string|array $index
     * @return string
     */
    private function parseIndexName($index): string
    {
        if (is_array($index)) {
            return "`" . implode("`, `", $index) . "`";
        }else{
            return "`" . $index . "`";
        }
    }

    /**
     * @param $query
     * @param string|array $index
     * @return Builder
     */
    public function scopeUseIndex($query, $index): Builder
    {
        $table = $this->getTable();
        $index = $this->parseIndexName($index);

        $this->from[] = "USE INDEX($index)";

        $raw = "`$table` " . implode(" ", $this->from);

        return $query->from(DB::raw($raw));
    }

    /**
     * @param $query
     * @param string|array $index
     * @return Builder
     */
    public function scopeForceIndex($query, $index): Builder
    {
        $table = $this->getTable();
        $index = $this->parseIndexName($index);

        $driver = $this->getConnection()->getDriverName();
        
        if($driver=='spanner'){
            $this->from[] = "@{FORCE_INDEX=$index}";
        }else {
            $this->from[] = "FORCE INDEX($index)";
        }
          

        $raw = "`$table` " . implode(" ", $this->from);

        return $query->from(DB::raw($raw));
    }

    /**
     * @param $query
     * @param string|array $index
     * @return Builder
     */
    public function scopeIgnoreIndex($query, $index): Builder
    {
        $table = $this->getTable();
        $index = $this->parseIndexName($index);

        $this->from[] = "IGNORE INDEX($index)";

        $raw = "`$table` " . implode(" ", $this->from);

        return $query->from(DB::raw($raw));
    }
}
