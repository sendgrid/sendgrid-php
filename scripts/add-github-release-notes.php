#!/usr/bin/php
<?php

/** @var string */
const RELEASES_URI = 'https://api.github.com/repos/sendgrid/sendgrid-php/releases';
/** @var string */
$githubToken = getenv('GITHUB_TOKEN');

/**
 * Parse the CHANGELOG to retrieve the latest details.
 * @return array
 * @throws Exception
 */
function parseLatestComponents()
{
    $changelog = file_get_contents(__DIR__.'/../CHANGELOG.md');

    // Parse the latest CHANGELOG contents to 'tag_name', 'name', and 'body'
    preg_match(
        '/## \[(?<version>v?[\d.]+?)\] - \(?(\d{4}-\d{2}-\d{2})\)? ##\s(?<body>[\s\S]+?)\s+## \[/m',
        $changelog,
        $info
    );

    if (isset($info['version']) && isset($info['body'])) {
        return [
            'tag_name' => $info['version'],
            'name'     => $info['version'],
            'body'     => $info['body'],
        ];
    }

    throw new Exception('Unable to parse the CHANGELOG for the latest version!');
}

/**
 * Send the release creation request to the GitHub API.
 * @param $data The JSON-encoded array object
 * @param $githubToken The GitHub API token
 * @return bool
 * @throws Exception
 */
function sendReleaseNotes($data, $githubToken)
{
    $curl = curl_init(RELEASES_URI);

    curl_setopt_array(
        $curl,
        [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => $data,
            CURLOPT_USERAGENT      => 'SendGrid',
            CURLOPT_HTTPHEADER     => [
                'authorization: token '.$githubToken,
                'content-type: application/json',
            ],
        ]
    );

    curl_exec($curl);

    $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    if ($responseCode === 201) {
        return true;
    }

    throw new Exception('An error occurred while creating the release notes.');
}

try {
    if (!$githubToken) {
        throw new Exception('No GitHub API token has been specified.');
    }

    echo 'Parsing the CHANGELOG components.'.PHP_EOL;
    $data = parseLatestComponents();

    echo 'Encoding the release notes'.PHP_EOL;
    $encoded = json_encode($data);

    echo 'Sending content to the GitHub API:'.PHP_EOL;
    echo '> '.$encoded.PHP_EOL;
    sendReleaseNotes($encoded, $githubToken);

    echo 'Successfully added release notes for release: '.$data['tag_name'];
    echo PHP_EOL;
} catch (Exception $e) {
    exit('ERROR: '.$e->getMessage());
}
