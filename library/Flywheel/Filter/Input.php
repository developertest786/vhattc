<?php
namespace Flywheel\Filter;
class Input
{
    const TYPE_STRING = 1;
    const TYPE_INT = 2;
    const TYPE_FLOAT = 3;
    const TYPE_DOUBLE = 4;
    const TYPE_BOOLEAN = 5;
    const TYPE_ALNUM = 6;
    const TYPE_BASE64 = 7;
    const TYPE_CMD = 8;
    const TYPE_ARRAY = 9;
    const TYPE_PLAINTEXT = 10;
    /**
     * Method to be called by another php script. Processes for XSS and
     * specified bad code.
     *
     * @param mixed $source Input string/array-of-string to be 'cleaned'
     * @param string $type
     *  Return type for the variable (INT, UINT, FLOAT, BOOLEAN, WORD, ALNUM, CMD, BASE64, STRING, ARRAY, PATH, NONE)
     *
     * @return  mixed  'Cleaned' version of input parameter
     */
    public static function clean($source, $type = 'string')
    {
        // Handle the type constraint
        switch (strtoupper($type))
        {
            case 'INT':
            case 'INTEGER':
                // Only use the first integer value
                preg_match('/-?[0-9]+/', (string) $source, $matches);
                $result = @ (int) $matches[0];
                break;

            case 'UINT':
                // Only use the first integer value
                preg_match('/-?[0-9]+/', (string) $source, $matches);
                $result = @ abs((int) $matches[0]);
                break;

            case 'FLOAT':
            case 'DOUBLE':
                // Only use the first floating point value
                preg_match('/-?[0-9]+(\.[0-9]+)?/', (string) $source, $matches);
                $result = @ (float) $matches[0];
                break;

            case 'BOOL':
            case 'BOOLEAN':
                $result = (bool) $source;
                break;

            case 'WORD':
                $result = (string) preg_replace('/[^A-Z_]/i', '', $source);
                break;

            case 'ALNUM':
                $result = (string) preg_replace('/[^A-Z0-9]/i', '', $source);
                break;

            case 'CMD':
                $result = (string) preg_replace('/[^A-Z0-9_\.-]/i', '', $source);
                $result = ltrim($result, '.');
                break;

            case 'BASE64':
                $result = (string) preg_replace('/[^A-Z0-9\/+=]/i', '', $source);
                break;

            case 'ARRAY':
                $result = (array) $source;
                break;

            case 'PATH':
                $pattern = '/^[A-Za-z0-9_-]+[A-Za-z0-9_\.-]*([\\\\\/][A-Za-z0-9_-]+[A-Za-z0-9_\.-]*)*$/';
                preg_match($pattern, (string) $source, $matches);
                $result = @ (string) $matches[0];
                break;

            case 'STRING':
                $result = (string) $source;
                break;
            default:
                $result = $source;
        }

        return $result;
    }
}
