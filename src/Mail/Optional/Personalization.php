<?php

namespace SendGrid\Mail\Optional;

use SendGrid\Mail\Essential\To;
use SendGrid\Mail\Optional\Collection\CcCollection;
use SendGrid\Mail\Optional\Collection\BccCollection;
use SendGrid\Mail\Essential\Collection\ToCollection;
use SendGrid\Mail\Optional\Collection\HeaderCollection;
use SendGrid\Mail\Optional\Collection\SubstitutionCollection;
use SendGrid\Mail\Optional\Collection\CustomArgumentCollection;
use SendGrid\Mail\Optional\Exception\CcCollectionIsEmptyException;
use SendGrid\Mail\Optional\Exception\BccCollectionIsEmptyException;
use SendGrid\Mail\Essential\Exception\ToCollectionIsEmptyException;
use SendGrid\Mail\Optional\Exception\HeaderCollectionIsEmptyException;
use SendGrid\Mail\Optional\Exception\SubstitutionCollectionIsEmptyException;
use SendGrid\Mail\Optional\Exception\CustomArgumentCollectionIsEmptyException;

final class Personalization implements \JsonSerializable
{
    /**
     * @var ToCollection
     */
    private $tos;

    /**
     * @var Subject|null
     */
    private $subject;

    /**
     * @var CcCollection|null
     */
    private $ccs;

    /**
     * @var BccCollection|null
     */
    private $bccs;

    /**
     * @var HeaderCollection|null
     */
    private $headers;

    /**
     * @var SubstitutionCollection|null
     */
    private $substitutions;

    /**
     * @var CustomArgumentCollection|null
     */
    private $customArguments;

    /**
     * @var \DateTime
     */
    private $sendAt;

    /**
     * @param ToCollection $tos
     * @param Subject $subject
     * @param CcCollection|null $ccs
     * @param BccCollection|null $bccs
     * @param HeaderCollection|null $headers
     * @param SubstitutionCollection|null $substitutions
     * @param CustomArgumentCollection|null $customArguments
     */
    public function __construct(
        ToCollection $tos,
        Subject $subject = null,
        CcCollection $ccs = null,
        BccCollection $bccs = null,
        HeaderCollection $headers = null,
        SubstitutionCollection $substitutions = null,
        CustomArgumentCollection $customArguments = null
    ) {
        $this->tos             = $tos;
        $this->subject         = $subject;
        $this->ccs             = $ccs;
        $this->bccs            = $bccs;
        $this->headers         = $headers;
        $this->substitutions   = $substitutions;
        $this->customArguments = $customArguments;
        $this->sendAt          = new \DateTime;
    }

    /**
     * @param To $to
     * @return Personalization
     */
    public function addTo(To $to)
    {
        $this->tos->add($to);

        return $this;
    }

    /**
     * @param ToCollection $collection
     * @return Personalization
     * @throws ToCollectionIsEmptyException
     */
    public function addTos(ToCollection $collection)
    {
        if ($collection->isEmpty()) {
            throw new ToCollectionIsEmptyException;
        }
        $this->tos->addMany($collection->toArray());

        return $this;
    }

    /**
     * @param Cc $cc
     * @return Personalization
     */
    public function addCc(Cc $cc)
    {
        if (null === $this->ccs) {
            $this->ccs = new CcCollection;
        }
        $this->ccs->add($cc);

        return $this;
    }

    /**
     * @param CcCollection $collection
     * @return Personalization
     * @throws CcCollectionIsEmptyException
     */
    public function addCcs(CcCollection $collection)
    {
        if ($collection->isEmpty()) {
            throw new CcCollectionIsEmptyException();
        }
        if (null === $this->ccs) {
            $this->ccs = new CcCollection;
        }
        $this->ccs->addMany($collection->toArray());

        return $this;
    }

    /**
     * @param Bcc $bcc
     * @return Personalization
     */
    public function addBcc(Bcc $bcc)
    {
        if (null === $this->bccs) {
            $this->bccs = new BccCollection;
        }
        $this->bccs->add($bcc);

        return $this;
    }

    /**
     * @param BccCollection $collection
     * @return Personalization
     * @throws BccCollectionIsEmptyException
     */
    public function addBccs(BccCollection $collection)
    {
        if ($collection->isEmpty()) {
            throw new BccCollectionIsEmptyException;
        }
        if (null === $this->bccs) {
            $this->bccs = new BccCollection;
        }
        $this->bccs->addMany($collection->toArray());

        return $this;
    }

    /**
     * @param Header $header
     * @return Personalization
     */
    public function addHeader(Header $header)
    {
        if (null === $this->headers) {
            $this->headers = new HeaderCollection;
        }
        $this->headers->add($header);

        return $this;
    }

    /**
     * @param HeaderCollection $collection
     * @return Personalization
     * @throws HeaderCollectionIsEmptyException
     */
    public function addHeaders(HeaderCollection $collection)
    {
        if ($collection->isEmpty()) {
            throw new HeaderCollectionIsEmptyException;
        }
        if (null === $this->headers) {
            $this->headers = new HeaderCollection;
        }
        $this->headers->addMany($collection->toArray());

        return $this;
    }

    /**
     * @param Substitution $substitution
     * @return Personalization
     */
    public function addSubstitution(Substitution $substitution)
    {
        if (null === $this->substitutions) {
            $this->substitutions = new SubstitutionCollection;
        }
        $this->substitutions->addSubstitution($substitution);

        return $this;
    }

    /**
     * @param SubstitutionCollection $collection
     * @return Personalization
     * @throws SubstitutionCollectionIsEmptyException
     */
    public function addSubstitutions(SubstitutionCollection $collection)
    {
        if ($collection->isEmpty()) {
            throw new SubstitutionCollectionIsEmptyException;
        }
        if (null === $this->substitutions) {
            $this->substitutions = new SubstitutionCollection;
        }
        $this->substitutions->addMany($collection->toArray());

        return $this;
    }

    /**
     * @param CustomArgument $customArgument
     * @return Personalization
     */
    public function addCustomArgument(CustomArgument $customArgument)
    {
        if (null === $this->customArguments) {
            $this->customArguments = new CustomArgumentCollection;
        }
        $this->customArguments->add($customArgument);

        return $this;
    }

    /**
     * @param CustomArgumentCollection $collection
     * @return Personalization
     * @throws CustomArgumentCollectionIsEmptyException
     */
    public function addCustomArguments(CustomArgumentCollection $collection)
    {
        if ($collection->isEmpty()) {
            throw new CustomArgumentCollectionIsEmptyException;
        }
        if (null === $this->customArguments) {
            $this->customArguments = new CustomArgumentCollection;
        }
        $this->customArguments->addMany($collection->toArray());

        return $this;
    }

    /**
     * @return int
     */
    public function getSendAt()
    {
        return strtotime($this->sendAt->format('Y-m-d H:i:s'));
    }

    /**
     * @return array
     */
    private function getProperties()
    {
        return [
            'to'            => $this->tos,
            'cc'            => $this->ccs,
            'bcc'           => $this->bccs,
            'subject'       => $this->subject,
            'headers'       => $this->headers,
            'substitutions' => $this->substitutions,
            'custom_args'   => $this->customArguments,
            'send_at'       => $this->getSendAt()
        ];
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return array_filter($this->getProperties(), function ($value) {
            return $value !== null;
        });
    }
}
