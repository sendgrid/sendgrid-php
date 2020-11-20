<?php
/**
 * This file tests the existence of necessary files in this repo.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * This class tests the existence of necessary files in this repo.
 *
 * @package SendGrid\Tests\Unit
 */
class FilesExistTest extends TestCase
{
    /**
     * This method tests that the required files exist in the repo
     */
    public function testFilesArePresentInRepo()
    {
        $rootDir = __DIR__ . '/../..';
        $this->assertFileExists("$rootDir/.codeclimate.yml");
        $this->assertFileExists("$rootDir/.env.sample");
        $this->assertFileExists("$rootDir/ISSUE_TEMPLATE.md");
        $this->assertFileExists("$rootDir/PULL_REQUEST_TEMPLATE.md");
        $this->assertFileExists("$rootDir/.gitignore");
        $this->assertFileExists("$rootDir/.travis.yml");
        $this->assertFileExists("$rootDir/CHANGELOG.md");
        $this->assertFileExists("$rootDir/CODE_OF_CONDUCT.md");
        $this->assertFileExists("$rootDir/LICENSE");
        $this->assertFileExists("$rootDir/README.md");
        $this->assertFileExists("$rootDir/TROUBLESHOOTING.md");
        $this->assertFileExists("$rootDir/USAGE.md");
        $this->assertFileExists("$rootDir/USE_CASES.md");
    }
}
