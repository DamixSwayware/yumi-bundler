<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Shared\Image;

use Yumi\Bundler\View\ViewElement;

class SimpleImageElement extends ViewElement
{
    private $imageSource = null;

    private $imageDescription = null;

    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'simple_image';
    }

    public function setImageSource(?string $imageSource) : self
    {
        $this->imageSource = $imageSource;

        return $this;
    }

    public function getImageSource() : ?string
    {
        return $this->imageSource;
    }

    public function setImageDescription(?string $imageDescription) : self
    {
        $this->imageDescription = $imageDescription;

        return $this;
    }

    public function getImageDescription() : ?string
    {
        return $this->imageDescription;
    }

    public function & render() : array
    {
        $renderResult = parent::render();

        $renderResult['imageSource'] = $this->getImageSource();
        $renderResult['imageDescription'] = $this->getImageDescription();

        return $renderResult;
    }
}