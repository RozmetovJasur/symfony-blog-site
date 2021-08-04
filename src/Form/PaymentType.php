<?php
/**
 *
 * Created by PhpStorm.
 * User: Rozmetov Jasur ( @rozmetovjasur )
 * Date: 03/08/21
 * Time: 10:39
 */

namespace App\Form;

use App\Entity\Payment;
use App\Entity\PaymentMethod;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotBlank;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amount', NumberType::class, [
                'constraints' => [
                    new NotBlank(),
                    new GreaterThan(['value' => 0])
                ]
            ])
            ->add('method', EntityType::class, [
                'class' => PaymentMethod::class,
                'choice_label' => 'name',
                'choice_value' => 'id',
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('note', TextareaType::class, [
                'mapped' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Payment::class
        ]);
    }
}