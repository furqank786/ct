<?php
/**
 * Created by PhpStorm.
 * User: Furqan
 * Date: 11/29/2017
 * Time: 9:02 PM
 */

namespace CachetHQ\Tests\Cachet;
use PHPUnit_Framework_TestCase as TestCase;


class SitesTest extends TestCase
{
    public function testAddSites()
    {
        $response = $this->call('GET', '/');
    }
}