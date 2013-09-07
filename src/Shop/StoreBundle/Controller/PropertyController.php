<?php

namespace Shop\StoreBundle\Controller;

use Shop\StoreBundle\Form\Type\PropertyEditFormType;
use Shop\StoreBundle\Form\Type\PropertyValuesEditFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Shop\StoreBundle\Entity\Property;
use Shop\StoreBundle\Repository\PropertyValuesRepository;
use Shop\StoreBundle\Entity\PropertyValues;
use Shop\StoreBundle\Form\Type\PropertyCreateFormType ;
use Shop\StoreBundle\Form\Type\PropertyValuesCreateFormType ;
use Shop\StoreBundle\Form\Type\PropertyFormType ;

class PropertyController extends Controller
{
    public function __construct()
    {
    }


    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Property_service=$this->get('shop_store.Property');
        $Propertys =$em->getRepository('ShopStoreBundle:Property')->findAll();
        return $this->render('ShopStoreBundle:Property:index.html.twig',
            ['Propertys'=>$Propertys   ]);
    }

    public function createAction(Request $request)
    {
        $Property = new Property;
        $class='Shop\StoreBundle\Entity\Property';
        $form = $this->createForm(new PropertyCreateFormType($class),  $Property);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($Property);
                $em->flush($Property);
                return $this->redirect($this->generateUrl('shop_store_Property'));
            }
        }
        $Property->setTypeValue(0);
        return $this->render('ShopStoreBundle:Property:createProperty.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $Property = $em->getRepository('ShopStoreBundle:Property')->find($id);

        $class='Shop\StoreBundle\Entity\Property';

        $form = $this->createForm(new PropertyEditFormType($class), $Property);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->flush($Property);

                return $this->redirect($this->generateUrl('shop_store_Property'));
            }
        }

        return $this->render('ShopStoreBundle:Property:editProperty.html.twig', [
            'form' => $form->createView(),'id'=>$id,
        ]);
    }

    public function indexPropertyValuesAction(Request $request,$id_Property)
    {
        $em = $this->getDoctrine()->getManager();
        $Property_values =$em->getRepository('ShopStoreBundle:PropertyValues')->
            findAllPropertyValues($id_Property);
//        ld($Property_values);
        if( count($Property_values)>0)
        {
            $propertyValuesService = $this->get('shop_store.PropertyValues');
            $param_url_up = $propertyValuesService->getUrlUp( $Property_values );
            $param_url_down = $propertyValuesService->getUrlDown( $Property_values );
        }
        else{
            $param_url_up = array();
            $param_url_down = array();
        }
//        ld($param_url_down);
        return $this->render('ShopStoreBundle:Property:indexPropertyValues.html.twig',
            [    'Property_values' => $Property_values,
                 'id_Property' => $id_Property,
                'param_url_up' => $param_url_up,
                'param_url_down' => $param_url_down,
            ]);
    }

    public function createPropertyValuesAction(Request $request,$id_Property)
    {
        $table_Property = new PropertyValues;
        $class='Shop\StoreBundle\Entity\PropertyValues';
        $form = $this->createForm(new PropertyValuesCreateFormType($class), $table_Property);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $count_Property_values = (int) $em->getRepository('ShopStoreBundle:PropertyValues')->
                    findCountPropertyValues($id_Property);
            //    $table_Property->setPropertyId((int) $id_Property);
                $table_Property->setPosition($count_Property_values+1);
                $Property=$em->getRepository('ShopStoreBundle:Property')->find($id_Property);
                $table_Property->setProperty($Property);
                $em->persist($table_Property);
                $em->flush($table_Property);
                return $this->redirect($this->generateUrl('shop_store_PropertyValues',['id_Property'=>$id_Property]));
            }
        }
        return $this->render('ShopStoreBundle:Property:createPropertyValues.html.twig', [
            'form' => $form->createView(),'id_Property'=>$id_Property,
        ]);
    }

    public function editPropertyValuesAction(Request $request,$id_value_Property)
    {
        $em = $this->getDoctrine()->getManager();
        $Property_value =$em->getRepository('ShopStoreBundle:PropertyValues')->
            find($id_value_Property);
        $class='Shop\StoreBundle\Entity\PropertyValues';
        $form = $this->createForm(new PropertyValuesEditFormType($class), $Property_value);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->flush($Property_value);
                return $this->redirect($this->generateUrl('shop_store_PropertyValues',
                    ['id_Property'=>$Property_value->getPropertyId()]));
            }
        }

        return $this->render('ShopStoreBundle:Property:editPropertyValues.html.twig', [
            'form' => $form->createView(),'id'=>$id_value_Property,
        ]);
    }

    public function upPropertyValuesAction(Request $request,$id,$id_old)
    {
        $em = $this->getDoctrine()->getManager();
        $Property_value = $em->getRepository('ShopStoreBundle:PropertyValues')->find($id);
        if( $id_old == 0 )
            $Property_value->setPosition(1);
        else{
            $position = $Property_value->getPosition();
            $Property_value_old = $em->getRepository('ShopStoreBundle:PropertyValues')->find($id_old);
            $Property_value->setPosition($position-1);
            $Property_value_old->setPosition($position);
            $em->persist($Property_value_old);
            $em->flush($Property_value_old);
        }
        $em->persist($Property_value);
        $em->flush($Property_value);
        return $this->redirect($this->generateUrl('shop_store_PropertyValues',
            ['id_Property'=>$Property_value->getPropertyId()]));
    }

    public function downPropertyValuesAction(Request $request,$id,$id_old)
    {
        $em = $this->getDoctrine()->getManager();
        $Property_value = $em->getRepository('ShopStoreBundle:PropertyValues')->find($id);
        if( $id_old == 0 )
        {
            $count_Property_values = (int) $em->getRepository('ShopStoreBundle:PropertyValues')->
                findCountPropertyValues($Property_value->getPropertyId());
            $Property_value->setPosition($count_Property_values);
        }
        else{
            $Property_value_old = $em->getRepository('ShopStoreBundle:PropertyValues')->find($id_old);
            $position = $Property_value_old->getPosition();
            $Property_value->setPosition($position);
            $Property_value_old->setPosition($position-1);
            $em->persist($Property_value_old);
            $em->flush($Property_value_old);
        }
        $em->persist($Property_value);
        $em->flush($Property_value);
        return $this->redirect($this->generateUrl('shop_store_PropertyValues',
            ['id_Property'=>$Property_value->getPropertyId()]));
    }
}

