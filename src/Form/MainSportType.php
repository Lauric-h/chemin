<?php

namespace App\Form;

use App\Entity\Enum\MainType;
use App\Entity\Enum\Status;
use App\Entity\Enum\Tag;
use App\Entity\MainSport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MainSportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('duration')
            ->add('status', EnumType::class, ['class' => Status::class])
            ->add('distance')
            ->add('elevationGain')
            ->add('elevationLoss')
            ->add('location')
            ->add('tag', EnumType::class, ['class' => Tag::class])
            ->add('type', EnumType::class, ['class' => MainType::class])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MainSport::class,
        ]);
    }
}
