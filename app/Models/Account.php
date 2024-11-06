<?php

namespace App\Models;

use App\Attendize\Utils;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Hash;
use DB;

class Account extends MyBaseModel
{
    use SoftDeletes;
    use Notifiable;
    use HasRoles;
    
    protected static $unguarded = true;
    protected static $auth;
    protected $table = 'users';


    
    /**
     * The validation rules
     *
     * @var array $rules
     */
    protected $rules = [
        'first_name' => ['required'],
        'last_name'  => ['required'],
        'email'      => ['required', 'email'],
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array $dates
     */
    public $dates = ['deleted_at'];


    /**
     * The validation error error_messages.
     *
     * @var array $error_messages
     */
    protected $error_messages = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'displayName',
        'uid',
        'first_name',
        'last_name',
        'email',
        'timezone_id',
        'date_format_id',
        'datetime_format_id',
        'currency_id',
        'name',
        'last_ip',
        'last_login_date',
        'address1',
        'address2',
        'city',
        'state',
        'postal_code',
        'country_id',
        'email_footer',
        'is_active',
        'is_banned',
        'is_beta',
        'stripe_access_token',
        'stripe_refresh_token',
        'stripe_secret_key',
        'stripe_publishable_key',
        'stripe_data_raw'
    ];

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);

    }

    public static function boot()
    {

        parent::boot();

        self::$auth = resolve('Kreait\Firebase\Auth');

        //Creamos el usuario en firebase
        self::creating(
            function ($model) {
                try{
                    
                    //Si ya existe un usuario con ese correo se jode
                    $fbuser = self::$auth->createUser(
                        [
                            "email" => $model->email,
                            //emailVerified: false,
                            //phoneNumber: "+11234567890",
                            "password" => isset($model->password) ? $model->password : "mocion.2040",
                            "displayName" => isset($model->displayName) ? $model->displayName : $model->names,
                            //photoURL: "http://www.example.com/12345678/photo.png",
                            //disabled: false
                        ]
                    );
                    $model->uid = $fbuser->uid;
                    //var_dump($fbuser);
                }catch(\Exception $e){
                    var_dump($e->getMessage());
                }
            }
        );
    }

    /**
     * The messages that belong to the user.
     */
    public function messages()
    {
        return $this->belongsToMany('App\Message', null, 'user_id', 'message_id');
    }

    public function events()
    {
        return $this->morphMany('App\Event', 'organizer');
    }

    public function ownedEvents()
    {
        return $this->hasMany('App\Event');
    }

    public function organizations()
    {
        return $this->belongsToMany('App\Organization');
    }

    public function organizers()
    {
        return $this->belongsToMany('App\Organization');
    }
    //->as('subscription')
    //->withTimestamps();
    public function role()
    {
        return $this->belongsTo('Spatie\Permission\Models\Role', 'role_id');
    }

    /**
     * The users associated with the account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(\App\Models\User::class);
    }

    /**
     * The orders associated with the account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }

    /**
     * The currency associated with the account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currency()
    {
        return $this->belongsTo(\App\Models\Currency::class);
    }

    /**
     * Payment gateways associated with an account
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function account_payment_gateways()
    {
        return $this->hasMany(\App\Models\AccountPaymentGateway::class);
    }

    /**
     * Alias for $this->account_payment_gateways()
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gateways() {
        return $this->account_payment_gateways();
    }

    /**
     * Get an accounts active payment gateway
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function active_payment_gateway()
    {
        return $this->hasOne('App\Models\AccountPaymentGateway', 'payment_gateway_id', 'payment_gateway_id')->where('account_id', $this->id);
    }

    /**
     * Get an accounts gateways
     *
     * @param $gateway_id
     * @return mixed
     */
    public function getGateway($gateway_id)
    {
        return $this->gateways->where('payment_gateway_id', $gateway_id)->first();
    }

    /**
     * Get a config value for a gateway
     *
     * @param $gateway_id
     * @param $key
     * @return mixed
     */
    public function getGatewayConfigVal($gateway_id, $key)
    {
        $gateway = $this->getGateway($gateway_id);

        if($gateway && is_array($gateway->config)) {
            return isset($gateway->config[$key]) ? $gateway->config[$key] : false;
        }

        return false;
    }



    /**
     * Get the stripe api key.
     *
     * @return \Illuminate\Support\Collection|mixed|static
     */
    public function getStripeApiKeyAttribute()
    {
        if (Utils::isAttendize()) {
            return $this->stripe_access_token;
        }

        return $this->stripe_secret_key;
    }
}
