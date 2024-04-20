<?php

namespace App\Rules;

use App\Models\Blog;
use Illuminate\Contracts\Validation\Rule;

class MaxDataLimit implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Get the count of existing blogs
        $existingCount = Blog::count();

        // Set the maximum limit
        $maxLimit = 3;

        // Check if the count exceeds the maximum limit
        return $existingCount < $maxLimit;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The maximum data limit has been reached.';
    }
}
