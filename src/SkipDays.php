<?php
namespace Lucinda\RSS;

/**
 * Encapsulates a RSS skipDays entry according to specifications:
 * https://www.rssboard.org/rss-profile#element-channel-skipdays
 */
class SkipDays implements Tag
{
    private array $days;
    
    /**
     * Sets days of the week during which the feed is not updated
     *
     * @param string[] $days Names of week days to skip (eg: ["Saturday", "Sunday"])
     * @throws Exception
     */
    public function __construct(array $days)
    {
        array_map(function ($item) {
            if (!in_array($item, ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday","Sunday"])) {
                throw new Exception("Invalid day: ".$item);
            }
        }, $days);
        $this->days = $days;
    }
    
    /**
     * {@inheritDoc}
     * @see Tag::__toString()
     */
    public function __toString(): string
    {
        $output = "";
        foreach ($this->days as $day) {
            $output .= "<day>".$day."</day>";
        }
        return "<skipDays>".$output."</skipDays>";
    }
}
