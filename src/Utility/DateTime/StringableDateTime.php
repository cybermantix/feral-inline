<?php

namespace Nodez\Inline\Utility\DateTime;

use DateTimeImmutable;

class StringableDateTime extends DateTimeImmutable
{
    public function __toString()
    {
        return $this->format('U');
    }
}