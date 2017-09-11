<?php

namespace SendGrid\Mail;

use SendGrid\Mail\Optional\Asm;
use SendGrid\Mail\Essential\To;
use SendGrid\Mail\Setting\Footer;
use SendGrid\Mail\Optional\Header;
use SendGrid\Mail\Essential\From;
use SendGrid\Mail\Setting\SpamCheck;
use SendGrid\Mail\Essential\Content;
use SendGrid\Mail\Optional\Section;
use SendGrid\Mail\Setting\BccSettings;
use SendGrid\Mail\Setting\SandBoxMode;
use SendGrid\Mail\Optional\Subject;
use SendGrid\Mail\Optional\ReplyTo;
use SendGrid\Mail\Setting\OpenTracking;
use SendGrid\Mail\Optional\Category;
use SendGrid\Mail\Setting\MailSettings;
use SendGrid\Mail\Setting\ClickTracking;
use SendGrid\Mail\Optional\Attachment;
use SendGrid\Mail\Essential\Collection\ToCollection;
use SendGrid\Mail\Setting\GoogleAnalytics;
use SendGrid\Mail\Setting\TrackingSettings;
use SendGrid\Mail\Optional\Cc;
use SendGrid\Mail\Optional\Bcc;
use SendGrid\Mail\Optional\Substitution;
use SendGrid\Mail\Setting\ByPassListManagement;
use SendGrid\Mail\Optional\Collection\ReplyToCollection;
use SendGrid\Mail\Setting\SubscriptionTracking;
use SendGrid\Mail\Optional\Collection\CategoryCollection;
use SendGrid\Mail\Optional\Collection\HeaderCollection;
use SendGrid\Mail\Optional\Collection\SectionCollection;
use SendGrid\Mail\Optional\CustomArgument;
use SendGrid\Mail\Essential\Collection\ContentCollection;
use SendGrid\Mail\Optional\Personalization;
use SendGrid\Mail\Optional\Collection\CcCollection;
use SendGrid\Mail\Optional\Collection\BccCollection;
use SendGrid\Mail\Optional\Collection\AttachmentCollection;
use SendGrid\Mail\Setting\Exception\MailSettingsIsEmptyException;
use SendGrid\Mail\Optional\Collection\SubstitutionCollection;
use SendGrid\Mail\Setting\Exception\TrackingSettingsIsEmptyException;
use SendGrid\Mail\Optional\Exception\ReplyToCollectionIsEmptyException;
use SendGrid\Mail\Optional\Exception\CategoryCollectionIsEmptyException;
use SendGrid\Mail\Optional\Exception\HeaderCollectionIsEmptyException;
use SendGrid\Mail\Optional\Collection\CustomArgumentCollection;
use SendGrid\Mail\Optional\Exception\SectionCollectionIsEmptyException;
use SendGrid\Mail\Essential\Exception\ContentCollectionIsEmptyException;
use SendGrid\Mail\Optional\Collection\PersonalizationCollection;
use SendGrid\Mail\Optional\Exception\AttachmentCollectionIsEmptyException;
use SendGrid\Mail\Optional\Exception\CustomArgumentCollectionIsEmptyException;
use SendGrid\Mail\Optional\Exception\PersonalizationCollectionIsEmptyException;

final class Mail implements \JsonSerializable
{
    /**
     * @var From
     */
    private $from;

    /**
     * @var ToCollection
     */
    private $tos;

    /**
     * @var Subject
     */
    private $subject;

    /**
     * @var ContentCollection
     */
    private $contents;

    /**
     * @var PersonalizationCollection
     */
    private $personalizations;

    /**
     * @var AttachmentCollection|null
     */
    private $attachments;

    /**
     * @var string|null
     */
    private $templateId;

    /**
     * @var ReplyToCollection|null
     */
    private $repliesTo;

    /**
     * @var SectionCollection|null
     */
    private $sections;

    /**
     * @var HeaderCollection|null
     */
    private $headers;

    /**
     * @var CategoryCollection|null
     */
    private $categories;

    /**
     * @var CustomArgumentCollection|null
     */
    private $customArgs;

    /**
     * @var \DateTime
     */
    private $sendAt;

    /**
     * @var string
     */
    private $batchId;

    /**
     * @var Asm|null
     */
    private $asm;

    /**
     * @var string|null
     */
    private $ipPoolName;

    /**
     * @var MailSettings|null
     */
    private $mailSettings;

    /**
     * @var TrackingSettings|null
     */
    private $trackingSettings;

    /**
     * @param From $from
     * @param ToCollection $tos
     * @param ContentCollection $contents
     * @param Subject|null $subject
     */
    public function __construct(From $from, ToCollection $tos, ContentCollection $contents, Subject $subject = null)
    {
        $this->from             = $from;
        $this->tos              = $tos;
        $this->contents         = $contents;
        $this->subject          = $subject;
        $this->personalizations = new PersonalizationCollection([new Personalization($tos, $subject)]);
    }

