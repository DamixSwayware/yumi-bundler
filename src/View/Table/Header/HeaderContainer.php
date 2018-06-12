<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Table\Header;

use Yumi\Bundler\View\ViewElement;

class HeaderContainer extends ViewElement
{
    /**
     * The header
     * @var \Yumi\Bundler\View\Table\Header\Header|null
     */
    private $header = null;

    /**
     * The body of header
     * @var \Yumi\Bundler\View\Table\Header\HeaderBody|null
     */
    private $headerBody = null;

    /**
     * The footer of header
     * @var \Yumi\Bundler\View\Table\Header\HeaderFooter
     */
    private $headerFooter = null;

    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'table_header_container';
    }
    /**
     * Sets header
     * @param Header $header
     * @return HeaderContainer
     */
    public function setHeader(?Header $header) : self
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Gets header
     * @return Header
     */
    public function getHeader() : ?Header
    {
        return $this->header;
    }

    /**
     * Sets header body
     * @param HeaderBody $headerBody
     * @return HeaderContainer
     */
    public function setHeaderBody(?HeaderBody $headerBody) : self
    {
        $this->headerBody = $headerBody;

        return $this;
    }

    /**
     * Gets body of header
     * @return HeaderBody
     */
    public function getHeaderBody() : ?HeaderBody
    {
        return $this->headerBody;
    }

    /**
     * Sets header footer
     * @param HeaderFooter $headerFooter
     * @return HeaderContainer
     */
    public function setHeaderFooter(?HeaderFooter $headerFooter) : self
    {
        $this->headerFooter = $headerFooter;

        return $this;
    }

    /**
     * Gets header footer
     * @return HeaderFooter
     */
    public function getHeaderFooter() : ?HeaderFooter
    {
        return $this->headerFooter;
    }

    public function & render() : array
    {
        $renderResult = parent::render();

        $renderResult['header'] = $this->header !== null ? $this->header->render() : null;
        $renderResult['body'] = $this->headerBody !== null ? $this->headerBody : null;
        $renderResult['footer'] = $this->headerFooter !== null ? $this->headerFooter : null;

        return $renderResult;
    }

}