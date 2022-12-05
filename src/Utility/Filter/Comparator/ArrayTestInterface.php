<?php


namespace Nodez\Inline\Utility\Filter\Comparator;

interface ArrayTestInterface
{
    /**
     * Run a test against a single array
     * @param array $actual
     * @return bool
     */
    public function testArray(array $actual): bool;
}