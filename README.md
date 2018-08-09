
[![Travis](https://img.shields.io/travis/yedincisenol/video-intelligence.svg?style=for-the-badge)]()
[![Packagist](https://img.shields.io/packagist/dt/yedincisenol/video-intelligence.svg?style=for-the-badge)]()
[![Packagist](https://img.shields.io/packagist/v/yedincisenol/video-intelligence.svg?style=for-the-badge)]()
[![Packagist](https://img.shields.io/packagist/l/yedincisenol/video-intelligence.svg?style=for-the-badge)]()

* <a href="#php-config">Configuration</a>
* <a href="#laravel-install"> Laravel Installation</a>
* <a href="#usage">Usage examples</a>

### <a name="laravel-install"></a> Laravel Install

- Add composer
```php
composer require "yedincisenol/video-intelligence"
```

- Add service provider (For Laravel 5.6 before) 
`config/app.php`

```php
'providers' => [
    ...
    yedincisenol\VideoIntelligence\LaravelServiceProvider::class
],
```

- Add Facede

`config/app.php`

```php
'aliases' => [
        ...
        'VideoIntelligence'    =>  \yedincisenol\VideoIntelligence\LaravelFacede::class
],
```

- Fill Environments
> copy theese parameters to your project .env and fill
```
VIDEO_INTELLIGENCE_CREDENTIALS_PATH=
```

> How to get credentials file? <a href="http://googlecloudplatform.github.io/google-cloud-php/#/docs/google-cloud/v0.73.0/guides/authentication">Visit here</a>

- Laravel Usage
```
use VideoIntelligence;

VideoIntelligence::annotateVideo(['inputUri' => 'gs://pandora-test/video-1.mp4', 'features' => [1]]);
$operationResponse = VideoIntelligence::annotateVideo(['inputUri' => 'gs://pandora-test/video-1.mp4', 'features' => [1]]);

$operationResponse->pollUntilComplete();
if ($operationResponse->operationSucceeded()) {
    $results = $operationResponse->getResult();
    foreach ($results->getAnnotationResults() as $result) {
        echo 'Segment labels' . PHP_EOL;
        foreach ($result->getSegmentLabelAnnotations() as $labelAnnotation) {
            echo "Label: " . $labelAnnotation->getEntity()->getDescription()
                . PHP_EOL;
        }
        echo 'Shot labels' . PHP_EOL;
        foreach ($result->getShotLabelAnnotations() as $labelAnnotation) {
            echo "Label: " . $labelAnnotation->getEntity()->getDescription()
                . PHP_EOL;
        }
        echo 'Frame labels' . PHP_EOL;
        foreach ($result->getFrameLabelAnnotations() as $labelAnnotation) {
            echo "Label: " . $labelAnnotation->getEntity()->getDescription()
                . PHP_EOL;
        }
    }
} else {
    $error = $operationResponse->getError();
    echo "error: " . $error->getMessage() . PHP_EOL;
}

```

For more detail visit <a href="http://googlecloudplatform.github.io/google-cloud-php/#/docs/cloud-videointelligence/v1.0.4/videointelligence/readme">here</a>

> Label Codes: <a href="https://github.com/GoogleCloudPlatform/google-cloud-php-videointelligence/blob/master/src/V1/Feature.php">here</a>

- Publish Config file (Optional)

```$xslt
php artisan vendor:publish --tag=videointelligence
```
