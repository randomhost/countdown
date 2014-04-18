<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * CountdownTest unit test definition
 *
 * PHP version 5
 *
 * @category  Date
 * @package   PHP_Countdown
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      https://pear.random-host.com/
 */
namespace randomhost\Date;

/**
 * Unit test for ${CLASS}
 *
 * @category  Date
 * @package   PHP_Countdown
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   Release: @package_version@
 * @link      https://pear.random-host.com/
 */
class CountdownTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests Countdown::__construct() with no parameters.
     *
     * @return void
     */
    public function testConstructNoParameters()
    {
        $countdown = new Countdown();

        $this->assertInstanceOf('randomhost\\Date\\Countdown', $countdown);

        $this->assertNull($countdown->getTargetDate());
        $this->assertInstanceOf('\\DateTime', $countdown->getNow());
        $this->assertTrue($countdown->getAllowNegative());
    }
    
    /**
     * Tests Countdown::__construct() with $targetDate set.
     *
     * @return void
     */
    public function testConstructTargetDate()
    {
        $targetDate = new \DateTime('2014-01-01');
        
        $countdown = new Countdown($targetDate);

        $this->assertInstanceOf('randomhost\\Date\\Countdown', $countdown);

        $this->assertSame($targetDate, $countdown->getTargetDate());
        $this->assertInstanceOf('\\DateTime', $countdown->getNow());
        $this->assertTrue($countdown->getAllowNegative());
    }

    /**
     * Tests Countdown::__construct() with $now set.
     *
     * @return void
     */
    public function testConstructNow()
    {
        $now = new \DateTime();

        $countdown = new Countdown(null, null);
        $this->assertInstanceOf('randomhost\\Date\\Countdown', $countdown);
        $this->assertNull($countdown->getTargetDate());
        $this->assertInstanceOf('\\DateTime', $countdown->getNow());
        $this->assertNotSame($now, $countdown->getNow());
        $this->assertTrue($countdown->getAllowNegative());

        $countdown = new Countdown(null, $now);
        $this->assertInstanceOf('randomhost\\Date\\Countdown', $countdown);
        $this->assertNull($countdown->getTargetDate());
        $this->assertSame($now, $countdown->getNow());
        $this->assertTrue($countdown->getAllowNegative());
    }
    
    /**
     * Tests Countdown::__construct() with $allowNegative set.
     *
     * @return void
     */
    public function testConstructAllowNegative()
    {
        $now = new \DateTime();

        $countdown = new Countdown(null, null);
        $this->assertInstanceOf('randomhost\\Date\\Countdown', $countdown);
        $this->assertNull($countdown->getTargetDate());
        $this->assertInstanceOf('\\DateTime', $countdown->getNow());
        $this->assertTrue($countdown->getAllowNegative());

        $countdown = new Countdown(null, null, false);
        $this->assertInstanceOf('randomhost\\Date\\Countdown', $countdown);
        $this->assertNull($countdown->getTargetDate());
        $this->assertInstanceOf('\\DateTime', $countdown->getNow());
        $this->assertFalse($countdown->getAllowNegative());
        
        $countdown = new Countdown(null, null, true);
        $this->assertInstanceOf('randomhost\\Date\\Countdown', $countdown);
        $this->assertNull($countdown->getTargetDate());
        $this->assertInstanceOf('\\DateTime', $countdown->getNow());
        $this->assertTrue($countdown->getAllowNegative());
    }

    /**
     * Tests Countdown::setTargetDate() and Countdown::getTargetDate().
     *
     * @return void
     */
    public function testSetGetStartDate()
    {
        $targetDate = new \DateTime();

        $countdown = new Countdown();

        $this->assertInstanceOf('randomhost\\Date\\Countdown', $countdown);

        $this->assertNull($countdown->getTargetDate());

        $this->assertSame($countdown, $countdown->setTargetDate($targetDate));

        $this->assertSame($targetDate, $countdown->getTargetDate());
    }

    /**
     * Tests Countdown::setTargetDate() and Countdown::getTargetDate() with
     * disallowed negative intervals.
     *
     * @return void
     */
    public function testSetGetStartDateNoNegative()
    {
        $targetDate = new \DateTime('2014-01-01');
        $now = new \DateTime('2014-02-01');

        $countdown = new Countdown();

        $this->assertInstanceOf('randomhost\\Date\\Countdown', $countdown);

        $this->assertNull($countdown->getTargetDate());

        $this->assertSame($countdown, $countdown->setNow($now));
        $this->assertSame($countdown, $countdown->setAllowNegative(false));
        $this->assertSame($countdown, $countdown->setTargetDate($targetDate));

        $this->assertSame($now, $countdown->getTargetDate());
    }

    /**
     * Tests Countdown::setNow() and Countdown::getNow().
     *
     * @return void
     */
    public function testSetGetNow()
    {
        $now = new \DateTime();

        $countdown = new Countdown();

        $this->assertInstanceOf('randomhost\\Date\\Countdown', $countdown);

        $this->assertInstanceOf('\\DateTime', $countdown->getNow());

        $this->assertSame($countdown, $countdown->setNow($now));

        $this->assertSame($now, $countdown->getNow());
    }

    /**
     * Tests Countdown::setAllowNegative() and Countdown::getAllowNegative().
     *
     * @return void
     */
    public function testSetGetAllowNegative()
    {
        $countdown = new Countdown();

        $this->assertInstanceOf('randomhost\\Date\\Countdown', $countdown);

        $this->assertSame(true, $countdown->getAllowNegative());

        $this->assertSame($countdown, $countdown->setAllowNegative(false));
        $this->assertSame(false, $countdown->getAllowNegative());

        $this->assertSame($countdown, $countdown->setAllowNegative(true));
        $this->assertSame(true, $countdown->getAllowNegative());
    }

    /**
     * Returns the difference between the given DateTime objects.
     *
     * @return \DateInterval
     */
    public function testGetDateDiff()
    {
        $targetDate = new \DateTime('2014-03-01 12:15:30');
        $now = new \DateTime('2014-01-01 11:10:15');

        $countdown = new Countdown();

        $this->assertInstanceOf('randomhost\\Date\\Countdown', $countdown);

        $this->assertSame($countdown, $countdown->setTargetDate($targetDate));
        $this->assertSame($countdown, $countdown->setNow($now));

        $interval = $countdown->getDateDiff();
        $this->assertInstanceOf('\\DateInterval', $interval);

        $this->assertSame(
            '+59 days, 1:05:15',
            $interval->format('%R%a days, %h:%I:%S')
        );
    }

    /**
     * Returns the difference between the given DateTime objects.
     *
     * @return \DateInterval
     */
    public function testGetDateDiffNegative()
    {
        $targetDate = new \DateTime('2014-01-01 11:10:15');
        $now = new \DateTime('2014-03-01 12:15:30');

        $countdown = new Countdown();

        $this->assertInstanceOf('randomhost\\Date\\Countdown', $countdown);

        $this->assertSame($countdown, $countdown->setTargetDate($targetDate));
        $this->assertSame($countdown, $countdown->setNow($now));

        $interval = $countdown->getDateDiff();
        $this->assertInstanceOf('\\DateInterval', $interval);

        $this->assertSame(
            '-59 days, 1:05:15',
            $interval->format('%R%a days, %h:%I:%S')
        );
    }
}
