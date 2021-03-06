<?php

namespace Sleimanx2\Plastic;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
class PlasticPaginator extends LengthAwarePaginator
{
    /**
     * @var PlasticResult
     */
    protected $result;

    /**
     * PlasticPaginator constructor.
     *
     * @param PlasticResult $result
     * @param int           $limit
     * @param int           $page
     */
    /*
    public function __construct(PlasticResult $result, $limit, $page)
    {
        $this->result = $result;

        parent::__construct($result->hits(), $result->totalHits(), $limit, $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]);

        $hitsReference = &$this->items;

        $result->setHits($hitsReference);
    }
    */
    public function __construct(PlasticResult $result, $limit, $page , $limitPage = 0)
    {
        $this->result = $result;
        $total = $result->totalHits();
        if($limitPage > 0 && Auth::check() == false && $total/$limit > $limitPage)
        {
            $total = $limit * $limitPage;
        }

        parent::__construct($result->hits(), $total, $limit, $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]);

        $hitsReference = &$this->items;

        $result->setHits($hitsReference);
    }

    /**
     * Access the plastic result object.
     *
     * @return PlasticResult
     */
    public function result()
    {
        return $this->result;
    }
}
