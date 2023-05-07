<?php

namespace App\Entities;

use App\Interfaces\ContactEntitiesActions;
use App\Interfaces\SearchEntity;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Emails extends Model implements ContactEntitiesActions, SearchEntity
{
    use HasFactory;
    protected $table = 'emails';
    protected $fillable = [
        'id',
        'email',
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
            ->select('emails.id as email_id', 'contacts.full_name', 'contacts.user_id', 'email', 'contact_id')
            ->join('contacts', 'contacts.id', '=', 'emails.contact_id')
            ->where('email','LIKE' ,'%'. $this->email . '%')->get();
    }
}
