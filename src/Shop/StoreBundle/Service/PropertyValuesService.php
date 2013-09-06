<?php
/**
 * Created by JetBrains PhpStorm.
 * User: XeD
 * Date: 02.09.13
 * Time: 16:40
 * To change this template use File | Settings | File Templates.
 */

namespace Shop\StoreBundle\Service;


class PropertyValuesService
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

    public function getUrlUp($property_values)
    {
        $res_param = array();
        $old = 0;
        foreach( $property_values as $value)
        {
            $id = $value->getId();
            $res_param[] = '/' . $id .'/' . $old;
            $old = $id;
        }
        ld($res_param);
        return $res_param;
    }
}
