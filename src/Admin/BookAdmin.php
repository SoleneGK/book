<?php

namespace App\Admin;

use App\Entity\Genre;
use App\Entity\Series;
use App\Entity\Author;
use App\Entity\Rating;
use App\Entity\Language;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

final class BookAdmin extends AbstractAdmin
{
	protected $datagridValues = [
		'_sort_by' => 'title',
	];

    protected function configureFormFields(FormMapper $form_mapper)
    {
		$form_mapper
			->add('title', TextType::class, [
				'label' => 'Titre',
			])
			->add('series', ModelType::class, [
				'class' => Series::class,
				'required' => false,
				'label' => 'Série',
			])
			->add('number_in_series', IntegerType::class, [
				'label' => 'N° du tome',
				'required' => false,
			])
			->add('authors', ModelType::class, [
				'class' => Author::class,
				'multiple' => true,
				'label' => 'Auteurice(s)',
			])
			->add('genres', ModelType::class, [
				'class' => Genre::class,
				'property' => 'name',
				'multiple' => true,
				'label' => 'Genres',
			])
			->add('rating', EntityType::class, [
				'class' => Rating::class,
				'choice_label' => 'code',
				'required' => false,
				'label' => 'Note',
			])
			->add('languages', EntityType::class, [
				'class' => Language::class,
				'choice_label' => 'name',
				'multiple' => true,
				'label' => 'Langue(s)',
			])
		;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid_mapper)
    {
		$datagrid_mapper
			->add('title')
			->add('rating.value')
		;
    }

    protected function configureListFields(ListMapper $list_mapper)
    {
		$list_mapper
			->addIdentifier('title', 'string', [
				'label' => 'Titre',
				'route' => [
					'name' => 'show',
				]
			])
			->add('authors', null, [
				'label' => 'Auteurice(s)',
				'route' => [
					'name' => 'show',
				]
			])
			->add('genres', null, [
				'label' => 'Genres',
				'route' => [
					'name' => 'show',
				]
			])
			->add('language', null, [
				'label' => 'Langue(s)',
				'route' => [
					'name' => 'show',
				],
			])
			->add('rating.code', 'string', [
				'label' => 'Note',
			])
			->add('rating.value', null, [
				'label' => 'Valeur',
			])
		;
	}
	
	protected function configureShowFields(ShowMapper $show_mapper)
	{
		$show_mapper
			->add('title', 'string', [
				'label' => 'Titre',
				'route' => [
					'name' => 'show',
				]
			])
			->add('series', 'string', [
				'label' => 'Série',
				'route' => [
					'name' => 'show',
				],
			])
			->add('number_in_series', null, [
				'label' => 'Tome',
			])
			->add('authors', null, [
				'label' => 'Auteurice(s)',
				'route' => [
					'name' => 'show',
				]
			])
			->add('genres', null, [
				'label' => 'Genres',
				'route' => [
					'name' => 'show',
				]
			])
			->add('languages', null, [
				'label' => 'Langues',
				'route' => [
					'name' => 'show',
				],
			])
			->add('rating.code', 'string', [
				'label' => 'Note',
				'route' => [
					'name' => 'show',
				]
			])
			->add('readings', null, [
				'label' => 'Lecture(s)',
				'route' => [
					'name' => 'show',
				],
			])
		;
	}
}