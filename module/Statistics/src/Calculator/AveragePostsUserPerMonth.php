<?php

namespace Statistics\Calculator;

use SocialPost\Dto\SocialPostTo;
use Statistics\Dto\StatisticsTo;

/**
 * Class AveragePostsUserPerMonth
 *
 * @package Statistics\Calculator
 */
class AveragePostsUserPerMonth extends AbstractCalculator
{

    protected const UNITS = 'posts';

    /**
     * @var int
     */
    private $postCount = 0;

    /**
     * @var array
     */
    private $author = [];

    /**
     * @param SocialPostTo $postTo
     */
    protected function doAccumulate(SocialPostTo $postTo): void
    {
        $this->postCount++;
        $this->author[] = $postTo->getAuthorId();
    }

    /**
     * @return StatisticsTo
     */
    protected function doCalculate(): StatisticsTo
    {
        $totalauthor = array_unique($this->author);
        $value = $this->postCount > 0
            ? $this->postCount / count($totalauthor)
            : 0;
        return (new StatisticsTo())->setValue(round($value,2));
    }
}
