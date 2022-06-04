<?php

namespace Lucinda\RSS;

/**
 * Escapes descriptions of illegal characters with a CDATA tag
 */
class Escape implements \Stringable
{
    private string $text;

    /**
     * Sets description body
     *
     * @param string $text RSS description tag body
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * {@inheritDoc}
     *
     * @see \Stringable::__toString()
     */
    public function __toString(): string
    {
        return "<![CDATA[".$this->text."]]>";
    }
}
