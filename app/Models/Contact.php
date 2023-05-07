<?php

namespace App\Models;

use App\Entities\Emails;
use App\Entities\PhoneNumbers;
use App\Interfaces\ChildrensActions;
use App\Interfaces\SearchEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model implements ChildrensActions, SearchEntity
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contacts';

    protected $fillable = [
        'full_name',
        'birth_date',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function emails()
    {
        return self::hasMany(Emails::class);
    }

    public function phoneNumbers()
    {
        return self::hasMany(PhoneNumbers::class);
    }

    public function user(): BelongsTo
    {
        return self::belongsTo(User::class);
    }

    public function getListByParentId(): object
    {
        return self::query()->select('full_name', 'birth_date')->where('user_id', $this->user_id)->get();
    }

    public function searchEntity(): object
    {
        return self::query()
            ->select('contacts.id as contact_id', 'contacts.full_name', 'contacts.user_id', 'phone_numbers.phone as phone')
            ->join('phone_numbers', 'contacts.id', '=', 'phone_numbers.contact_id')
            ->where('full_name','LIKE' ,'%'. $this->full_name . '%')
            ->get();
    }
}
