<?php

declare(strict_types=1);

namespace Churn\Tests\Integration\File;

use Churn\File\File;
use Churn\File\FileFinder;
use Churn\Tests\BaseTestCase;

class FileFinderTest extends BaseTestCase
{
    /**
     * The class being tested.
     * @var FileFinder
     */
    private $fileFinder;

    /** @test */
    public function it_can_be_instantiated()
    {
        self::assertInstanceOf(FileFinder::class, $this->fileFinder);
    }

    /** @test */
    public function it_can_recursively_get_the_php_files_in_a_path()
    {
        $paths = [__DIR__];
        $results = iterator_to_array($this->fileFinder->getPhpFiles($paths), false);
        self::assertCount(1, $results);
        self::assertInstanceOf(File::class, $results[0]);
    }

    public function setUp()
    {
        parent::setUp();

        $this->fileFinder = new FileFinder(['php'], [], __DIR__);
    }
}
