<?php
/*
 * Copyright 2020 Google LLC.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/*
 * For instructions on how to run the full sample:
 *
 * @see https://github.com/GoogleCloudPlatform/php-docs-samples/tree/master/secretmanager/README.md
 */

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

if (count($argv) != 3) {
    return printf("Usage: php %s PROJECT_ID SECRET_ID\n", basename(__FILE__));
}
list($_, $projectId, $secretId) = $argv;

// [START secretmanager_create_secret]
// Import the Secret Manager client library.
use Google\Cloud\SecretManager\V1beta1\Replication;
use Google\Cloud\SecretManager\V1beta1\Replication\Automatic;
use Google\Cloud\SecretManager\V1beta1\Secret;
use Google\Cloud\SecretManager\V1beta1\SecretManagerServiceClient;

/** Uncomment and populate these variables in your code */
// $projectId = 'YOUR_GOOGLE_CLOUD_PROJECT' (e.g. 'my-project');
// $secretId = 'YOUR_SECRET_ID' (e.g. 'my-secret');

// Create the Secret Manager client.
$client = new SecretManagerServiceClient();

// Build the resource name of the parent project.
$parent = $client->projectName($projectId);

// Create the secret.
$secret = $client->createSecret($parent, $secretId, [
    'secret' => new Secret([
        'replication' => new Replication([
            'automatic' => new Automatic(),
        ]),
    ]),
]);

// Print the new secret name.
printf('Created secret: %s', $secret->getName());
// [END secretmanager_create_secret]
