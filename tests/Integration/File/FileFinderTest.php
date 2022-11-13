<?php

declare(strict_types=1);

namespace Churn\Tests\Integration\File;

use Churn\File\File;
use Churn\File\FileFinder;
use Churn\Tests\BaseTestCase;

class FileFinderTest extends BaseTestCase
{
    /** @return void */
    public function setUp()
    {
        parent::setUp();

        $this->fileFinder = new FileFinder(['php'], [], __DIR__);
    }

    /**
     * The class being tested.
     * @var FileFinder
     */
    private $fileFinder;

    /** @test */
    public function it_can_be_instantiated(): void
    {
        self::assertInstanceOf(FileFinder::class, $this->fileFinder);
    }

    /** @test */
    public function it_can_recursively_get_the_php_files_in_a_path(): void
    {
        $paths = [__DIR__];
        $results = iterator_to_array($this->fileFinder->getPhpFiles($paths), false);
        self::assertCount(1, $results);
        self::assertInstanceOf(File::class, $results[0]);
    }
}
