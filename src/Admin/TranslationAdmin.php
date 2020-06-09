<?php

namespace App\Admin;

use App\Entity\Book;
use App\Entity\Language;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class TranslationAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form_mapper)
    {
		$form_mapper
			->add('book', EntityType::class, [
				'class' => Book::class,
				'choice_label' => 'title_in_display_language',
				'label' => 'Livre',
			])
			->add('language', ModelType::class, [
				'class' => Language::class,
				'label' => 'Langue',
				'property' => 'name',
			])
			->add('title', TextType::class, [
				'label' => 'Titre',
			])
		;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid_mapper)
    {
		$datagrid_mapper
			->add('title', null, [
				'label' => 'Titre',
			])
			->add('book', null, [
				'label' => 'Livre',
			])
			->add('language', null, [
				'label' => 'Langue',
			])
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
			->add('language', null, [
				'label' => 'Langue',
				'route' => [
					'name' => 'show',
				]
			])
			->add('book', null, [
				'label' => 'Livre',
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
			->add('title', 'string', [
				'label' => 'Titre',
			])
			->add('book', null, [
				'label' => 'Livre',
				'route' => [
					'name' => 'show',
				]
			])
			->add('language', null, [
				'label' => 'Langue',
				'route' => [
					'name' => 'show',
				]
			])
		;
	}
}