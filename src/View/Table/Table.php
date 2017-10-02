<?php

namespace Yumi\Bundler\View\Table;

use Yumi\Bundler\View\Enum\ViewElementEnum;
use Yumi\Bundler\View\ViewElement;

class Table extends ViewElement
{
    /**
     * @var \Yumi\Bundler\View\Table\Column[]
     */
    private $columnContainer = array();

    protected $tagName = ViewElementEnum::TABLE_ELEMENT;

    public function __construct()
    {

    }

    public function & render()
    {
        $renderResult = array();

        $renderResult['columns'] = array();


        return $renderResult;
    }
}