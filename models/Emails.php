<?php namespace NilBorodulya\Futuremail\Models;

use Model;

/**
 * Emails Model
 */
class Emails extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'nilborodulya_futuremail_emails';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
