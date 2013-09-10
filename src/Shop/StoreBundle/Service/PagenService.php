<?php
/**
 * Created by JetBrains PhpStorm.
 * User: XeD
 * Date: 02.09.13
 * Time: 16:40
 * To change this template use File | Settings | File Templates.
 */

namespace Shop\StoreBundle\Service;

class PagenService
{
    /**
     * @var integer
     */
    protected $page;

    /**
     * @var integer
     */
    protected $start_page;

    /**
     * @var integer
     */
    protected $end_page;

    /**
     * @var integer
     * kol-vo show pages
     */
    protected $interval_page;

    /**
     * @var integer
     */
    protected $count_interval;

    /**
     * @var integer
     */
    protected $items_per_page;

    /**
     * @var integer
     */
    protected $pages;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->items_per_page = 3;
        $this->start_page = 1;
        $this->interval_page = 2;
    }

    public function find_start_page( $page )
    {
        $this->count_interval = ceil( $this->pages/$this->interval_page);
        $start = 1;
        for( $i = 1; $i <= $this->count_interval; $i++)
        {
            if( $page >= $start and $page <= $i*$this->interval_page )  break;
            $start += $this->interval_page;
        }
        $this->start_page = $start;
        $this->end_page = $start+$this->interval_page-1;
        if( $this->end_page>$this->pages ) $this->end_page = $this->pages;
        return $start;
    }

    public function link_html( $name,$url )
    {
        return '<a href="' . $url . '"> ' . $name . '</a>' . '&nbsp;&nbsp;';
    }

    public function puc_begin( $route,$route_parameters,$service_route )
    {
        $route_parameters['page'] = 1;
        $url = $service_route->generate( $route, $route_parameters );
        $begin_str =  $this->link_html( 'начало',$url );
        return $begin_str;
    }

    public function puc_lt( $route,$route_parameters,$service_route )
    {
        $new_page = $this->start_page-$this->interval_page;
        $route_parameters['page'] = ( $new_page>0 ) ? $new_page : 1;
        $url = $service_route->generate( $route, $route_parameters );
        $begin_str = $this->link_html( '&lt ',$url );
        return $begin_str;
    }

    public function puc_gt( $route,$route_parameters,$service_route )
    {
        $new_page = $this->start_page+$this->interval_page;
        $route_parameters['page'] = ( $new_page<=$this->pages ) ? $new_page : $this->pages;
        $url = $service_route->generate($route, $route_parameters );
        $end_str = $this->link_html( '&gt ',$url );
        return $end_str;
    }

    public function puc_end( $route,$route_parameters,$service_route )
    {
        $route_parameters['page'] = $this->pages;
        $url = $service_route->generate($route, $route_parameters );
        $end_str = $this->link_html( 'конец ',$url );
        return $end_str;
    }

    public function myPaginat($all_row,$route,$route_parameters,$page,$service_route)
    {
        $this->pages = ceil($all_row/$this->items_per_page);
        if( $page<1 ) $page = 1;
        $this->page = $page;

        if( $this->pages <= 1)  return '';
        if( $this->pages <= $this->interval_page)
        {
            $this->start_page = 1;
            $this->end_page = $this->pages;
            $begin_str = '';
            $end_str = '';
        }
        else
        {
            $this->find_start_page( $page );
        //    ld('11 $this->end_page'.$this->end_page.' $this->pages= '.$this->pages);
            switch ( $this->end_page ):
                case  $this->interval_page : { // в начало
                    $begin_str = '';
                    $end_str = $this->puc_gt( $route,$route_parameters,$service_route );
                    $end_str .= $this->puc_end( $route,$route_parameters,$service_route );
                    break;
                }
                case  $this->pages : { // в конец
                    $begin_str = $this->puc_begin( $route,$route_parameters,$service_route );
                    $begin_str .= $this->puc_lt( $route,$route_parameters,$service_route );
                    $end_str = '';
                    break;
                }
                default : { // текущая страница
                    $begin_str = $this->puc_begin( $route,$route_parameters,$service_route );
                    $begin_str .= $this->puc_lt( $route,$route_parameters,$service_route );
                    $end_str = $this->puc_gt( $route,$route_parameters,$service_route );
                    $end_str .= $this->puc_end( $route,$route_parameters,$service_route );
                }
            endswitch;
        }

        $res = $begin_str;
        for( $k = $this->start_page; $k <= $this->end_page; $k++)
        {
            if($k == $this->page )  $tek = $k.'&nbsp;&nbsp;';
            else
            {
                $route_parameters['page'] = $k;
                $url = $service_route->generate($route, $route_parameters );
                $tek = $this->link_html( $k,$url );
            }
            $res.=$tek;
        }
        $res.='&nbsp;&nbsp;'.$end_str;
        return  $res;
    }

    /**
     * Set $Items_per_page
     *
     * @param integer $items_per_page
     * @return PagenService
     */
    public function setItems_per_page($items_per_page)
    {
        if( $items_per_page >0 ) $this->items_per_page = $items_per_page;
        return $this;
    }

    /**
     * Get Items_per_page
     *
     * @return integer
     */
    public function getItems_per_page()
    {
        return $this->items_per_page;
    }

    /**
     * Set $Interval_page
     *
     * @param integer $items_per_page
     * @return PagenService
     */
    public function setInterval_page($interval_page)
    {
        if( $interval_page > 0 ) $this->interval_page = $interval_page;
        return $this;
    }

    /**
     * Get Interval_page
     *
     * @return integer
     */
    public function getInterval_page()
    {
        return $this->interval_page;
    }

    /**
     * Get Page
     *
     * @return integer
     */
    public function getPage()
    {
        return $this->page;
    }

}

