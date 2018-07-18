<?php

namespace Yumi\Bundler\View\Form;

/**
 * Class FormFieldType
 * @package Yumi\Bundler\View\Form
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * The definitions of all supported fields types by from
 *
 */
abstract class FormFieldType
{
    /**
     * Represents the text input at form
     */
    public const TEXT_INPUT = 'text_input';

    /**
     * Represents the hidden input at form
     */
    public const HIDDEN_INPUT = 'hidden_input';

    /**
     * Represents the submit button at form
     */
    public const BUTTON = 'button';

    /**
     * Represents the checkbox at form
     */
    public const CHECKBOX = 'checkbox_input';

    /**
     * Represents the radio button at form
     */
    public const RADIO_BUTTON = 'radio_button_input';

    /**
     * Represents the group of the radio buttons
     */
    public const RADIO_BUTTON_GROUP = 'radio_button_group';

    /**
     * Represents the select box element
     */
    public const SELECT_BOX = 'select_box';

    /**
     * Represents the numeric input
     */
    public const NUMERIC_INPUT = 'numeric_input';
}