<?php

namespace Test\Category;

use SendGrid\Mail\Optional\Collection\CategoryCollection;
use SendGrid\Mail\Optional\Category;

final class CategoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return void
     * @test
     */
    public function itShouldSerializeSuccessfully()
    {
        $categories = new CategoryCollection([
            new Category('May'),
            new Category('2017'),
            new Category('Other Category'),
            new Category('Last Category')
        ]);

        $this->assertSame(
            json_encode($categories),
            $this->getExpectedEncodedJson()
        );
    }

    /**
     * @return void
     * @test
     */
    public function itShouldAddToCollectionSuccessfully()
    {
        $categories = new CategoryCollection([
            new Category('May')
        ]);
        $this->assertSame(1, $categories->count());

        $categories->add(new Category('2017'));
        $this->assertSame(2, $categories->count());

        $categories->addMany([
            new Category('Other Category'),
            new Category('Last Category')
        ]);
        $this->assertSame(4, $categories->count());
    }

    /**
     * @return void
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function itShouldValidateScalar()
    {
        new Category(true);
    }

    /**
     * @return string
     */
    private function getExpectedEncodedJson()
    {
        return json_encode(
            json_decode($this->getExpectedJson())
        );
    }

    /**
     * @return string
     */
    private function getExpectedJson()
    {
        return <<<JSON
        [
           "May",
           "2017",
           "Other Category",
           "Last Category"
        ]
JSON;
    }
}
