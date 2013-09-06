<?php
/**
 * Created by JetBrains PhpStorm.
 * User: XeD
 * Date: 02.09.13
 * Time: 16:40
 * To change this template use File | Settings | File Templates.
 */

namespace Shop\StoreBundle\Service;


class PropertyService
{
    /**
     * @var integer
     */
    protected $type_field;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->type_field     = array(0=>'integer',1=>'float',2=>'string');
    }

    public function getType_field()
    {
        return $this->type_field;
    }
}
