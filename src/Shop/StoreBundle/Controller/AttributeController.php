<?php

namespace Shop\StoreBundle\Controller;

use Shop\StoreBundle\Form\Type\AttributeEditFormType;
use Shop\StoreBundle\Form\Type\AttributeValuesEditFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Shop\StoreBundle\Entity\Attribute;
use Shop\StoreBundle\Repository\AttributeValuesRepository;
use Shop\StoreBundle\Entity\AttributeValues;
use Shop\StoreBundle\Form\Type\AttributeCreateFormType ;
use Shop\StoreBundle\Form\Type\AttributeValuesCreateFormType ;
use Shop\StoreBundle\Form\Type\AttributeFormType ;

class AttributeController extends Controller
{
    public function __construct()
    {
    }


    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $attribute_service=$this->get('shop_store.attribute');
        $attributes =$em->getRepository('ShopStoreBundle:Attribute')->findAll();
        return $this->render('ShopStoreBundle:Attribute:index.html.twig',
            ['attributes'=>$attributes   ]);
    }

    public function createAction(Request $request)
    {
        $attribute = new Attribute;
        $class='Shop\StoreBundle\Entity\Attribute';
        $form = $this->createForm(new AttributeCreateFormType($class),  $attribute);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($attribute);
                $em->flush($attribute);
                return $this->redirect($this->generateUrl('shop_store_attribute'));
            }
        }

        return $this->render('ShopStoreBundle:Attribute:createAttribute.html.twig', [
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
        $attribute = $em->getRepository('ShopStoreBundle:Attribute')->find($id);

        $class='Shop\StoreBundle\Entity\Attribute';

        $form = $this->createForm(new AttributeEditFormType($class), $attribute);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->flush($attribute);

                return $this->redirect($this->generateUrl('shop_store_attribute'));
            }
        }

        return $this->render('ShopStoreBundle:Attribute:editAttribute.html.twig', [
            'form' => $form->createView(),'id'=>$id,
        ]);
    }

    public function indexAttributeValuesAction(Request $request,$id_attribute)
    {
        $em = $this->getDoctrine()->getManager();
        $attribute_values =$em->getRepository('ShopStoreBundle:AttributeValues')->
            findAllAttributeValues($id_attribute);
        return $this->render('ShopStoreBundle:Attribute:indexAttributeValues.html.twig',
            ['attribute_values'=>$attribute_values,'id_attribute'=>$id_attribute   ]);
    }

    public function createAttributeValuesAction(Request $request,$id_attribute)
    {
        $table_attribute = new AttributeValues;
        $class='Shop\StoreBundle\Entity\AttributeValues';
        $form = $this->createForm(new AttributeValuesCreateFormType($class), $table_attribute);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $count_attribute_values = (int) $em->getRepository('ShopStoreBundle:AttributeValues')->
                    findCountAttributeValues($id_attribute);
            //    $table_attribute->setAttributeId((int) $id_attribute);
                $table_attribute->setPosition($count_attribute_values+1);
                $attribute=$em->getRepository('ShopStoreBundle:Attribute')->find($id_attribute);
                $table_attribute->setAttribute($attribute);
                $em->persist($table_attribute);
                $em->flush($table_attribute);
                return $this->redirect($this->generateUrl('shop_store_AttributeValues',['id_attribute'=>$id_attribute]));
            }
        }

        return $this->render('ShopStoreBundle:Attribute:createAttributeValues.html.twig', [
            'form' => $form->createView(),'id_attribute'=>$id_attribute,
        ]);
    }

    public function editAttributeValuesAction(Request $request,$id_value_attribute)
    {
        $em = $this->getDoctrine()->getManager();
        $attribute_value =$em->getRepository('ShopStoreBundle:AttributeValues')->
            find($id_value_attribute);
        $class='Shop\StoreBundle\Entity\AttributeValues';
        $form = $this->createForm(new AttributeValuesEditFormType($class), $attribute_value);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->flush($attribute_value);
                return $this->redirect($this->generateUrl('shop_store_AttributeValues',
                    ['id_attribute'=>$attribute_value->getAttributeId()]));
            }
        }

        return $this->render('ShopStoreBundle:Attribute:editAttributeValues.html.twig', [
            'form' => $form->createView(),'id'=>$id_value_attribute,
        ]);
    }
}

