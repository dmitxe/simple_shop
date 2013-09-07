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
        $this->type_field = array(0=>'integer',1=>'float',2=>'string');
    }

    public function getUrlUp($property_values)
    {
        $res_param = array();
        $old = 0;
        foreach( $property_values as $value)
        {
            $id = $value->getId();
            $res_param[] = array( $id, $old );
            $old = $id;
        }
        return $res_param;
    }

    public function getUrlDown($property_values)
    {
        $res_param = array();
        $old = 0;
        $id = $property_values[0]->getId();
        $count = count($property_values);
        if( $count <=1 )
            $res_param[] = array( $id, $old );
        else{
            for( $i = 1; $i<$count ; $i++ )
            {
                $old = $property_values[$i]->getId();
                $res_param[] = array( $id, $old );
                $id = $old;
            }
            $res_param[] = array( $id, 0 );
        }
        // ld($res_param);
        return $res_param;
    }
}

