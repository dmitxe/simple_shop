<?php
namespace Shop\StoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Shop\StoreBundle\Service\PropertyService;

class PropertyFormType extends AbstractType
{
    protected $class;

    /**
     * @param string $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $Property_service=new PropertyService;
        $builder
            ->add('name',  null)
//            ->add('type_value',  null)
            ->add('type_value', 'choice', array(
                'choices' => $Property_service->getType_field(),
//                'choices' =>  array('m' => 'Male', 'f' => 'Female'),
                  'required'  => false,
              ));

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
        ));
    }

    public function getName()
    {
        return 'shop_Property';
    }
}
