<?php

namespace App;

use Moloquent;

/**
 * Represents Messages send to each user
 */
class MessageUser extends Moloquent
{

    const STATUS_QUEUED = 'queued';
    const SENT = 'sent';
    const VIEWED = 'viewed';
    const FAILED = 'failed';

    //created_at updated_at
    protected $table = ('message_user');

    /**
     * Default values for attributes
     * 
     * @var array an array with attribute as key and default as value
     */
    protected $attributes = [
        'status' => self::STATUS_QUEUED,
        'status_message' => '',
    ];
    protected $fillable = [
        'response',
        'status', 
        'email', 
        'status_message',
        'notification_id', 
        // 'message', 
        'timestamp_event', 
        'user_id', 
        'event_user_id'
    ];

    /**
     * MessageUser belogs to Account
     *
     * @return BelogsTo relation
     */
    public function user()
    {
        return $this->belongsTo('App\Account')->select(['names', 'email','displayName']);
    }

    /**
     * MessageUser belogs to Message
     *
     * @return BelogsTo relation
     */
    public function message()
    {
        return $this->belongsTo('App\Message');
    }

    /**
     * Change status to viewed
     *
     * @return void
     */
    public function viewed()
    {
        $this->status = self::VIEWED;
    }

    /**
     * Change status to sent
     *
     * @return void
     */
    public function sent()
    {
        $this->status = self::SENT;
    }

}
