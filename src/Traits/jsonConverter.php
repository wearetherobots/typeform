<?php
namespace WATR\Traits;

trait jsonConverter
{
    /**
     * Converts array/json string/object to object
     * @param $input
     * @return object
     */
    public function toObject($input) : object
    {
        if (is_object($input)) {
            return $input;
        }

        if (is_array($input)) {
            return json_decode(json_encode($input));
        }

        if (is_string($input)) {
            return json_decode($input);
        }
    }

    /**
     * Converts array/json string/object to array
     * @param $input
     * @return array
     */
    public function toArray($input) : array
    {
        if (is_object($input)) {
            return $input;
        }

        if (is_array($input)) {
            return json_decode(json_encode($input), true);
        }

        if (is_string($input)) {
            return json_decode($input, true);
        }
    }

    /**
     * Converts array/json string/object to json string
     * @param $input
     * @return string
     */
    public function toJson($input) : string
    {
        if (is_object($input) || is_array($input)) {
            return json_encode($input);
        }

        if (is_string($input)) {
            return $input;
        }
    }
}