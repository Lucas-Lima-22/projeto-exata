<?php

namespace App\Models;

use App\Enums\TaskOrder;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = ["user_id", "title", "description", "status"];

    protected function scopeFilter($query, $filters)
    {
        $query->when(auth()->user()->isGuest(), function ($query) {
            $query->where('user_id', auth()->id());
        });

        $query->when($filters['status'] ?? false, function ($query, $search) {
            request()->validate([
                "status" => [Rule::enum(TaskStatus::class)]
            ]);

            $query->where('status', $search);
        });

        $query->when($filters['order'] ?? false, function ($query, $search) {
            request()->validate([
                "order" => [Rule::enum(TaskOrder::class)]
            ]);

            $query->reOrder();

            switch ($search) {
                case "oldest":
                    $query->oldest();
                    break;
                case "latest":
                    $query->latest();
                    break;
                default:
                    $query->orderBy($search);
            }
        });
    }

    protected function casts(): array
    {
        return [
            "created_at" => "datetime:d/m/Y"
        ];
    }
}
