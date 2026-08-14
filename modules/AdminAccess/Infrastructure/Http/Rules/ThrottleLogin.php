<?php

namespace Modules\AdminAccess\Infrastructure\Http\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;

class ThrottleLogin implements ValidationRule
{
    // attempt mechanism to ensure the user will not frequently submit a data to server like 5 trying
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
          $key = $this->throttleKey($value);

         if (RateLimiter::tooManyAttempts($key, $this->maxAttempts())) {
            $seconds = RateLimiter::availableIn($key);
            
            $fail("Too many login attempts. Please try again in {$seconds} seconds.");
        }
    }

    public function hasTooManyAttempts(string $email): bool // user are frequently attempt this will hit the max attempt can cause error
    {
        $key = $this->throttleKey($email);
        
        return RateLimiter::tooManyAttempts($key, $this->maxAttempts());
    }

    public function hit(string $email): void // Tncrement the login attempts for the user.
    {
        $key = $this->throttleKey($email);
        
        RateLimiter::hit($key, $this->decaySeconds());
    }

     public function clear(string $email): void // Clear the login attempts for the user.
    {
        $key = $this->throttleKey($email);
        
        RateLimiter::clear($key);
    }

    protected function throttleKey(string $email): string // Get the rate limiting throttle key for the request.
    {
        return 'login:' . strtolower($email) . '|' . request()->ip();
    }

    protected function maxAttempts(): int // Get the maximum number of attempts allowed.
    {
        return config('user.login.max_attempts', 5);
    }

    protected function decaySeconds(): int
    {
        return config('user.login.decay_seconds', 300); // 5 minutes
    }

}