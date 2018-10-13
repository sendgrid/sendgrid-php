<?php
/**
 * This file tests Category.
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Tests
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */
namespace SendGrid\Tests;

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
     * @expectedExceptionMessage $category must be of type string.
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
