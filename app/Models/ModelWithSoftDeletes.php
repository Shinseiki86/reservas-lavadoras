<?php

namespace LAVA\Models;

use LAVA\Traits\ModelRulesTrait;
use LAVA\Traits\SoftDeletesTrait;
use LAVA\Traits\RelationshipsTrait;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class ModelWithSoftDeletes extends Model implements AuditableContract
{
    use SoftDeletesTrait, RelationshipsTrait, ModelRulesTrait, AuditableTrait;
}