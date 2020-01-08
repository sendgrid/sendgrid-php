<?php
/**
 * This file tests the existence of necessary files in this repo
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Tests
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018-19 Twilio SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;

/**
 * This class tests the existence of necessary files in this repo
 *
 * @package SendGrid\Tests
 */
class FilesExistTest extends TestCase
{
    /**
     * This method tests that the required files exist in the repo
     */
    public function testFilesArePresentInRepo()
    {
        $rootDir = __DIR__ . '/../..';
        $this->assertFileExists("$rootDir/docker/Dockerfile");
        //$this->assertFileExists("$rootDir/docker/docker-compose.yml");
        $this->assertFileExists("$rootDir/.codeclimate.yml");
        $this->assertFileExists("$rootDir/.env.sample");
        $this->assertFileExists("$rootDir/.github/ISSUE_TEMPLATE");
        $this->assertFileExists("$rootDir/.github/PULL_REQUEST_TEMPLATE");
        $this->assertFileExists("$rootDir/.gitignore");
        $this->assertFileExists("$rootDir/.travis.yml");
        $this->assertFileExists("$rootDir/CHANGELOG.md");
        $this->assertFileExists("$rootDir/CODE_OF_CONDUCT.md");
        $this->assertFileExists("$rootDir/LICENSE.md");
        $this->assertFileExists("$rootDir/README.md");
        $this->assertFileExists("$rootDir/TROUBLESHOOTING.md");
        $this->assertFileExists("$rootDir/USAGE.md");
        $this->assertFileExists("$rootDir/USE_CASES.md");
    }
}
