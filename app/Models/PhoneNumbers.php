<?php


namespace App\Models;


use App\Interfaces\ContactEntitiesActions;
use App\Interfaces\SearchEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhoneNumbers extends Model implements ContactEntitiesActions, SearchEntity
{
    use HasFactory;

    protected $table = 'phone_numbers';
    protected $fillable = [
        'id',
        'phone',
        'contact_id',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function saveEntity() : bool
    {
        return self::save();
    }

    public function contact(): BelongsTo
    {
        return self::belongsTo(Contact::class);
    }

    public function deleteEntity(): bool
    {
        $model = self::query()->where('id', $this->id)->first() ?? null;
        return $model && $model->contact->user_id === $this->user_id ? $model->delete() : false;
    }

    public function searchEntity(): object
    {
        return self::query()
            ->select('phone_numbers.id as phone_id', 'contacts.full_name', 'contacts.user_id', 'phone', 'contact_id')
            ->join('contacts', 'contacts.id', '=', 'phone_numbers.contact_id')
            ->where('phone','LIKE' ,'%'. $this->phone . '%')->get();
    }
}
