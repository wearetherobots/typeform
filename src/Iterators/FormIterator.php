<?php
namespace WATR\Iterators;

use WATR\Models\Form;

class FormIterator extends PageIterator
{
    /**
     * @return Form
     */
    public function current() : Form
    {
        return new Form(current($this->response));
    }
}