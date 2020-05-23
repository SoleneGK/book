<?php

namespace App\Admin;

use App\Entity\Genre;
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
			->add('authors', ModelType::class, [
				'class' => Author::class,
				'multiple' => true,
			])
			->add('genres', ModelType::class, [
				'class' => Genre::class,
				'property' => 'name',
				'multiple' => true,
			])
			->add('rating', EntityType::class, [
				'class' => Rating::class,
				'choice_label' => 'code',
				'required' => false
			])
			->add('languages', EntityType::class, [
				'class' => Language::class,
				'choice_label' => 'name',
				'multiple' => true,
			])
		;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid_mapper)
    {
		$datagrid_mapper
			->add('title')
		;
    }

    protected function configureListFields(ListMapper $list_mapper)
    {
		$list_mapper
			->addIdentifier('title', 'string', [
				'label' => 'Titre',
			])
			->add('authors', null, [
				'label' => 'Auteurice(s)',
			])
			->add('genres', null, [
				'label' => 'Genres',
			])
			->add('rating.code', 'string', [
				'label' => 'Note',
			])
		;
	}
	
	protected function configureShowFields(ShowMapper $show_mapper)
	{
		$show_mapper
		->add('title', 'string', [
			'label' => 'Titre',
		])
		->add('authors', null, [
			'label' => 'Auteurice(s)',
		])
		->add('genres', null, [
			'label' => 'Genres',
		])
		->add('rating.code', 'string', [
			'label' => 'Note',
		])
		;
	}
}