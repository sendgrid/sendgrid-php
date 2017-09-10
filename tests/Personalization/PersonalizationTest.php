<?php

namespace Test\Personalization;

use SendGrid\Mail\Essential\To;
use SendGrid\Mail\Optional\Header;
use SendGrid\Mail\Optional\Subject;
use SendGrid\Mail\Essential\Collection\ToCollection;
use SendGrid\Mail\Optional\Cc;
use SendGrid\Mail\Optional\Bcc;
use SendGrid\Mail\Optional\Substitution;
use SendGrid\Mail\Optional\Collection\HeaderCollection;
use SendGrid\Mail\Optional\CustomArgument;
use SendGrid\Mail\Optional\Personalization;
use SendGrid\Mail\Optional\Collection\CcCollection;
use SendGrid\Mail\Optional\Collection\BccCollection;
use SendGrid\Mail\Optional\Collection\SubstitutionCollection;
use SendGrid\Mail\Optional\Collection\CustomArgumentCollection;
use SendGrid\Mail\Optional\Collection\PersonalizationCollection;

final class PersonalizationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return void
     * @test
     */
    public function itShouldSerializeSuccessfully()
    {
        $tos = new ToCollection([
            new To('to@example.com', 'toPerson'),
            new To('to@other.com', 'toOtherPerson')
        ]);
        $ccs = new CcCollection([
            new Cc('cc@example.com', 'ccPerson'),
            new Cc('cc@other.com', 'ccOtherPerson')
        ]);
        $bccs = new BccCollection([
            new Bcc('bcc@example.com', 'bccPerson'),
            new Bcc('bcc@other.com', 'bccOtherPerson')
        ]);
        $headers = new HeaderCollection([
            new Header('X-Test', 'test'),
            new Header('X-Mock', 'mock')
        ]);
        $substitutions = new SubstitutionCollection([
            new Substitution('%name%', 'Example User'),
            new Substitution('%city%', 'Denver')
        ]);
        $customArguments = new CustomArgumentCollection([
            new CustomArgument('user_id', '343'),
            new CustomArgument('343', 'marketing')
        ]);
        $subject = new Subject('SendGrid subject');

        $personalization = new Personalization($tos, $subject, $ccs, $bccs, $headers, $substitutions, $customArguments);

        $this->assertSame(
            json_encode($personalization),
            $this->getExpectedDecodedFrom($personalization->getSendAt())
        );
    }

    /**
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Essential\Exception\ToCollectionIsEmptyException
     */
    public function itShouldFailIfEmptyToCollectionIsAdded()
    {
        $this->createBasePersonalization()
             ->addTos(new ToCollection);
    }

    /**
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Optional\Exception\CcCollectionIsEmptyException
     */
    public function itShouldFailIfEmptyCcCollectionIsAdded()
    {
        $this->createBasePersonalization()
             ->addCcs(new CcCollection);
    }

    /**
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Optional\Exception\BccCollectionIsEmptyException
     */
    public function itShouldFailIfEmptyBccCollectionIsAdded()
    {
        $this->createBasePersonalization()
             ->addBccs(new BccCollection);
    }

    /**
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Optional\Exception\SubstitutionCollectionIsEmptyException
     */
    public function itShouldFailIfEmptySubstitutionCollectionIsAdded()
    {
        $this->createBasePersonalization()
             ->addSubstitutions(new SubstitutionCollection);
    }

    /**
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Optional\Exception\CustomArgumentCollectionIsEmptyException
     */
    public function itShouldFailIfEmptyCustomArgumentCollectionIsAdded()
    {
        $this->createBasePersonalization()
             ->addCustomArguments(new CustomArgumentCollection);
    }

    /**
     * @return Personalization
     */
    private function createBasePersonalization()
    {
        return new Personalization(
            new ToCollection([
                new To('to@example.com', 'toPerson'),
                new To('to@other.com', 'toOtherPerson')
            ])
        );
    }

    /**
     * @return void
     * @test
     */
    public function itShouldAddPersonalizationSuccessfully()
    {
        $tos = new ToCollection([
            new To('to@example.com', 'toPerson'),
            new To('to@other.com', 'toOtherPerson')
        ]);
        $ccs = new CcCollection([
            new Cc('cc@example.com', 'ccPerson'),
            new Cc('cc@other.com', 'ccOtherPerson')
        ]);
        $bccs = new BccCollection([
            new Bcc('bcc@example.com', 'bccPerson'),
            new Bcc('bcc@other.com', 'bccOtherPerson')
        ]);
        $headers = new HeaderCollection([
            new Header('X-Test', 'test'),
            new Header('X-Mock', 'mock')
        ]);
        $substitutions = new SubstitutionCollection([
            new Substitution('%name%', 'Example User'),
            new Substitution('%city%', 'Denver')
        ]);
        $customArguments = new CustomArgumentCollection([
            new CustomArgument('user_id', '343'),
            new CustomArgument('343', 'marketing')
        ]);
        $subject = new Subject('SendGrid subject');

        $personalizations = new PersonalizationCollection([
            new Personalization($tos, $subject, $ccs, $bccs, $headers, $substitutions, $customArguments)
        ]);
        $this->assertSame(1, $personalizations->count());

        $personalizations->add(new Personalization($tos));
        $this->assertSame(2, $personalizations->count());

        $personalizations->addMany([
            new Personalization($tos, $subject, $ccs, $bccs),
            new Personalization($tos, $subject, $ccs)
        ]);
        $this->assertSame(4, $personalizations->count());
    }

    /**
     * @return void
     * @test
     */
    public function itShouldSerializeSuccessfullyFromCollection()
    {
        $tos = new ToCollection([
            new To('to@example.com', 'toPerson'),
            new To('to@other.com', 'toOtherPerson')
        ]);
        $ccs = new CcCollection([
            new Cc('cc@example.com', 'ccPerson'),
            new Cc('cc@other.com', 'ccOtherPerson')
        ]);
        $bccs = new BccCollection([
            new Bcc('bcc@example.com', 'bccPerson'),
            new Bcc('bcc@other.com', 'bccOtherPerson')
        ]);
        $headers = new HeaderCollection([
            new Header('X-Test', 'test'),
            new Header('X-Mock', 'mock')
        ]);
        $substitutions = new SubstitutionCollection([
            new Substitution('%name%', 'Example User'),
            new Substitution('%city%', 'Denver')
        ]);
        $customArguments = new CustomArgumentCollection([
            new CustomArgument('user_id', '343'),
            new CustomArgument('343', 'marketing')
        ]);
        $subject = new Subject('SendGrid subject');

        $personalizations = new PersonalizationCollection([
            new Personalization($tos, $subject),
            new Personalization($tos, $subject, $ccs),
            new Personalization($tos, $subject, $ccs, $bccs),
            new Personalization($tos, $subject, $ccs, $bccs, $headers),
            new Personalization($tos, $subject, $ccs, $bccs, $headers, $substitutions),
            new Personalization($tos, $subject, $ccs, $bccs, $headers, $substitutions, $customArguments),
        ]);

        $this->assertSame(
            json_encode($personalizations),
            $this->getExpectedDecodedFromCollection()
        );
    }

    /**
     * @param int $sendAt
     * @return string
     */
    private function getExpectedDecodedFrom($sendAt)
    {
        return json_encode(
            json_decode($this->getExpectedJsonFrom($sendAt))
        );
    }

    /**
     * @return string
     */
    private function getExpectedDecodedFromCollection()
    {
        return json_encode(
            json_decode($this->getExpectedJsonFromCollection())
        );
    }

    /**
     * @param int $sendAt
     * @return string
     */
    private function getExpectedJsonFrom($sendAt)
    {
        return <<<JSON
        {
           "to":[
              {
                 "name":"toPerson",
                 "email":"to@example.com"
              },
              {
                 "name":"toOtherPerson",
                 "email":"to@other.com"
              }
           ],
           "cc":[
              {
                 "name":"ccPerson",
                 "email":"cc@example.com"
              },
              {
                 "name":"ccOtherPerson",
                 "email":"cc@other.com"
              }
           ],
           "bcc":[
              {
                 "name":"bccPerson",
                 "email":"bcc@example.com"
              },
              {
                 "name":"bccOtherPerson",
                 "email":"bcc@other.com"
              }
           ],
           "subject":"SendGrid subject",
           "headers":{
              "X-Test":"test",
              "X-Mock":"mock"
           },
           "substitutions":{
              "%name%":"Example User",
              "%city%":"Denver"
           },
           "custom_args":{
              "user_id":"343",
              "343":"marketing"
           },
           "send_at":{$sendAt}
        }
JSON;
    }

    /**
     * @return string
     */
    public function getExpectedJsonFromCollection()
    {
        $sendAt = strtotime((new \DateTime)->format('Y-m-d H:i:s'));

        return <<<JSON
        [
           {
              "to":[
                 {
                    "name":"toPerson",
                    "email":"to@example.com"
                 },
                 {
                    "name":"toOtherPerson",
                    "email":"to@other.com"
                 }
              ],
              "subject":"SendGrid subject",
              "send_at":{$sendAt}
           },
           {
              "to":[
                 {
                    "name":"toPerson",
                    "email":"to@example.com"
                 },
                 {
                    "name":"toOtherPerson",
                    "email":"to@other.com"
                 }
              ],
              "cc":[
                 {
                    "name":"ccPerson",
                    "email":"cc@example.com"
                 },
                 {
                    "name":"ccOtherPerson",
                    "email":"cc@other.com"
                 }
              ],
              "subject":"SendGrid subject",
              "send_at":{$sendAt}
           },
           {
              "to":[
                 {
                    "name":"toPerson",
                    "email":"to@example.com"
                 },
                 {
                    "name":"toOtherPerson",
                    "email":"to@other.com"
                 }
              ],
              "cc":[
                 {
                    "name":"ccPerson",
                    "email":"cc@example.com"
                 },
                 {
                    "name":"ccOtherPerson",
                    "email":"cc@other.com"
                 }
              ],
              "bcc":[
                 {
                    "name":"bccPerson",
                    "email":"bcc@example.com"
                 },
                 {
                    "name":"bccOtherPerson",
                    "email":"bcc@other.com"
                 }
              ],
              "subject":"SendGrid subject",
              "send_at":{$sendAt}
           },
           {
              "to":[
                 {
                    "name":"toPerson",
                    "email":"to@example.com"
                 },
                 {
                    "name":"toOtherPerson",
                    "email":"to@other.com"
                 }
              ],
              "cc":[
                 {
                    "name":"ccPerson",
                    "email":"cc@example.com"
                 },
                 {
                    "name":"ccOtherPerson",
                    "email":"cc@other.com"
                 }
              ],
              "bcc":[
                 {
                    "name":"bccPerson",
                    "email":"bcc@example.com"
                 },
                 {
                    "name":"bccOtherPerson",
                    "email":"bcc@other.com"
                 }
              ],
              "subject":"SendGrid subject",
              "headers":{
                 "X-Test":"test",
                 "X-Mock":"mock"
              },
              "send_at":{$sendAt}
           },
           {
              "to":[
                 {
                    "name":"toPerson",
                    "email":"to@example.com"
                 },
                 {
                    "name":"toOtherPerson",
                    "email":"to@other.com"
                 }
              ],
              "cc":[
                 {
                    "name":"ccPerson",
                    "email":"cc@example.com"
                 },
                 {
                    "name":"ccOtherPerson",
                    "email":"cc@other.com"
                 }
              ],
              "bcc":[
                 {
                    "name":"bccPerson",
                    "email":"bcc@example.com"
                 },
                 {
                    "name":"bccOtherPerson",
                    "email":"bcc@other.com"
                 }
              ],
              "subject":"SendGrid subject",
              "headers":{
                 "X-Test":"test",
                 "X-Mock":"mock"
              },
              "substitutions":{
                 "%name%":"Example User",
                 "%city%":"Denver"
              },
              "send_at":{$sendAt}
           },
           {
              "to":[
                 {
                    "name":"toPerson",
                    "email":"to@example.com"
                 },
                 {
                    "name":"toOtherPerson",
                    "email":"to@other.com"
                 }
              ],
              "cc":[
                 {
                    "name":"ccPerson",
                    "email":"cc@example.com"
                 },
                 {
                    "name":"ccOtherPerson",
                    "email":"cc@other.com"
                 }
              ],
              "bcc":[
                 {
                    "name":"bccPerson",
                    "email":"bcc@example.com"
                 },
                 {
                    "name":"bccOtherPerson",
                    "email":"bcc@other.com"
                 }
              ],
              "subject":"SendGrid subject",
              "headers":{
                 "X-Test":"test",
                 "X-Mock":"mock"
              },
              "substitutions":{
                 "%name%":"Example User",
                 "%city%":"Denver"
              },
              "custom_args":{
                 "user_id":"343",
                 "343":"marketing"
              },
              "send_at":{$sendAt}
           }
        ]
JSON;
    }
}
