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

use Goutte\Client;
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
        $url = "https://www.netflix.com/Login?nextpage=https%3A%2F%2Fwww.netflix.com%2Fviewingactivity";
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $form = $crawler->selectButton('Sign In')->form();
        $crawler = $client->submit($form, array('email' => $this->username, 'password' => $this->password));
        $this->raw = $crawler->html();
        $crawler->filter('.retableRow')->each(function ($node) {
            // .date .title data-reactid
            $date   = $node->filter(".date")->text();
            $title  = $node->filter(".title")->text();
            $id     = str_replace("/title/", "", $node->filter(".title > a")->attr("href"));
            $this->data["id_".$id] = [
                "date"  => $date,
                "title" => $title
            ];
        });

        if (empty($this->raw)) {
            $this->message = "Unable to fetch data from the Netflix page";
        } else {
            $this->message = "Fetch HTML from Netflix page successfully";
        }

        if ($this->data === null) {
            $this->data = [];
        }

        return $this->data;
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
