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
        
         $menu->setChildrenAttribute('class', 'nav pull-right');

        $menu->addChild('User')
             ->setAttribute('dropdown', true);

        $menu['User']->addChild('Profile', array('uri' => '#'))
                     ->setAttribute('divider_append', true);
        $menu['User']->addChild('Logout', array('uri' => '#'));


        $menu->addChild('Home', array('route' => 'homepage'));
        $menu->addChild('About Me', array(
            'route' => 'product',
            'routeParameters' => array('id' => 42)
        ));
        // ... add more children

        return $menu;
    }
}