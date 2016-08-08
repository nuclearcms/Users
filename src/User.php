<?php

namespace Nuclear\Users;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kenarkose\Chronicle\Activity;
use Kenarkose\Chronicle\RecordsActivity;
use Kenarkose\Sortable\Sortable;
use Laracasts\Presenter\Contracts\PresentableInterface;
use Laracasts\Presenter\PresentableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable implements PresentableInterface
{

    use SoftDeletes, PresentableTrait, Sortable, SearchableTrait,
        HasRoles, HasPermissions, RecordsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'first_name', 'last_name'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Presenter for the model
     *
     * @var string
     */
    protected $presenter = 'Nuclear\Users\UserPresenter';

    /**
     * Sortable columns
     *
     * @var array
     */
    protected $sortableColumns = ['first_name', 'email', 'created_at'];

    /**
     * Default sortable key
     *
     * @var string
     */
    protected $sortableKey = 'first_name';

    /**
     * Default sortable direction
     *
     * @var string
     */
    protected $sortableDirection = 'asc';

    /**
     * Searchable columns.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'first_name' => 10,
            'last_name'  => 10,
            'email'      => 10
        ]
    ];

    /**
     * Events for recording
     *
     * @var array
     */
    protected static $recordEvents = ['created', 'deleted'];

    /**
     * Password setter
     *
     * @param string $password
     * @return $this for chaining
     */
    public function setPassword($password)
    {
        $this->attributes['password'] = bcrypt($password);

        return $this;
    }

    /**
     * Static constructor for User
     *
     * @param array $attributes
     * @return static
     */
    public static function create(array $attributes = [])
    {
        $user = new static($attributes);

        $user->setPassword($attributes['password']);

        $user->save();

        return $user;
    }

    /**
     * Relation for user activity
     *
     * @return HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * Checks if the user is a superadmin
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->hasRole('SUPERADMIN') || $this->hasPermission('SUPERADMIN');
    }

}