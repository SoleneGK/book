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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

final class BookAdmin extends AbstractAdmin
{
	protected $datagridValues = [
		'_sort_by' => 'title_in_display_language',
	];

    protected function configureFormFields(FormMapper $form_mapper)
    {
		$form_mapper
			->add('title_in_display_language', TextType::class, [
				'label' => 'Titre',
			])
			->add('display_language', EntityType::class, [
				'class' => Language::class,
				'choice_label' => 'name',
				'label' => 'Langue d\'affichage',
			])
			->add('title_in_writing_language', TextType::class, [
				'label' => 'Titre en VO',
			])
			->add('writing_language', ModelType::class, [
				'class' => Language::class,
				'property' => 'name',
				'label' => 'Langue originale',
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
			->add('fiction', CheckboxType::class, [
				'label' => 'Œuvre de fiction',
				'required' => false,
			])
			->add('genres', ModelType::class, [
				'class' => Genre::class,
				'property' => 'name',
				'multiple' => true,
				'label' => 'Genres',
				'required' => false,
			])
			->add('rating', EntityType::class, [
				'class' => Rating::class,
				'choice_label' => 'code',
				'required' => false,
				'label' => 'Note',
			])
			->add('misc', TextareaType::class, [
				'label' => 'Divers',
				'required' => false,
			])
		;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid_mapper)
    {
		$datagrid_mapper
			->add('title_in_display_language', null, [
				'label' => 'Titre',
			])
			->add('display_language', null, [
				'label' => 'Langue',
			])
			->add('writing_language', null, [
				'label' => 'Langue d\'écriture',
			])
			->add('series', null, [
				'label' => 'Série',
			])
			->add('authors', null, [
				'label' => 'Auteurice(s)',
			])
			->add('fiction', null, [
				'label' => 'Fiction',
			])
			->add('genres', null, [
				'label' => 'Genre(s)',
			])
			->add('rating.value', null, [
				'label' => 'Note',
			])
		;
    }

    protected function configureListFields(ListMapper $list_mapper)
    {
		$list_mapper
			->add('display_language', null, [
				'label' => 'Langue',
				'route' => [
					'name' => 'show',
				],
			])
			->addIdentifier('title_in_display_language', 'string', [
				'label' => 'Titre',
				'route' => [
					'name' => 'show',
				],
			])
			->add('writing_language', null, [
				'label' => 'Langue',
				'route' => [
					'name' => 'show',
				],
			])
			->addIdentifier('title_in_writing_language', 'string', [
				'label' => 'Titre original',
				'route' => [
					'name' => 'show',
				],
			])
			->add('series', null, [
				'label' => 'Série',
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
			->add('fiction')
			->add('genres', null, [
				'label' => 'Genres',
				'route' => [
					'name' => 'show',
				]
			])
			->add('rating.code', 'string', [
				'label' => 'Note',
			])
			->add('_action', null, [
				'actions' => [
					'edit' => [],
				]
			])
		;
	}
	
	protected function configureShowFields(ShowMapper $show_mapper)
	{
		$show_mapper
			->add('title_in_display_language', 'string', [
				'label' => 'Titre',
			])
			->add('title_in_writing_language', 'string', [
				'label' => 'Titre en VO',
			])
			->add('translations', null, [
				'label' => 'Traductions',
				'route' => [
					'name' => 'show',
				],
			])
			->add('series', null, [
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
			->add('fiction')
			->add('genres', null, [
				'label' => 'Genres',
				'route' => [
					'name' => 'show',
				]
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
			->add('misc', 'string', [
				'label' => 'Divers',
			])
		;
	}
}