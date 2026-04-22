<?php
use App\Models\User;
use App\Models\Item;

describe('F2 - Items', function () {
    beforeEach(function () {
        $this->user = User::factory()->create([]);
        $this->item1 = Item::factory()->create([
            'user_id'=> $this->user->id,
            'text'=>"My item",
            'done'=>false
        ]);


    });

    it('user can view items - B of BREAD', function () {
        $response = $this->get('/');

    });

    it('user can add an item - A of BREAD', function () {
        $this->actingAs($this->user);


    });

    it('user can set to done an item - E of BREAD', function () {
        $this->actingAs($this->user);


    });

    it('user can delete a done item - D of BREAD', function () {
        $this->actingAs($this->user);


    });

});
