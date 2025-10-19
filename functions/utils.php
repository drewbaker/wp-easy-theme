<?php

/**
 * You could put any theme specific helper functions here
 */

/*
  * Split title by given characters. Wrap all split pieces or return specific zero-indexed values.
  * 
  * @param string $text - The text to split.
  * @param int|array $pieces - The number of pieces to return or an array of specific pieces to return.
  * @param string|array $separator - The separator(s) to use to split the text. Can be a string or array of strings.
  * @return string - The split text.
  */
function split_text($text = '', $pieces = null, $separator = [" &#8211; ", " - "])
{
    // Handle array of separators
    if (is_array($separator)) {
        $lines = [$text]; // Default to no split
        foreach ($separator as $sep) {
            $temp_lines = explode($sep, $text);
            if (count($temp_lines) > 1) {
                $lines = $temp_lines;
                break; // Use the first separator that actually splits the text
            }
        }
    } else {
        $lines = explode($separator, $text);
    }
    $output = '';

    if ($pieces === null) {
        $count = 0;

        foreach ($lines as $line) {
            $output .=
                '<span class="line line-' .
                ++$count .
                '">' .
                $line .
                "</span> ";
        }
    } elseif (is_numeric($pieces)) {
        $output = array_key_exists($pieces, $lines) ? $lines[$pieces] : '';
    } elseif (is_array($pieces)) {
        $output = [];
        foreach ($pieces as $piece) {
            $output[] = array_key_exists($piece, $lines)
                ? $lines[$piece]
                : '';
        }
    }

    return $output;
}
