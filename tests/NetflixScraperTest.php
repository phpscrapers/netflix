<?php

namespace Tests;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use PhpScrapers\Scrapers\NetflixScraper;

/**
 * Class NetflixScraperTest
 *
 * @package Tests
 */
final class NetflixScraperTest extends TestCase
{

    /**
     * @test
     */
    public function it_can_be_instantiated()
    {
        $scraper = new NetflixScraper();
        $this->assertNotNull($scraper);
    }

    /**
     * @test
     */
    public function username_and_password_get_set()
    {
        $scraper = new NetflixScraper();
        $scraper->setLogin('username', 'password');
        Assert::assertAttributeEquals('username', 'username', $scraper);
        Assert::assertAttributeEquals('password', 'password', $scraper);
    }

}
