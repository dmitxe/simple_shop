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
    public function getUrlDbal($property)
    {
        $res_param = array();
        foreach( $property as $value)
        {
            $res_param[] = array( $value['id'] );
        }
        return $res_param;
    }
}

