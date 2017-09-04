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

namespace PhpScrapers\Scrapers;

use PhpScrapers\Interfaces\ScraperInterface;

/**
 * Class NetflixScraper
 *
 * @package PhpScrapers\Scrapers
 */
class NetflixScraper implements ScraperInterface
{

    /**
     * @var
     */
    private $username;
    /**
     * @var
     */
    private $password;
    /**
     * @var
     */
    private $url;
    /**
     * @var
     */
    private $message;
    /**
     * @var
     */
    private $raw;
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $username
     * @param $password
     */
    public function setLogin($username, $password) : void
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function get() : array
    {
    }

    /**
     * @return string
     */
    public function getMessage() : string
    {
        return $this->message;
    }


    /**
     * @return string
     */
    public function getRaw() : string
    {
        return (string)$this->data;
    }

    /**
     * @return bool
     */
    public function isSuccessful() : bool
    {
        return (count($this->data) === 0);
    }

    /**
     * @return bool
     */
    public function isFailure() : bool
    {
        return (count($this->data) > 0);
    }
}
