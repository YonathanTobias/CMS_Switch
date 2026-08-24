<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Message;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts_count' => Post::count(),
            'services_count' => Service::count(),
            'events_count' => Event::count(),
            'team_count' => TeamMember::count(),
            'documents_count' => Document::count(),
            'galleries_count' => Gallery::count(),
            'pages_count' => Page::count(),
            'unread_messages' => Message::where('is_read', false)->count(),
        ];

        $recentPosts = Post::with('category')->latest()->take(5)->get();
        $recentMessages = Message::latest()->take(5)->get();
        $upcomingEvents = Event::upcoming()->take(4)->get();

        return view('admin.dashboard', compact('stats', 'recentPosts', 'recentMessages', 'upcomingEvents'));
    }
}
