<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class LanguageAdmin extends AbstractAdmin
{
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
			->add('name', null, [
				'label' => 'Nom',
			])
		;
    }

    protected function configureListFields(ListMapper $list_mapper)
    {
		$list_mapper
			->addIdentifier('name', 'string', [
				'route' => [
					'name' => 'show',
				],
				'label' => 'Nom',
			])
		;
	}
	
	protected function configureShowFields(ShowMapper $show_mapper)
	{
		$show_mapper
			->add('name', 'string', [
				'label' => 'Nom',
				'route' => [
					'name' => 'show',
				]
			])
			->add('books_in_writing_language', null, [
				'label' => 'Livres (VO)',
				'route' => [
					'name' => 'show',
				]
			])
			->add('translations', null, [
				'route' => [
					'name' => 'show',
				],
				'label' => 'Livres (traductions)',
			])
		;
	}
}