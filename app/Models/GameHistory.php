<?php
// app/Models/GameHistory.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameHistory extends Model
{
    use HasFactory;

    const COUNT_HISTORY = 3; // count game history user
    protected $fillable = ['user_id', 'random_number', 'result', 'win_amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
