<?php

namespace SendGrid;

use PHPUnit\Framework\TestCase;

class FilesExistTest extends TestCase
{
    private $requiredFiles;

    protected function setUp()
    {
        $this->requiredFiles = [
            ['./Dockerfile', './docker/Dockerfile'],
            ['./docker-compose.yml', './docker/docker-compose.yml'],
            './.codeclimate.yml',
            './.env_sample',
            './.github/ISSUE_TEMPLATE',
            './.github/PULL_REQUEST_TEMPLATE',
            './.gitignore',
            './.travis.yml',
            './CHANGELOG.md',
            './CODE_OF_CONDUCT.md',
            './CONTRIBUTING.md',
            './LICENSE.md',
            './README.md',
            './TROUBLESHOOTING.md',
            './USAGE.md',
            './USE_CASES.md',
        ];
    }

    public function testFilesArePresentInRepo()
    {
        foreach ($this->requiredFiles as $filePath) {
            if (is_array($filePath)) {
                $exists = array_filter(
                    $filePath,
                    function ($file) {
                        return file_exists($file);
                    }
                );
                $files = join('" and "', $filePath);
                $this->assertNotEmpty($exists, "File \"{$files}\" does not exist in repo!");
            } else {
                $this->assertFileExists($filePath, "File \"{$filePath}\" does not exist in repo!");
            }
        }
    }
}
