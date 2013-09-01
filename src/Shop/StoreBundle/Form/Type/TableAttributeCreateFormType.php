<?php

namespace Shop\StoreBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class TableAttributeCreateFormType extends TableAttributeFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('create', 'submit', [
            'attr' => [
                'class' => 'btn btn-primary',
            ],
        ]);
    }

    public function getName()
    {
        return 'shop_store_tableAttribute_create';
    }
}
