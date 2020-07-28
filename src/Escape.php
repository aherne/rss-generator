<?php
namespace Lucinda\RSS;

/**
 * Escapes descriptions of illegal characters with a CDATA tag
 */
class Escape
{
    private $text;
    
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
     * @see \Lucinda\RSS\Tag::__toString()
     */
    public function __toString()
    {
        return "<![CDATA[".$this->text."]]>";
    }
}
