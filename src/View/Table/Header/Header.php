<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Table\Header;

use Yumi\Bundler\View\Content\Container\HorizontalContainer;
use Yumi\Bundler\View\Shared\Image\SimpleImageElement;
use Yumi\Bundler\View\Shared\Textual\TextElement;
use Yumi\Bundler\View\ViewElement;

/**
 * Class Header
 *
 * This element is a part of the table header.
 * This element represents the highest part of table header.
 * By using this element you can set the title of table or
 * even set title with image (the image is placed on the left side of title).
 *
 * Behaviour:
 *
 * If you set the title using method <b>setTitle</b> you could get back the
 * passed title by calling the method <b>getTitle</b>. But, if you set
 * the custom inner element (inherited from <i>ViewElement</i>), passed title
 * will be removed. Why is this happening? Under the hood, method <i>setTitle</i>
 * sets custom inner element. This element is a <i>HorizontalContainer</i>.
 * According the case (setting title or title with image) it pushes <i>TextElement</i>
 * and optionally <i>SimpleImageElement</i>.
 *
 * If you want to set title with image please consider the using of method <i>setTitleWithImage</i>.
 * This method requires at least two parameters: title and image source. Description of image is optional.
 *
 * If you want to reset the title pass null value(s).
 *
 * @package Yumi\Bundler\View\Table\Header
 */
class Header extends ViewElement
{
    private $titleValue = null;

    private $imageSource = null;

    private $imageDescription = null;

    private $settingInnerElementAuto = false;

    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'table_header_header';
    }

    public function setTitle(?string $title) : self
    {
        $this->titleValue = $title;

        if (!empty($this->titleValue)){

            $this->createTextHeader($this->titleValue);
        }

        return $this;
    }

    protected function createTextHeader(string $title) : self
    {
        $horizontalContainer = (new HorizontalContainer())
            ->addElement(
                (new TextElement())
                ->setSimpleValue($title)
            );

        $this->settingInnerElementAuto = true;
        $this->setInnerElement($horizontalContainer);

        return $this;
    }

    public function setTitleWithImage(?string $title, ?string $imageSource, ?string $imageDescription = null) : self
    {
        $this->titleValue = $title;
        $this->imageSource = $imageSource;
        $this->imageDescription = $imageDescription;

        if (!empty($this->titleValue) && !empty($this->imageSource)){

            $this->createTextWithImageHeader($this->titleValue,
                $this->imageSource, $this->imageDescription);
        }


        if (empty($this->imageSource)){
            $this->imageDescription = null;
        }

        return $this;
    }

    protected function createTextWithImageHeader(string $title, string $imageSource, ?string $imageDescription = null, ?int $spaceMargin = null) : self
    {
        $horizontalContainer = (new HorizontalContainer())
            ->setSpaceMargin($spaceMargin)
            ->addElement(
                (new SimpleImageElement())
                    ->setImageSource($imageSource)
                    ->setImageDescription($imageDescription)
            )
            ->addElement(
                (new TextElement())
                    ->setSimpleValue($title)
            );

        $this->settingInnerElementAuto = true;
        $this->setInnerElement($horizontalContainer);

        return $this;
    }

    public function getTitle() : ?string
    {
        return $this->titleValue;
    }

    public function getImageSource() : ?string
    {
        return $this->imageSource;
    }

    public function getImageDescription() : ?string
    {
        return $this->imageDescription;
    }

    /**
     * @param null|ViewElement $viewElement
     * @return Header
     */
    public function setInnerElement(?ViewElement $viewElement) : ViewElement
    {
        if (!empty($viewElement) && $this->settingInnerElementAuto === false){
            $this->titleValue = null;
            $this->imageSource = null;
            $this->imageDescription = null;
        }

        $this->settingInnerElementAuto = false;

        parent::setInnerElement($viewElement);


        return $this;
    }

}