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

    public function getUrl($property_values)
    {
        $res_param = array();
        foreach( $property_values as $value)
        {
            $res_param[] = array( $value->getId() );
        }
        return $res_param;
    }
    public function getUrlDbal($property_values)
    {
        $res_param = array();
        foreach( $property_values as $value)
        {
            $res_param[] = array( $value['id'] );
        }
        return $res_param;
    }
}

