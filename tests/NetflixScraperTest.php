<?php

/*
 * This file is part of phpscrapers/netflix
 *
 *  (c) Scott Wilcox <scott@dor.ky>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 */

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
     * @group standard
     */
    public function testItCanBeInstantiated()
    {
        $scraper = new NetflixScraper();
        $this->assertNotNull($scraper);
    }

    /**
     * @group standard
     */
    public function testUsernameAndPasswordGetSet()
    {
        $scraper = new NetflixScraper();
        $scraper->setLogin('username', 'password');
        Assert::assertAttributeEquals('username', 'username', $scraper);
        Assert::assertAttributeEquals('password', 'password', $scraper);
    }

    /**
     * @group integration
     *
     * This test in particular needs to be made less brittle but Goutte has issues
     * reading from local files and not remote so I can't move that out just yet.
     */
    public function testTitlesCanBeParsedFromNetflix()
    {
        if (empty(getenv('NF_USERNAME'))) {
            throw new \Exception('No username to get() test with.');
        }
        if (empty(getenv('NF_PASSWORD'))) {
            throw new \Exception('No password to get() test with.');
        }

        $scraper = new NetflixScraper();
        $scraper->setLogin(getenv('NF_USERNAME'), getenv('NF_PASSWORD'));
        $data = $scraper->get();
        $this->assertGreaterThan(0, count($data));

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
