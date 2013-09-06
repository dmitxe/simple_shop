<?php

namespace Shop\StoreBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class PropertyEditFormType extends PropertyFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('save', 'submit', [
            'attr' => [
                'class' => 'btn btn-primary',
            ],
        ]);
    }

    public function getName()
    {
        return 'shop_Property_edit';
    }
}
