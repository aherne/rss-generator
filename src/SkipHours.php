<?php
namespace Lucinda\RSS;

/**
 * Encapsulates a RSS skipHours entry according to specifications:
 * https://www.rssboard.org/rss-profile#element-channel-skiphours
 */
class SkipHours implements Tag
{
    private $hours;
    
    /**
     * Sets hours of the day during which the feed is not updated
     *
     * @param integer[] $days Hours to skip (eg: [0,1,2,3,4,5,6,7])
     * @throws Exception
     */
    public function __construct(array $hours)
    {
        if (!is_array($hours)) {
            throw new Exception("SkipHours argument must be an array");
        }
        array_map(function ($item) {
            if (!is_int($item) || $item < 0 && $item > 23) {
                throw new Exception("Invalid hour: ".$item);
            }
        }, $hours);
        $this->hours = $hours;
    }
    
    /**
     * {@inheritDoc}
     * @see \Lucinda\RSS\Tag::__toString()
     */
    public function __toString()
    {
        $output = "";
        foreach ($this->hours as $hour) {
            $output .= "<hour>".$hour."</hour>";
        }
        return "<skipHours>".$output."</skipHours>";
    }
}
