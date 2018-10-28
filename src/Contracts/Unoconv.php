<?php

namespace Dtth\Unoconv\Contracts;

interface Unoconv
{
    const PDF = 'pdf';

    /**
     * Convert the given file.
     *
     * @param string $input
     * @param string $output
     * @param string $format
     * @return boolean
     */
    public function convert(string $input, ?string $output, string $format);
}