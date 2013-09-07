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
        $Property_service = new PropertyService;
        $mas =  $Property_service->getType_field();
        $builder
            ->add('name',  null)
//            ->add('type_value',  null)
            ->add('type_value', 'choice', array(
                'choices' => $mas,
                'required'  => false,
//                'empty_data' => '2',
                'empty_value' => 'Выберите тип...',
//                'preferred_choices' => [2],
                'data' => 2,
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