    /**
     * @param To $to
     * @return Mail
     */
    public function addTo(To $to)
    {
        $this->getBasePersonalization()->addTo($to);

        return $this;
    }

    /**
     * @param ToCollection $tos
     * @return Mail
     */
    public function addTos(ToCollection $tos)
    {
        $this->getBasePersonalization()->addTos($tos);

        return $this;
    }

    /**
     * @param Cc $cc
     * @return Mail
     */
    public function addCc(Cc $cc)
    {
        $this->getBasePersonalization()->addCc($cc);

        return $this;
    }

    /**
     * @param CcCollection $ccs
     * @return Mail
     */
    public function addCcs(CcCollection $ccs)
    {
        $this->getBasePersonalization()->addCcs($ccs);

        return $this;
    }

    /**
     * @param Bcc $bcc
     * @return Mail
     */
    public function addBcc(Bcc $bcc)
    {
        $this->getBasePersonalization()->addBcc($bcc);

        return $this;
    }

    /**
     * @param BccCollection $bccs
     * @return Mail
     */
    public function addBccs(BccCollection $bccs)
    {
        $this->getBasePersonalization()->addBccs($bccs);

        return $this;
    }

    /**
     * @param Header $header
     * @return Mail
     */
    public function addHeaderToBasePersonalization(Header $header)
    {
        $this->getBasePersonalization()->addHeader($header);

        return $this;
    }

    /**
     * @param HeaderCollection $headers
     * @return Mail
     */
    public function addHeadersToBasePersonalization(HeaderCollection $headers)
    {
        $this->getBasePersonalization()->addHeaders($headers);

        return $this;
    }

    /**
     * @param Substitution $substitution
     * @return Mail
     */
    public function addSubstitution(Substitution $substitution)
    {
        $this->getBasePersonalization()->addSubstitution($substitution);

        return $this;
    }

    /**
     * @param SubstitutionCollection $substitutions
     * @return Mail
     */
    public function addSubstitutions(SubstitutionCollection $substitutions)
    {
        $this->getBasePersonalization()->addSubstitutions($substitutions);

        return $this;
    }

    /**
     * @param CustomArgument $customArgument
     * @return Mail
     */
    public function addCustomArgumentToBasePersonalization(CustomArgument $customArgument)
    {
        $this->getBasePersonalization()->addCustomArgument($customArgument);

        return $this;
    }

    /**
     * @param CustomArgumentCollection $customArguments
     * @return Mail
     */
    public function addCustomArgumentsToBasePersonalization(CustomArgumentCollection $customArguments)
    {
        $this->getBasePersonalization()->addCustomArguments($customArguments);

        return $this;
    }

    /**
     * @param Personalization $personalization
     * @return Mail
     */
    public function addPersonalization(Personalization $personalization)
    {
        $this->personalizations->add($personalization);

        return $this;
    }

    /**
     * @param PersonalizationCollection $personalizations
     * @return Mail
     * @throws PersonalizationCollectionIsEmptyException
     */
    public function addPersonalizations(PersonalizationCollection $personalizations)
    {
        if ($personalizations->isEmpty()) {
            throw new PersonalizationCollectionIsEmptyException;
        }
        $this->personalizations->addMany($personalizations->toArray());

        return $this;
    }

    /**
     * @param Attachment $attachment
     * @return Mail
     */
    public function addAttachment(Attachment $attachment)
    {
        $this->createAttachmentCollectionIfNull();
        $this->attachments->add($attachment);

        return $this;
    }

    /**
     * @param AttachmentCollection $attachments
     * @return Mail
     * @throws AttachmentCollectionIsEmptyException
     */
    public function addAttachments(AttachmentCollection $attachments)
    {
        if ($attachments->isEmpty()) {
            throw new AttachmentCollectionIsEmptyException;
        }
        $this->createAttachmentCollectionIfNull();
        $this->attachments->addMany($attachments->toArray());

        return $this;
    }

    /**
     * @param Content $content
     * @return Mail
     */
    public function addContent(Content $content)
    {
        $this->contents->add($content);

        return $this;
    }

    /**
     * @param ContentCollection $contents
     * @return Mail
     * @throws ContentCollectionIsEmptyException
     */
    public function addContents(ContentCollection $contents)
    {
        if ($contents->isEmpty()) {
            throw new ContentCollectionIsEmptyException;
        }
        $this->contents->addMany($contents->toArray());

        return $this;
    }

    /**
     * @param Section $section
     * @return Mail
     */
    public function addSection(Section $section)
    {
        $this->createSectionCollectionIfNull();
        $this->sections->add($section);

        return $this;
    }

