<?php
/**
 * This file tests Category.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Category;
use SendGrid\Mail\TypeException;

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

    public function testSetCategoryOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$category" must be a string/');

        $category = new Category();
        $category->setCategory(123);
    }

    public function testJsonSerialize()
    {
        $category = new Category();
        $category->setCategory('category');

        $this->assertSame('category', $category->jsonSerialize());
    }
}
