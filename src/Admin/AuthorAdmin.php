<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class AuthorAdmin extends AbstractAdmin
{
	protected $datagridValues = [
		'_sort_by' => 'last_name',
	];

    protected function configureFormFields(FormMapper $form_mapper)
    {
		$form_mapper
			->add('first_name', TextType::class, [
				'label' => 'Prénom',
				'required' => false,
			])
			->add('middle_name', TextType::class, [
				'label' => 'Autre(s) prénom(s)',
				'required' => false,
			])
			->add('last_name', TextType::class, [
				'label' => 'Nom de famille',
			])
		;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid_mapper)
    {
		$datagrid_mapper
			->add('first_name')
			->add('last_name')
		;
    }

    protected function configureListFields(ListMapper $list_mapper)
    {
		$list_mapper
			->addIdentifier('first_name')
			->add('middle_name')
			->addIdentifier('last_name')
		;
	}
	
	protected function configureShowFields(ShowMapper $show_mapper)
	{
		$show_mapper
			->add('first_name')
			->add('middle_name')
			->add('last_name')
		;
	}
}