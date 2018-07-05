<?php

namespace Yumi\Bundler\View\Form;

use Yumi\Bundler\View\Form\FormField\Extension\FormFieldEventExtension;
use Yumi\Bundler\View\Form\FormField\FormFieldAbstract;

/**
 * Class FormField
 * @package Yumi\Bundler\View\Form
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 * This class represents single field at form
 */
class FormField extends FormFieldAbstract
{
    use FormFieldEventExtension;
}