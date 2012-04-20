<?php
/**
 * Copyright 2011 Zikula Foundation.
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 * @package Zikula
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

namespace UsersModule\Controller\FormData\Validator;

use Zikula\Component\DependencyInjection\ContainerBuilder;

/**
 * Validates a field against a set of integer values, ensuring that the field's data is one of the listed integers.
 */
class IntegerNumericInSet extends AbstractValidator
{
    /**
     * List of valid integers.
     *
     * @var array
     */
    protected $validIntegers;

    /**
     * Creates a new instance of this validator, intializing the list of valid integers.
     *
     * @param ContainerBuilder $container The current service manager.
     * @param array           $validIntegers  An array containing a list of integers considered to be valid for the
     *                                        field's data contents.
     * @param string          $errorMessage   The message to return if the data is not valid.
     *
     * @throws \InvalidArgumentException Thrown if the list of valid integer numerics is invalid,
     * or if it contains an invalid value.
     */
    public function __construct(ContainerBuilder $container, array $validIntegers, $errorMessage = null)
    {
        parent::__construct($container, $errorMessage);

        if (empty($validIntegers)) {
            throw new \InvalidArgumentException($this->__('An invalid list of valid integers was recieved.'));
        }

        foreach ($validIntegers as $validInteger) {
            if (isset($validInteger) && is_int($validInteger)) {
                $this->validIntegers[$validInteger] = $validInteger;
            } else {
                throw new \InvalidArgumentException($this->__('An invalid value was received in the list of valid
                integers.'));
            }
        }
    }

    /**
     * Validates the data against the list of valid integers.
     *
     * @param mixed $data The data to be validated.
     *
     * @return boolean True if the data is an integer numeric that is one of the values listed in the array of valid integers; otherwise false.
     */
    public function isValid($data)
    {
        $valid = false;

        if (isset($data)) {
            if (!is_int($data)) {
                if (is_numeric($data) && ((string)((int)$data) == $data)) {
                    $data = (int)$data;
                }
            }

            if (is_int($data)) {
                if (isset($this->validIntegers[$data])) {
                    $valid = true;
                }
            }
        }

        return $valid;
    }
}
