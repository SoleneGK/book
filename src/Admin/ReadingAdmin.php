<?php

namespace App\Admin;

use App\Entity\Book;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

final class ReadingAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form_mapper)
    {
		$form_mapper
			->add('book', EntityType::class, [
				'class' => Book::class,
				'choice_label' => 'title',
				'label' => 'Livre',
			])
			->add('start_date', DateType::class, [
				'label' => 'Date de début',
			])
			->add('end_date', DateType::class, [
				'label' => 'Date de fin',
				'required' => false,
			])
		;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid_mapper)
    {
		$datagrid_mapper
			->add('book')
			->add('start_date')
			->add('end_date')
		;
    }

    protected function configureListFields(ListMapper $list_mapper)
    {
		$list_mapper
			->addIdentifier('book')
			->addIdentifier('start_date')
			->addIdentifier('end_date')
		;
	}
	
	protected function configureShowFields(ShowMapper $show_mapper)
	{
		$show_mapper
			->add('book')
			->add('start_date')
			->add('end_date')
		;
	}
}