<?php

namespace SendGrid;

use PHPUnit\Framework\TestCase;

class FilesExistTest extends TestCase
{
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
