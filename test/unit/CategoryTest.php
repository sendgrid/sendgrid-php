<?php
/**
 * This file tests Category.
 */
namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Category;

/**
 * This file tests Category.
 *
 * @package SendGrid\Tests
 */
class CategoryTest extends TestCase
{
    public function testConstructor()
    {
        $category = new Category('category');

        $this->assertInstanceOf(Category::class, $category);
        $this->assertSame('category', $category->getCategory());
    }

    public function testSetCategory()
    {
        $category = new Category();
        $category->setCategory('category');

        $this->assertSame('category', $category->getCategory());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$category" must be a string.
     */
    public function testSetCategoryOnInvalidType()
    {
        $category = new Category();
        $category->setCategory(['invalid_category']);
    }

    public function testJsonSerialize()
    {
        $category = new Category();
        $category->setCategory('category');

        $this->assertSame('category', $category->jsonSerialize());
    }
}
