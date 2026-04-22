<?php
use App\Models\User;

describe('F1 - authentication', function () {
    beforeEach(function () {
        $this->user = User::factory()->create([
            'password' => bcrypt('password')
        ]);
    });

    it('user can login', function () {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password'
        ]);

        $response->assertRedirect('/home');
    });

    it('user can logout', function () {
        $response = $this->actingAs($this->user)
            ->post('/logout');
        $response->assertRedirect('/');
    });
});
