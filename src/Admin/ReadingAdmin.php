<?php

namespace App\Admin;

use App\Entity\Book;
use App\Entity\Language;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Sonata\CoreBundle\Form\Type\DatePickerType;

final class ReadingAdmin extends AbstractAdmin
{
	protected function configureFormFields(FormMapper $form_mapper)
	{
		$form_mapper
			->add('book', EntityType::class, [
				'class' => Book::class,
				'choice_label' => 'title_in_display_language',
				'label' => 'Livre',
			])
			->add('start_date', DatePickerType::class, [
				'label' => 'Date de début',
			])
			->add('end_date', DatePickerType::class, [
				'label' => 'Date de fin',
				'required' => false,
			])
			->add('language', EntityType::class, [
				'class' => Language::class,
				'choice_label' => 'name',
				'label' => 'Langue',
			])
		;
	}

	protected function configureDatagridFilters(DatagridMapper $datagrid_mapper)
	{
		$datagrid_mapper
			->add('book', null, [
				'label' => 'Livre',
			])
			->add('language.name', null, [
				'label' => 'Langue',
			])
		;
	}

	protected function configureListFields(ListMapper $list_mapper)
	{
		$list_mapper
			->addIdentifier('book', null, [
				'route' => [
					'name' => 'show',
				],
				'label' => 'Livre',
			])
			->add('book.series', null, [
				'label' => 'Série',
				'route' => [
					'name' => 'show',
				]
			])
			->add('book.number_in_series', 'string', [
				'label' => 'N°',
			])
			->add('start_date', null, [
				'label' => 'Début',
				'editable' => true,
			])
			->add('end_date', null, [
				'editable' => true,
				'label' => 'Fin',
			])
			->addIdentifier('language', null, [
				'route' => [
					'name' => 'show',
				],
				'label' => 'Langue',
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
			->add('book', null, [
				'route' => [
					'name' => 'show',
				],
				'label' => 'Livre',
			])
			->add('start_date', null, [
				'label' => 'Début',
			])
			->add('end_date', null, [
				'label' => 'Fin',
			])
			->add('language', 'string', [
				'label' => 'Langue'
			])
		;
	}
}