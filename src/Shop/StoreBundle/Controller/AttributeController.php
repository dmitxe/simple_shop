<?php

namespace Shop\StoreBundle\Controller;

use Shop\StoreBundle\Form\Type\AttributeEditFormType;
use Shop\StoreBundle\Form\Type\TableAttributeEditFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Shop\StoreBundle\Entity\Attribute as AttributeClass;
use Shop\StoreBundle\Repository\TableAttributeRepository;
use Shop\StoreBundle\Entity\TableAttribute as TableAttribute;
use Shop\StoreBundle\Form\Type\AttributeCreateFormType ;
use Shop\StoreBundle\Form\Type\TableAttributeCreateFormType ;
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
        $attribute_name = new AttributeClass;
        $class='Shop\StoreBundle\Entity\Attribute';
        $form = $this->createForm(new AttributeCreateFormType($class),  $attribute_name);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($attribute_name);
                $em->flush($attribute_name);
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

    public function indexTableAttributeAction(Request $request,$id_attribute)
    {
        $em = $this->getDoctrine()->getManager();
        $attribute_values =$em->getRepository('ShopStoreBundle:TableAttribute')->
            findAll_attribute_values($id_attribute);
       // print_r($attribute_values[0]);
        return $this->render('ShopStoreBundle:Attribute:indexTableAttribute.html.twig',
            ['attribute_values'=>$attribute_values,'id_attribute'=>$id_attribute   ]);
    }
    public function createTableAttributeAction(Request $request,$id_attribute)
    {
        $table_attribute = new TableAttribute;
        $class='Shop\StoreBundle\Entity\TableAttribute';
        $form = $this->createForm(new TableAttributeCreateFormType($class), $table_attribute);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $table_attribute->setAttributeId($id_attribute);
                $table_attribute->setNom(1);
                $em->persist($table_attribute);
                $em->flush($table_attribute);
                return $this->redirect($this->generateUrl('shop_store_tableAttribute',['id_attribute'=>$id_attribute]));
            }
        }

        return $this->render('ShopStoreBundle:Attribute:createTableAttribute.html.twig', [
            'form' => $form->createView(),'id_attribute'=>$id_attribute,
        ]);
    }

    public function editTableAttributeAction(Request $request,$id_value_attribute)
    {
        $em = $this->getDoctrine()->getManager();
        $attribute_value =$em->getRepository('ShopStoreBundle:TableAttribute')->
            find($id_value_attribute);
        $class='Shop\StoreBundle\Entity\TableAttribute';
        $form = $this->createForm(new TableAttributeEditFormType($class), $attribute_value);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->flush($attribute_value);
                return $this->redirect($this->generateUrl('shop_store_tableAttribute',
                    ['id_attribute'=>$attribute_value->getAttributeId()]));
            }
        }

        return $this->render('ShopStoreBundle:Attribute:editTableAttribute.html.twig', [
            'form' => $form->createView(),'id'=>$id_value_attribute,
        ]);
    }

}
