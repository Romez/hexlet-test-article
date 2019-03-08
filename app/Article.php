<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['body', 'name'];

    public function saveTicket($data)
    {
        $this->name = $data['name'];
        $this->body = $data['body'];
        $this->save();
        return true;
    }

    public function updateTicket($data)
    {
        $artivle = $this->find($data['id']);
        $artivle->name = $data['name'];
        $artivle->body = $data['body'];
        $artivle->save();
        return true;
    }
}
