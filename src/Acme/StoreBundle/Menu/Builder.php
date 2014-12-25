<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Acme\StoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        
        $menu = $factory->createItem('root');

$menu->setChildrenAttributes(array('class' => 'nav navbar-nav navbar-right'));
$menu->addChild('Главная', array('route' => 'product'));
//$menu->setCurrentUri($this->container->get('request')->getRequestUri());

$menu->addChild('Главная', array('route' => 'product'));

$menu->addChild('Item_1', array('label' => 'Подпункт 1', 'route' => 'product', 'attributes' => array('class' => 'dropdown')));
$menu['Item_1']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));
$menu['Item_1']->setChildrenAttributes(array('class' => 'dropdown-menu'));

$menu['Item_1']->addChild('Подпункт 1.1', array('route' => 'product'));
$menu['Item_1']->addChild('Подпункт 1.2', array('route' => 'product'));
$menu['Item_1']->addChild(NULL, array('attributes' => array('class' => 'divider')));
$menu['Item_1']->addChild('Подпункт 1.3', array('route' => 'product'));
$menu['Item_1']->addChild('Подпункт 1.4', array('route' => 'product_show', 'routeParameters' => array('id' => '1')));

$menu->addChild('Item_2', array('route' => 'product', 'attributes' => array('class' => 'dropdown')));
$menu['Item_2']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));
$menu['Item_2']->setChildrenAttributes(array('class' => 'dropdown-menu'));

$menu['Item_2']->addChild('Подпункт 2.1', array('route' => 'product'));
$menu['Item_2']->addChild('Подпункт 2.2', array('route' => 'product'));

$menu->addChild('Пункт 3', array('route' => 'product','routeParameters' => array()));
dump($menu);
return $menu;
        
        /*
        $menu = $factory->createItem('root');
        
        $menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');

        $menu->addChild('User')
             ->setAttribute('dropdown', true);
*/
       /* $menu['User']->addChild('Profile', array('uri' => '#'));
                     //->setAttribute('divider_append', true);
        $menu['User']->addChild('Logout', array('uri' => '#'));
*/
      /*  $menu->addChild('User', array('label' => 'Hi visitor',  'attributes' => array('class' => 'dropdown')))
			->setAttribute('dropdown', true)
			->setAttribute('icon', 'fa fa-user');

		$menu['User']->addChild('Edit profile', array('route' => 'product',  'attributes' => array('class' => 'dropdown')))
			->setAttribute('icon', 'fa fa-edit');

        $menu->addChild('Home', array('route' => 'product'));
        $menu->addChild('About Me', array(
            'route' => 'product',
            'routeParameters' => array('id' => 42)
        ));
        // ... add more children

        return $menu; */
    }
}