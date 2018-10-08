<?php
/**
 * This helper defines the attachment mime types for a /mail/send API call
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Mail
 * @author    Michael Dennis <michaeljdennis@gmail.com>
 * @copyright 2018 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

namespace SendGrid\Mail;

/**
 * This class is used to define the attachment mime types for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
abstract class AttachmentMimeType
{
    const APPLICATION_ECMASCRIPT = "application/ecmascript";
    const APPLICATION_JAVASCRIPT = "application/javascript";
    const APPLICATION_JSON = "application/json";
    const APPLICATION_OCTET_STREAM = "application/octet-stream";
    const APPLICATION_OGG = "application/ogg";
    const APPLICATION_PDF = "application/pdf";
    const APPLICATION_PKCS12 = "application/pkcs12";
    const APPLICATION_VND_MSPOWERPOINT = "application/vnd.mspowerpoint";
    const APPLICATION_XHTML_XML = "application/xhtml+xml";
    const APPLICATION_XML = "application/xml";
    const AUDIO_MIDI = "audio/midi";
    const AUDIO_MPEG = "audio/mpeg";
    const AUDIO_OGG = "audio/ogg";
    const AUDIO_WAV = "audio/wav";
    const AUDIO_WAVE = "audio/wave";
    const AUDIO_WEBM = "audio/webm";
    const AUDIO_X_PN_WAV = "audio/x-pn-wav";
    const AUDIO_X_WAV = "audio/x-wav";
    const IMAGE_BMP = "image/bmp";
    const IMAGE_GIF = "image/gif";
    const IMAGE_JPEG = "image/jpeg";
    const IMAGE_PNG = "image/png";
    const IMAGE_SVG_XML = "image/svg+xml";
    const IMAGE_VND_MICROSOFT_ICON = "image/vnd.microsoft.icon";
    const IMAGE_WEBP = "image/webp";
    const IMAGE_X_ICON = "image/x-icon";
    const MULTIPART_BYTERANGES = "multipart/byteranges";
    const MULTIPART_FORM_DATA = "multipart/form-data";
    const TEXT_CSS = "text/css";
    const TEXT_HTML = "text/html";
    const TEXT_JAVASCRIPT = "text/javascript";
    const TEXT_PLAIN = "text/plain";
    const VIDEO_MP4 = "video/mp4";
    const VIDEO_OGG = "video/ogg";
    const VIDEO_WEBM = "video/webm";
}
