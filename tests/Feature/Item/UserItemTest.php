<?php
use App\Models\User;
use App\Models\Item;

describe('F2 - Items', function () {
    beforeEach(function () {
        $this->user = User::factory()->create();
        $this->item1 = Item::factory()->create([
            'user_id'=> $this->user->id,
            'text'=>"My item",
            'done'=>false,
            'deadline'=>06/02/2030,

        ]);


    });

    it('user can view items - B of BREAD', function () {
        $this->actingAs($this->user);
        $this->get(route('dashboard.index'));
        expect(Item::where('user_id', $this->user->id)->get()[0]->text)->toBeString('My item');
    });

    it('user can add an item - A of BREAD', function () {
        $this->actingAs($this->user);
        $this->post(route('items.store'),[
            'text'=>"My new item",
            'deadline'=> date("12/04/2030"),
        ]);

        $this->assertDatabaseHas('items', [
            'text'=>"My new item",
            'user_id'=>$this->user->id,
            'deadline'=>date("12/04/2030"),
        ]);
    });

    it('user can set to done an item - E of BREAD', function () {
        $this->actingAs($this->user);
        $this->get(route('items.check',$this->item1->id));

        $this->assertDatabaseHas('items', [
            'id'=>$this->item1->id,
            'done'=>true,
        ]);


    });
    it('user can delete a done item - D of BREAD', function () {
        $this->actingAs($this->user);

        $this->item2 = Item::factory()->create([
            'user_id'=> $this->user->id,
            'text'=>"My second item",
            'done'=>true,
            'deadline'=>date("06/05/2030"),

        ]);

        $this->delete(route('items.check',$this->item2->id));

        $this->assertDatabaseMissing('items', [
            'text'=>"My second item",
            'deadline'=> date("12/05/2030"),
            'user_id'=>$this->user->id,
        ]);
    });

});
