<?php

namespace Yumi\Bundler\View\Shared\Image;

interface ImageElementInterface
{
    public function setImageSource(?string $imageSource);

    public function getImageSource() : ?string;

    public function setImageDescription(?string $imageDescription);

    public function getImageDescription() : ?string;
}