<?php

namespace YumiBundlerExamples;

use Yumi\Bundler\View\Content\Content;

class ExampleController
{
    public function indexAction()
    {
        $content = new Content();

        $tabContainer = $content->createTabContainer();
        $tabContainer->setId('my_tab_container');

        $form = $content->createForm();
        $form->setId('my_form');

        $tabContainer->addTab('First tab', $form);

        $content->addItem($tabContainer);

        $table = $content->createTable();

        $content->itemOrder([
            'my_form', 'my_tab_container'
        ]);






    }

}