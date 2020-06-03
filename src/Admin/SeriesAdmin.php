<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class SeriesAdmin extends AbstractAdmin
{
	protected $datagridValues = [
		'_sort_by' => 'name',
	];

    protected function configureFormFields(FormMapper $form_mapper)
    {
		$form_mapper
			->add('name', TextType::class, [
				'label' => 'Nom',
			])
		;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid_mapper)
    {
		$datagrid_mapper
			->add('name')
		;
    }

    protected function configureListFields(ListMapper $list_mapper)
    {
		$list_mapper
			->addIdentifier('name', 'string', [
				'route' => [
					'name' => 'show',
				]
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
			->add('name', 'string', [
				'label' => 'Nom',
			])
			->add('books', null, [
				'route' => [
					'name' => 'show',
				],
				'label' => 'Livres',
			])
		;
	}
}