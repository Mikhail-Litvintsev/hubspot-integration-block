<?php

namespace App\Models\Integrations\Hubspot;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Integrations\Hubspot\HubspotUserToken
 *
 * @property int $user_id
 * @property int $block_id
 * @property string $hubspot_user_token_dto [json_encode(serialize(TokenDTO))]
 * @property string $code
 * @property Carbon|null $expire_at [timestamp]
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|HubspotUserToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HubspotUserToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HubspotUserToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|HubspotUserToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HubspotUserToken whereExpireAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HubspotUserToken whereHubspotUserTokenDto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HubspotUserToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HubspotUserToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HubspotUserToken whereUserId($value)
 */
class HubspotUserToken extends Model
{
    protected $fillable = [
        'user_id',
        'block_id',
        'hubspot_user_token_dto',
        'expire_at',
        'code'
    ];

    public function isValid(): bool
    {
        if ($this->hubspot_user_token_dto !== null) {
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->expire_at) > \Carbon\Carbon::now()->addSeconds(10);
        }
        return false;
    }
}
