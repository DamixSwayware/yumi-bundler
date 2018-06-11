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

    private $headerFooter = null;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Sets header
     * @param Header $header
     * @return HeaderContainer
     */
    public function setHeader(Header $header) : self
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Gets header
     * @return Header
     */
    public function getHeader() : Header
    {
        return $this->header;
    }

    /**
     * Sets header body
     * @param HeaderBody $headerBody
     * @return HeaderContainer
     */
    public function setHeaderBody(HeaderBody $headerBody) : self
    {
        $this->headerBody = $headerBody;

        return $this;
    }

    /**
     * Gets body of header
     * @return HeaderBody
     */
    public function getHeaderBody() : HeaderBody
    {
        return $this->headerBody;
    }
}