<?php
namespace randomhost\Date;

/**
 * Provides methods for counting down to a particular date.
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2016 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://github.random-host.com/countdown/
 */
class Countdown
{
    /**
     * Target date.
     *
     * @var \DateTime
     */
    protected $targetDate = null;

    /**
     * Current date.
     *
     * @var \DateTime
     */
    protected $now = null;

    /**
     * Allow countdown to go backwards.
     *
     * @var bool
     */
    protected $allowNegative = true;

    /**
     * Constructor for this class.
     *
     * @param \DateTime $targetDate    Optional: Target date.
     * @param \DateTime $now           Optional: Date to use as "now".
     *                                 (Default: now)
     * @param bool      $allowNegative Optional: Allow countdown to go backwards.
     *                                 (Default: true)
     */
    public function __construct(
        \DateTime $targetDate = null,
        \DateTime $now = null,
        $allowNegative = true
    ) {
        if (null !== $now) {
            $this->setNow($now);
        } else {
            $this->setNow(new \DateTime());
        }

        $this->setAllowNegative($allowNegative);

        if (null !== $targetDate) {
            $this->setTargetDate($targetDate);
        }
    }

    /**
     * Set target date.
     *
     * @param \DateTime $startDate Target date.
     *
     * @return $this
     */
    public function setTargetDate(\DateTime $startDate)
    {
        $this->targetDate = $startDate;

        if (!$this->allowNegative && $this->now > $this->targetDate) {
            $this->targetDate = $this->now;
        }

        return $this;
    }

    /**
     * Returns the target date.
     *
     * @return \DateTime
     */
    public function getTargetDate()
    {
        return $this->targetDate;
    }

    /**
     * Sets the date to use as "now".
     *
     * @param \DateTime $now Date to use as "now".
     *
     * @return $this
     */
    public function setNow(\DateTime $now)
    {
        $this->now = $now;

        return $this;
    }

    /**
     * Returns the date to use as "now".
     *
     * @return \DateTime Date to use as "now".
     */
    public function getNow()
    {
        return $this->now;
    }

    /**
     * Sets whether the countdown is allowed to go backwards.
     *
     * @param boolean $allowNegative Allow countdown to go backwards.
     *
     * @return $this
     */
    public function setAllowNegative($allowNegative)
    {
        $this->allowNegative = $allowNegative;

        return $this;
    }

    /**
     * Returns whether the countdown is allowed to go backwards.
     *
     * @return boolean
     */
    public function getAllowNegative()
    {
        return $this->allowNegative;
    }

    /**
     * Returns the difference between the given DateTime objects.
     *
     * @return \DateInterval
     */
    public function getDateDiff()
    {
        return $this->now->diff($this->targetDate);
    }
}