    /**
     * @param SectionCollection $sections
     * @return Mail
     * @throws SectionCollectionIsEmptyException
     */
    public function addSections(SectionCollection $sections)
    {
        if ($sections->isEmpty()) {
            throw new SectionCollectionIsEmptyException;
        }
        $this->createSectionCollectionIfNull();
        $this->sections->addMany($sections->toArray());

        return $this;
    }

    /**
     * @param Header $header
     * @return Mail
     */
    public function addHeader(Header $header)
    {
        $this->createHeaderCollectionIfNull();
        $this->headers->add($header);

        return $this;
    }

    /**
     * @param HeaderCollection $headers
     * @return Mail
     * @throws HeaderCollectionIsEmptyException
     */
    public function addHeaders(HeaderCollection $headers)
    {
        if ($headers->isEmpty()) {
            throw new HeaderCollectionIsEmptyException;
        }
        $this->createHeaderCollectionIfNull();
        $this->headers->addMany($headers->toArray());

        return $this;
    }

    /**
     * @param Category $category
     * @return Mail
     */
    public function addCategory(Category $category)
    {
        $this->createCategoryCollectionIfNull();
        $this->categories->add($category);

        return $this;
    }

    /**
     * @param CategoryCollection $categories
     * @return Mail
     * @throws CategoryCollectionIsEmptyException
     */
    public function addCategories(CategoryCollection $categories)
    {
        if ($categories->isEmpty()) {
            throw new CategoryCollectionIsEmptyException;
        }
        $this->createCategoryCollectionIfNull();
        $this->categories->addMany($categories->toArray());

        return $this;
    }

    /**
     * @param CustomArgument $customArgument
     * @return Mail
     */
    public function addCustomArgument(CustomArgument $customArgument)
    {
        $this->createCustomArgumentCollectionIfNull();
        $this->customArgs->add($customArgument);

        return $this;
    }

    /**
     * @param CustomArgumentCollection $customArguments
     * @return Mail
     * @throws CustomArgumentCollectionIsEmptyException
     */
    public function addCustomArguments(CustomArgumentCollection $customArguments)
    {
        if ($customArguments->isEmpty()) {
            throw new CustomArgumentCollectionIsEmptyException;
        }
        $this->createCustomArgumentCollectionIfNull();
        $this->customArgs->addMany($customArguments->toArray());

        return $this;
    }

    /**
     * @param Asm $asm
     * @return Mail
     */
    public function addAsm(Asm $asm)
    {
        $this->asm = $asm;

        return $this;
    }

    /**
     * @param $ipPoolName
     * @return Mail
     */
    public function addIpPoolName($ipPoolName)
    {
        $this->ipPoolName = $ipPoolName;

        return $this;
    }

    /**
     * @param MailSettings $mailSettings
     * @return Mail
     * @throws MailSettingsIsEmptyException
     */
    public function addMailSettings(MailSettings $mailSettings)
    {
        if ($mailSettings->isEmpty()) {
            throw new MailSettingsIsEmptyException;
        }
        $this->mailSettings = $mailSettings;

        return $this;
    }

    /**
     * @param BccSettings $bccSettings
     * @return Mail
     */
    public function addBccSettings(BccSettings $bccSettings)
    {
        $this->createMailSettingsIfNull();
        $this->mailSettings->addBcc($bccSettings);

        return $this;
    }

    /**
     * @param ByPassListManagement $byPassListManagement
     * @return Mail
     */
    public function addByPassListManagement(ByPassListManagement $byPassListManagement)
    {
        $this->createMailSettingsIfNull();
        $this->mailSettings->addByPassListManagement($byPassListManagement);

        return $this;
    }

    /**
     * @param Footer $footer
     * @return Mail
     */
    public function addFooter(Footer $footer)
    {
        $this->createMailSettingsIfNull();
        $this->mailSettings->addFooter($footer);

        return $this;
    }

    /**
     * @param SandBoxMode $sandBoxMode
     * @return Mail
     */
    public function addSandBoxMode(SandBoxMode $sandBoxMode)
    {
        $this->createMailSettingsIfNull();
        $this->mailSettings->addSandBoxMode($sandBoxMode);

        return $this;
    }

    /**
     * @param SpamCheck $spamCheck
     * @return Mail
     */
    public function addSpamCheck(SpamCheck $spamCheck)
    {
        $this->createMailSettingsIfNull();
        $this->mailSettings->addSpamCheck($spamCheck);

        return $this;
    }

    /**
     * @param TrackingSettings $trackingSettings
     * @return Mail
     * @throws TrackingSettingsIsEmptyException
     */
    public function addTrackingSettings(TrackingSettings $trackingSettings)
    {
        if ($trackingSettings->isEmpty()) {
            throw new TrackingSettingsIsEmptyException;
        }
        $this->trackingSettings = $trackingSettings;

        return $this;
    }

