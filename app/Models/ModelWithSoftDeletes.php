<?php

namespace LAVA\Models;

use LAVA\Traits\ModelRulesTrait;
use LAVA\Traits\SoftDeletesTrait;
use LAVA\Traits\RelationshipsTrait;
use Illuminate\Database\Eloquent\Model;


class ModelWithSoftDeletes extends Model
{
    use SoftDeletesTrait, RelationshipsTrait, ModelRulesTrait;
}