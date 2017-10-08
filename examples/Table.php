<?php

namespace YumiBundlerExamples\Examples;

use Yumi\Bundler\View;


class IndexController extends FrameworkController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listUserAction()
    {
        $view = new View\Content\Container\GridContainer();

        $table = new View\Table\Table();

        $constraintManager = new ContraintManager();

        $constraintManager->setInputDrive(
            new Base64EncodedJson(
                [
                    'GET' => 'dcode'
                ]
            )
        );

        $constraintContainer = $constraintManager->assignTo($table);

        $constraintContainer->createFilter(
            $constraintManager->createILikeSearchFilter('username')
        );
        //or
        /*$constraintContainer->createFilter('username',
            $constraintManager->createILikeSearchFilter()
        );*/
        //or
        //$constraintContainer->createFilter('username', new ILikeSearch());

        $constraintContainer->getPaginator()->setLimit(20);
        $constraintContainer->getPaginator()->setOffset(2);
        $constraintContainer->getPaginator()->lookupBy('id');

        $constraintContainer->setFilterDriver(new PGFilterDrive());
        $constraintContainer->getPaginator()->setDrive(new PGPaginatorDrive());





        return $this->render($view);
    }

    public function editUserAction(int $userId)
    {
        if (!$this->get('userRepository')->isUserExists($userId)){
            return $this->returnNotFound();
        }



    }
}