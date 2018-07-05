<?php


namespace Yumi\Bundler\View\Shared\Button;


use Yumi\Bundler\View\Shared\Image\ImageElementAbstract;
use Yumi\Bundler\View\ViewElement;

/**
 * Class ImageButtonElement
 * @package Yumi\Bundler\View\Shared\Button
 *
 * @author Reverze <hawkmedia24@gmail.com>
 * This file is a part of YumiBundler
 */
class ImageButtonElement extends SimpleButtonElement
{
    /**
     * @var ImageElementAbstract|null
     */
    private $image = null;

    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'image_button';
    }

    public function setImage(?ImageElementAbstract $imageElement) : self
    {
        $this->image = $imageElement;

        return $this;
    }

    public function getImage() : ImageElementAbstract
    {
        return $this;
    }

    public function & render() : array
    {
        $result = parent::render();

        $result['image'] = $this->image === null ? null : $this->image->render();

        return $result;
    }
}