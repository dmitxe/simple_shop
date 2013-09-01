<?php

namespace Shop\StoreBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class AttributeEditFormType extends AttributeFormType
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
        return 'shop_attribute_edit';
    }
}
