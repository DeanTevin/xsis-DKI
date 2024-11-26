<?php

namespace App\Containers\AppSection\LoggingService\Models;

use App\Ship\Parents\Models\Model as ParentModel;
use OwenIt\Auditing\Models\Audit;

class LoggingAuditing extends Audit
{
    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'LoggingAuditing';
}
