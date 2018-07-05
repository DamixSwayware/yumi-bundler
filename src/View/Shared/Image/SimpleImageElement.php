<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Shared\Image;

use Yumi\Bundler\View\Shared\Image\Exception\ImageElementException;

class SimpleImageElement extends ImageElementAbstract
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
        if (empty($this->getImageSource())){
            throw new ImageElementException('The image source is not defined');
        }

        $this->addAttribute('src', $this->getImageSource());

        if (!empty($this->getImageDescription())){
            $this->addAttribute('alt', $this->getImageDescription());
        }

        $renderResult = parent::render();

        return $renderResult;
    }
}