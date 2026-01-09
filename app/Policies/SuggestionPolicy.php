<?php
// ============================================
// File: app/Policies/SuggestionPolicy.php
// ============================================

namespace App\Policies;

use App\Models\Suggestion;
use App\Models\User;

class SuggestionPolicy
{
    /**
     * Determine if the user can view any suggestions (admin only)
     */
    public function viewAny(User $user): bool
    {
        return $user->is_admin === true;
    }

    /**
     * Determine if the user can view a suggestion
     */
    public function view(User $user, Suggestion $suggestion): bool
    {
        return true; // Public can view resolved suggestions
    }

    /**
     * Determine if the user can create a suggestion
     */
    public function create(User $user): bool
    {
        return true; // Anyone can create
    }

    /**
     * Determine if the user can update a suggestion (admin only)
     */
    public function update(User $user, Suggestion $suggestion): bool
    {
        return $user->is_admin === true;
    }

    /**
     * Determine if the user can delete a suggestion (admin only)
     */
    public function delete(User $user, Suggestion $suggestion): bool
    {
        return $user->is_admin === true;
    }
}

?>