<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Acme\StoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware {

    public function mainMenu(FactoryInterface $factory, array $options) {

        $menu = $factory->createItem('root');

        $menu->setChildrenAttributes(array('class' => 'nav navbar-top-links navbar-right'));
        //$menu->addChild('Главная', array('route' => 'product'));
//$menu->setCurrentUri($this->container->get('request')->getRequestUri());

        $menu->addChild('User_1', array('label' => ' ', 'route' => 'product', 'attributes' => array('class' => 'dropdown', 'icon' => 'fa fa-user fa-fw')));
        $menu['User_1']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));
        $menu['User_1']->setChildrenAttributes(array('class' => 'dropdown-menu dropdown-user'));

        $menu['User_1']->addChild(' User Profile', array('route' => 'product', 'attributes' => array('icon' => 'fa fa-user fa-fw')));
        $menu['User_1']->addChild(' Settings', array('route' => 'product_new', 'attributes' => array('icon' => 'fa fa-gear fa-fw')));
        
        $security = $this->container->get('security.context');
        if ($security->isGranted('IS_AUTHENTICATED_FULLY')) {
            $username = $security->getToken()->getUser()->getUsername(); //->username();
            // authenticated (NON anonymous)
            dump($username);
            $menu['User_1']->addChild('Logout', array('label' => 'Logout ' . $username, 'route' => 'fos_user_security_logout', 'routeParameters' => array()));
        } else {
            $menu['User_1']->addChild('Login', array('route' => 'fos_user_security_login', 'routeParameters' => array()));
        };
        // dump($menu);
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


    public function sidebarMenu(FactoryInterface $factory, array $options) {

        $menu = $factory->createItem('root');

        $menu->setChildrenAttributes(array('class' => 'nav', 'id' => 'side-menu'));
        //$menu->addChild('Главная', array('route' => 'product'));
//$menu->setCurrentUri($this->container->get('request')->getRequestUri());

        $menu->addChild('Главная', array('route' => 'homepage'));

        $menu->addChild('Item_1', array('label' => 'Product', 'route' => 'product', 'attributes' => array('class' => 'active', 'icon' => 'fa arrow')));
       // $menu['Item_1']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));
       // $menu['Item_1']->setChildrenAttributes(array('class' => 'dropdown-menu'));

        $menu['Item_1']->addChild('List', array('route' => 'product'));
        $menu['Item_1']->addChild('Add', array('route' => 'product_new', 'attributes' => array('icon' => 'fa plus-times')));
        
//        $menu->addChild('Item_2', array('label' => 'Product', 'route' => '', 'attributes' => array('class' => 'active', 'icon' => 'fa arrow')));
       // $menu['Item_1']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));
       // $menu['Item_1']->setChildrenAttributes(array('class' => 'dropdown-menu'));

//        $menu['Item_2']->addChild('List', array('route' => ''));
//        $menu['Item_2']->addChild('Add', array('route' => '', 'attributes' => array('icon' => 'fa plus-times')));
       // $menu['Item_1']->addChild(NULL, array('attributes' => array('class' => 'divider')));
        return $menu;
    }

}
