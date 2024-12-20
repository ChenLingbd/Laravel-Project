<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    // 方法示例
    public function index()
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFilters([
                AllowedFilter::callback('name', function (Builder $query, $value) {
                    $query->where(function ($query) use ($value) {
                        $query->where('name', 'like', "%{$value}%")
                            ->orWhere('email', 'like', "%{$value}%");
                    });
                }),
            ])
            ->paginate(10)
            ->withQueryString();

        return view('admin.user', compact('users'));
    }

    public function suspend(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'duration' => 'required|integer',
            'reason' => 'nullable|string|max:255',
        ]);

        $duration = (int) $request->input('duration');
        $suspendUntil = new DateTime;
        $suspendUntil->modify("+{$duration} seconds");

        $user = User::find($request->input('user_id'));
        $user->time_limit = $suspendUntil;
        $user->save();

        return response()->json(['message' => '用戶已成功暫停']);
    }
}
