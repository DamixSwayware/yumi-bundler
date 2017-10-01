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
        $view = new View\ViewMaster();

        $userListTable = $view->createAndAddTable();

        $userListTable->columnModifer
            ->addColumn('username_col', $this->lang('username_column'), 'cu.username')
            ->addColumn('email_col', $this->lang('email_column'), 'cu.email_address')
            ->addColumn('register_time_col', $this->lang('register_time_col'), 'cu.register_timestamp', new TimestampToDate());

        $usernameCol = $userListTable->columnModifier->get('username_col');

        $usernameCol->filters
            ->add(new View\Filters\TextFilter(), 'text_search');
        $usernameCol->filters
            ->modify('text_search', function(TextFilter $filter){
                $filter->value = empty($filter->value) ? null : trim((string) $filter->value);

                if (!empty($filter->value) && strlen((string) $filter->value) <= 4){
                    return null;
                }
            });

        $usernameCol->modifiers
            ->add(function (Column $column, array $values = array()){
                return empty($column->value) ? $values['username_alias'] : $column->value;
            });


        $userListTable->columnModifiers->add('username_col', function(Column $column){

        });

        $where = $userListTable->filters->execute();

        $userListTable->setCount(
            $this->get('myRepository')->getListCount($where)
        );

        $data = $this->get('myRepository')->getList(
            $where,
            $userListTable->getPaginator()->getLimit(),
            $userListTable->getPaginator()->getOffset(),
            $userListTable->getSort()->getOrderBy(),
            $userListTable->getSort()->getOrderDir()
        );


        return $this->render($view);
    }

    public function editUserAction(int $userId)
    {
        if (!$this->get('userRepository')->isUserExists($userId)){
            return $this->returnNotFound();
        }



    }
}