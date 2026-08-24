<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Category;
use App\Models\Document;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Message;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Homepage
     */
    public function index()
    {
        $carousels = Carousel::active()->get();
        $featuredPosts = Post::published()->where('is_featured', true)->latest('published_at')->take(3)->get();
        $latestPosts = Post::published()->latest('published_at')->take(6)->get();
        $upcomingEvents = Event::upcoming()->take(3)->get();
        $services = Service::active()->take(6)->get();
        $teamMembers = TeamMember::orderBy('order_index', 'asc')->take(4)->get();
        $latestDocuments = Document::published()->latest()->take(5)->get();
        $galleries = Gallery::latest()->take(6)->get();

        return view('frontend.index', compact(
            'carousels',
            'featuredPosts',
            'latestPosts',
            'upcomingEvents',
            'services',
            'teamMembers',
            'latestDocuments',
            'galleries'
        ));
    }

    /**
     * Profile Page (Tentang, Visi Misi, Struktur Organisasi)
     */
    public function profile()
    {
        $teamMembers = TeamMember::orderBy('order_index', 'asc')->get();
        return view('frontend.profile', compact('teamMembers'));
    }

    /**
     * Services List
     */
    public function services()
    {
        if (get_setting('enable_services', '1') === '0') {
            return redirect()->route('home');
        }

        $services = Service::active()->get();
        return view('frontend.services.index', compact('services'));
    }

    /**
     * Service Detail
     */
    public function serviceDetail($slug)
    {
        if (get_setting('enable_services', '1') === '0') {
            return redirect()->route('home');
        }

        $service = Service::where('slug', $slug)->firstOrFail();
        $otherServices = Service::active()->where('id', '!=', $service->id)->take(4)->get();
        return view('frontend.services.show', compact('service', 'otherServices'));
    }

    /**
     * Posts (Berita & Pengumuman) List with filter
     */
    public function posts(Request $request)
    {
        $query = Post::published()->with('category');

        if ($request->has('type') && in_array($request->type, ['berita', 'pengumuman'])) {
            $query->where('type', $request->type);
        }

        if ($request->has('kategori') && $request->kategori) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        if ($request->has('q') && $request->q) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->latest('published_at')->paginate(9)->withQueryString();
        $categories = Category::where('type', 'post')->withCount('posts')->get();
        $recentPosts = Post::published()->latest('published_at')->take(5)->get();

        return view('frontend.posts.index', compact('posts', 'categories', 'recentPosts'));
    }

    /**
     * Post Detail
     */
    public function postDetail($slug)
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();
        $post->increment('views_count');

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where(function ($q) use ($post) {
                $q->where('category_id', $post->category_id)
                  ->orWhere('type', $post->type);
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        $categories = Category::where('type', 'post')->withCount('posts')->get();

        return view('frontend.posts.show', compact('post', 'relatedPosts', 'categories'));
    }

    /**
     * Events / Agenda List
     */
    public function events()
    {
        $upcomingEvents = Event::upcoming()->paginate(8);
        $pastEvents = Event::where('is_active', true)->where('start_date', '<', now()->startOfDay())->latest('start_date')->take(6)->get();
        return view('frontend.events.index', compact('upcomingEvents', 'pastEvents'));
    }

    /**
     * Event Detail
     */
    public function eventDetail($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $otherEvents = Event::where('id', '!=', $event->id)->where('is_active', true)->latest('start_date')->take(4)->get();
        return view('frontend.events.show', compact('event', 'otherEvents'));
    }

    /**
     * Documents Repository
     */
    public function documents(Request $request)
    {
        $query = Document::published()->with('category');

        if ($request->has('kategori') && $request->kategori) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        if ($request->has('q') && $request->q) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $documents = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::where('type', 'document')->withCount('documents')->get();

        return view('frontend.documents.index', compact('documents', 'categories'));
    }

    /**
     * Document Download Counter & Redirect
     */
    public function downloadDocument($id)
    {
        $document = Document::findOrFail($id);
        $document->increment('downloads_count');

        if (Storage::disk('public')->exists($document->file_path)) {
            return Storage::disk('public')->download($document->file_path, $document->title . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION));
        }

        // If file is external or not in local storage, redirect to file URL or back
        if (filter_var($document->file_path, FILTER_VALIDATE_URL)) {
            return redirect()->away($document->file_path);
        }

        return back()->with('error', 'Berkas dokumen belum tersedia untuk diunduh.');
    }

    /**
     * Photo Gallery
     */
    public function galleries()
    {
        $galleries = Gallery::latest()->paginate(12);
        $categories = Gallery::select('category')->distinct()->pluck('category');
        return view('frontend.galleries.index', compact('galleries', 'categories'));
    }

    /**
     * Dynamic Custom Page
     */
    public function page($slug)
    {
        $page = Page::published()->where('slug', $slug)->firstOrFail();
        return view('frontend.page', compact('page'));
    }

    /**
     * Contact Page
     */
    public function contact()
    {
        return view('frontend.contact');
    }

    /**
     * Send Message / Contact Form Handler
     */
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:30',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        Message::create($validated);

        return back()->with('success', 'Terima kasih, pesan Anda telah berhasil dikirim ke admin divisi.');
    }
}