    /**
     * @param ClickTracking $clickTracking
     * @return Mail
     */
    public function addClickTracking(ClickTracking $clickTracking)
    {
        $this->createTrackingSettingsIfNull();
        $this->trackingSettings->addClickTracking($clickTracking);

        return $this;
    }

    /**
     * @param OpenTracking $openTracking
     * @return Mail
     */
    public function addOpenTracking(OpenTracking $openTracking)
    {
        $this->createTrackingSettingsIfNull();
        $this->trackingSettings->addOpenTracking($openTracking);

        return $this;
    }

    /**
     * @param SubscriptionTracking $subscriptionTracking
     * @return Mail
     */
    public function addSubscriptionTracking(SubscriptionTracking $subscriptionTracking)
    {
        $this->createTrackingSettingsIfNull();
        $this->trackingSettings->addSubscriptionTracking($subscriptionTracking);

        return $this;
    }

    /**
     * @param GoogleAnalytics $googleAnalytics
     * @return Mail
     */
    public function addGoogleAnalytics(GoogleAnalytics $googleAnalytics)
    {
        $this->createTrackingSettingsIfNull();
        $this->trackingSettings->addGoogleAnalytics($googleAnalytics);

        return $this;
    }

    /**
     * @param ReplyTo $replyTo
     * @return Mail
     */
    public function addReplyTo(ReplyTo $replyTo)
    {
        $this->createReplyToCollectionIfNull();
        $this->repliesTo->add($replyTo);

        return $this;
    }

    /**
     * @param ReplyToCollection $repliesTo
     * @return Mail
     * @throws ReplyToCollectionIsEmptyException
     */
    public function addRepliesTo(ReplyToCollection $repliesTo)
    {
        if ($repliesTo->isEmpty()) {
            throw new ReplyToCollectionIsEmptyException;
        }
        $this->createReplyToCollectionIfNull();
        $this->repliesTo->addMany($repliesTo->toArray());

        return $this;
    }

    /**
     * @param string $templateId
     * @throws \InvalidArgumentException
     * @return Mail
     */
    public function addTemplateId($templateId)
    {
        if (!is_string($templateId)) {
            throw new \InvalidArgumentException('template id must be a string');
        }
        $this->templateId = $templateId;

        return $this;
    }

    /**
     * @return array
     */
    private function getProperties()
    {
        return [
            'from'              => $this->from,
            'personalizations'  => $this->personalizations,
            'content'           => $this->contents,
            'subject'           => $this->subject,
            'attachments'       => $this->attachments,
            'template_id'       => $this->templateId,
            'sections'          => $this->sections,
            'headers'           => $this->headers,
            'categories'        => $this->categories,
            'custom_args'       => $this->customArgs,
            'send_at'           => $this->sendAt,
            'batch_id'          => $this->batchId,
            'asm'               => $this->asm,
            'ip_pool_name'      => $this->ipPoolName,
            'mail_settings'     => $this->mailSettings,
            'tracking_settings' => $this->trackingSettings,
            'reply_to'          => $this->repliesTo
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

    /**
     * @return Personalization
     */
    private function getBasePersonalization()
    {
        return $this->personalizations->first();
    }

    /**
     * @return void
     */
    private function createMailSettingsIfNull()
    {
        if (null === $this->mailSettings) {
            $this->mailSettings = new MailSettings;
        }
    }

    /**
     * @return void
     */
    private function createAttachmentCollectionIfNull()
    {
        if (null === $this->attachments) {
            $this->attachments = new AttachmentCollection;
        }
    }

    /**
     * @return void
     */
    private function createSectionCollectionIfNull()
    {
        if (null === $this->sections) {
            $this->sections = new SectionCollection;
        }
    }

    /**
     * @return void
     */
    private function createHeaderCollectionIfNull()
    {
        if (null === $this->headers) {
            $this->headers = new HeaderCollection;
        }
    }

    /**
     * @return void
     */
    private function createCategoryCollectionIfNull()
    {
        if (null === $this->categories) {
            $this->categories = new CategoryCollection;
        }
    }

    /**
     * @return void
     */
    private function createCustomArgumentCollectionIfNull()
    {
        if (null === $this->customArgs) {
            $this->customArgs = new CustomArgumentCollection;
        }
    }

    /**
     * @return void
     */
    private function createTrackingSettingsIfNull()
    {
        if (null === $this->trackingSettings) {
            $this->trackingSettings = new TrackingSettings;
        }
    }

    /**
     * @return void
     */
    private function createReplyToCollectionIfNull()
    {
        if (null === $this->repliesTo) {
            $this->repliesTo = new ReplyToCollection;
        }
    }
}
