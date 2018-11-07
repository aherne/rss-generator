<?php
namespace Lucinda\RSS;

/**
 * Encapsulates a RSS tag
 * @package Lucinda\RSS
 */
interface Tag
{
    /**
     * Converts internal structure to an XML tag that will take part of RSS response
     *
     * @return string
     */
    function toString();
}