
# Job tracking log

[![GitHub Actions Status](https://github.com/UpBase-Production/job-tracking)](https://github.com/UpBase-Production/job-tracking)
 
## Contents

- [Installation](#installation)
- [Usage](#usage)
    - [Examples](#examples)
    - [Default Values](#default-values)
 

## Installation

1. Install using Composer: `composer require upbase-package/jobtracking`.
1. Run publish vendor and migration, config  `php artisan vendor:publish --provider="Upbase\Jobtracking\JobtrackingServiceProvider"`.
 
## Usage

create instance
```php
\Upbase\Jobtracking\Models\JobTracking::createJobTracking('type', ['sme_id'=>0,
                                                                           'store_id'=>0,
                                                                           'total_job'=>0,
                                                                           'processed_job'=>0,
                                                                           'success_job'=>0,
                                                                           'failed_job'=>0])
```

increment job processed
```php
\Upbase\Jobtracking\Models\JobTracking::incrementProcessedJob(1,true, true);
``` 

increment job success
```php
\Upbase\Jobtracking\Models\JobTracking::incrementSuccessProccesed(1);
```

increment job fail
```php
\Upbase\Jobtracking\Models\JobTracking::incrementFailProccesed(1);
```
