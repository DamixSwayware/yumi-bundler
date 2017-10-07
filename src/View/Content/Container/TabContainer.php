<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

 namespace Yumi\Bundler\View\Content\Container;

 use Yumi\Bundler\View\Content\Container\Exception\ContainerException;
 use Yumi\Bundler\View\Content\Container\Tab\TabItem;

 class TabContainer extends Container
 {
     public function __construct()
     {
         parent::__construct();

         $this->elementType = 'tab_container';
     }

     /**
      * Creates and assign new tab item
      * @return TabItem
      */
     public function createTabItem() : TabItem
     {
         $tabItem = new TabItem();
         $this->addItem($tabItem);
         return $tabItem;
     }

     /**
      * Adds a new tab
      * @param string $tabTitle
      * @param Container $container
      * @return TabContainer
      */
     public function addTab(string $tabTitle, Container $container) : self
     {
         $tabItem = new TabItem();
         $tabItem->setTitle($tabTitle);
         $tabItem->setContainer($container);
         $this->addItem($tabItem);
         return $this;
     }

     /**
      * @param \Yumi\Bundler\View\ViewElement $tabItem
      * @throws ContainerException
      * @return $this
      */
     public function addItem($tabItem)
     {
         if (!$tabItem instanceof TabItem){
             throw new ContainerException("Tab item is not instance of TabItem");
         }

        $this->items[] = $tabItem;
        return $this;
     }


     public function & render() : array
     {
         $result = parent::render();
         return $result;
     }

 }