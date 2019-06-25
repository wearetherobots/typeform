<?php
/**
 * Created by PhpStorm.
 * User: tonci
 * Date: 25.06.19
 * Time: 23:40
 */

namespace WATR\Iterators;


use WATR\Models\FormResponse;

class ResoinseIterator extends AfterIterator
{

    /**
     * @return FormResponse
     */
    public function current() : FormResponse
    {
        return new FormResponse(current($this->response));
    }
}