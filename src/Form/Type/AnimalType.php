<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Color;
use App\Entity\Breed;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $years = array((int)date("Y"));
        for ($i = 0; $i < 10; $i++)
            $years[] = (int)date("Y") - $i;

        $builder
            ->add('name', TextType::class, [ 'label' => 'Imię' ])
            ->add('admission_date', DateType::class, [
                'label' => 'Data przyjęcia',
                'years' => $years
            ])
            ->add('year_of_birth', IntegerType::class, [ 'label' => 'Rok urodzenia'])
            ->add('weigth', NumberType::class, [ 'label' => 'Waga (kg)'])
            ->add('height', NumberType::class, [ 'label' => 'Wzrost/wysokość (cm)'])
            ->add('length', NumberType::class, [ 'label' => 'Długość (cm)'])
            ->add('color', EntityType::class, [
                'class' => Color::class,
                 'choice_label' => 'name',
                 'label' => 'Kolor',
            ])
            ->add('breed', EntityType::class, [
                'class' => Breed::class,
                 'choice_label' => 'name',
                 'label' => 'Rasa/Gatunek',
            ])
            ->add('add', SubmitType::class, [ 'label' => 'Zapisz' ])
        ;
    }
}