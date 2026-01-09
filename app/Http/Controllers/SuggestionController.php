<?php
// ============================================
// File: app/Http/Controllers/SuggestionController.php (FIXED)
// ============================================

namespace App\Http\Controllers;

use App\Models\Suggestion;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SuggestionController extends Controller
{
    use AuthorizesRequests;

    // User: Create suggestion form
    public function create()
    {
        return view('suggestions.create');
    }

    // User: Store new suggestion
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'category' => 'required|in:feedback,complaint,suggestion,praise,other',
            'message' => 'required|string|min:10',
        ]);

        $suggestion = Suggestion::create($validated);

        // Log activity
        ActivityLog::create([
            'suggestion_id' => $suggestion->id,
            'action' => 'created',
            'description' => 'Suggestion submitted by ' . $validated['name'],
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('suggestions.track', $suggestion->id)
            ->with('success', 'Suggestion submitted successfully!');
    }

    // User: View all suggestions (public)
    public function index()
    {
        $suggestions = Suggestion::with('rating')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('suggestions.index', compact('suggestions'));
    }

    // User: Track their suggestion progress
    public function track($id)
    {
        $suggestion = Suggestion::with(['attachments', 'rating', 'activities'])
            ->findOrFail($id);

        return view('suggestions.track', compact('suggestion'));
    }

    // Admin: View all suggestions
    public function list()
    {
        $this->authorize('viewAny', Suggestion::class);

        $suggestions = Suggestion::with('admin', 'rating')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.suggestions.list', compact('suggestions'));
    }

    // Admin: Edit suggestion form
    public function edit($id)
    {
        $suggestion = Suggestion::findOrFail($id);
        $this->authorize('update', $suggestion);

        return view('admin.suggestions.edit', compact('suggestion'));
    }

    // Admin: Update suggestion
    public function update(Request $request, $id)
    {
        $suggestion = Suggestion::findOrFail($id);
        $this->authorize('update', $suggestion);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'category' => 'required|in:feedback,complaint,suggestion,praise,other',
            'message' => 'required|string|min:10',
            'response' => 'nullable|string',
            'status' => 'required|in:pending,reviewed,resolved',
        ]);

        $oldValues = $suggestion->only(['status', 'category', 'message']);
        $suggestion->update($validated);

        if ($validated['status'] !== $oldValues['status']) {
            $suggestion->update(['reviewed_at' => now()]);
        }

        // Log activity
        ActivityLog::create([
            'suggestion_id' => $suggestion->id,
            'user_id' => Auth::id(),
            'action' => 'updated',
            'description' => 'Suggestion updated by admin',
            'old_value' => json_encode($oldValues),
            'new_value' => json_encode($validated),
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.suggestions.list')
            ->with('success', 'Suggestion updated successfully!');
    }

    // Admin: Delete suggestion
    public function destroy($id)
    {
        $suggestion = Suggestion::findOrFail($id);
        $this->authorize('delete', $suggestion);

        ActivityLog::create([
            'suggestion_id' => $suggestion->id,
            'user_id' => Auth::id(),
            'action' => 'deleted',
            'description' => 'Suggestion deleted by admin',
        ]);

        $suggestion->delete();

        return redirect()->route('admin.suggestions.list')
            ->with('success', 'Suggestion deleted successfully!');
    }

    // Admin: View activity logs for a suggestion
    public function showActivities($id)
    {
        $suggestion = Suggestion::findOrFail($id);
        $this->authorize('viewAny', Suggestion::class);

        $activities = $suggestion->activities()->orderByDesc('created_at')->paginate(20);

        return view('admin.suggestions.activities', compact('suggestion', 'activities'));
    }
}

?>

<?php
// ============================================
// File: app/Http/Middleware/IsAdmin.php (FIXED)
// ============================================

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized access. Admin privileges required.');
        }

        return $next($request);
    }
}

?>