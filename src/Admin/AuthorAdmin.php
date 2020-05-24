<?php

namespace App\Admin;

use App\Entity\Country;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
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
			->add('country', ModelType::class, [
				'class' => Country::class,
				'required' => false,
				'label' => 'Pays',
			])
		;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid_mapper)
    {
		$datagrid_mapper
			->add('first_name')
			->add('last_name')
			->add('country.name')
		;
    }

    protected function configureListFields(ListMapper $list_mapper)
    {
		$list_mapper
			->addIdentifier('first_name', 'string', [
				'label' => 'Prénom',
				// 'route' => [
				// 	'name' => 'show',
				// ]
			])
			->add('middle_name', 'string', [
				'label' => 'Autre(s) prénom(s)',
			])
			->addIdentifier('last_name', 'string', [
				'label' => 'Nom',
				// 'route' => [
				// 	'name' => 'show',
				// ]
			])
			->add('country', null, [
				'label' => 'Pays',
				'route' => [
					'name' => 'show'
				],
			])
		;
	}
	
	protected function configureShowFields(ShowMapper $show_mapper)
	{
		$show_mapper
			->add('first_name', 'string', [
				'label' => 'Prénom',
			])
			->add('middle_name', 'string', [
				'label' => 'Autres prénom(s)',
			])
			->add('last_name', 'string', [
				'label' => 'Nom',
			])
			->add('country', null, [
				'route' => [
					'name' => 'show',
				],
				'label' => 'Pays',
			])
			->add('books', null, [
				'route' => [
					'name' => 'show',
				],
				'label' => 'Livres'
			])
		;
	}
}