<?php
/**
 * Created by PhpStorm.
 * User: oselwang
 * Time: 1:40 AM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

abstract class RequestForm
{

    use ValidatesRequests;

    protected $request;

    protected $rules;

    protected $messages;

    abstract public function handle();

    /**
     * Request constructor.
     * @param Request|null $request
     */
    public function __construct(Request $request = null)
    {
        $this->request = $request ?: request();
    }

    public function isValid()
    {
        $this->validate($this->request, $this->rules, $this->messages);

        return true;
    }

    public function file($property)
    {
        return $this->request->file($property);
    }

    public function fields($property)
    {
        return $this->request->get($property);
    }
}
